<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\FranchiseRequirement;
use App\Models\FranchiseStaff;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FranchiseController extends Controller
{
    public function index()
    {
        $franchises = Franchise::all();
        return view('franchise.manage', compact('franchises'));
    }

    public function create()
    {
        return view('franchise.add');
    }

    public function show($id)
    {
        $franchise = Franchise::with(['requirements', 'staff'])->findOrFail($id);
        return view('franchise.view', compact('franchise'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'franchisee_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'variant' => 'required|string|max:50',
            'franchise_date' => 'required|date',
            'staff_name' => 'array|required',
            'staff_name.*' => 'required|string|max:255',
            'staff_designation' => 'array|required',
            'staff_designation.*' => 'required|string|max:255',
        ]);

        // Create franchise record
        $franchise = Franchise::create($request->only([
            'branch', 'location', 'franchisee_name', 'contact_number', 'variant', 'franchise_date'
        ]));

        $this->logActivity('Created Franchise', 'Franchise Management', "Franchise '{$franchise->branch}' was created.", $franchise->id);

        // Handle file uploads (Optional)
        $files = [];
        $fileFields = [
            'letter_of_intent',
            'resume',
            'market_study',
            'vicinity_map',
            'presentation_fee',
            'site_inspection',
            'battery_test'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $files[$field] = $request->file($field)->store('franchise_requirements');
                $this->logActivity('Uploaded File', 'Franchise Management', "Uploaded {$field} for franchise '{$franchise->branch}'.", $franchise->id);
            } else {
                $files[$field] = null;
            }
        }

        // Handle multiple file uploads for valid IDs
        $valid_ids = [];
        if ($request->hasFile('valid_ids')) {
            foreach ($request->file('valid_ids') as $file) {
                $valid_ids[] = $file->store('franchise_requirements');
            }
            $this->logActivity('Uploaded File', 'Franchise Management', "Uploaded valid IDs for franchise '{$franchise->branch}'.", $franchise->id);
        }

        // Create franchise requirements record
        FranchiseRequirement::create([
            'franchise_id' => $franchise->id,
            'letter_of_intent' => $files['letter_of_intent'],
            'resume' => $files['resume'],
            'market_study' => $files['market_study'],
            'vicinity_map' => $files['vicinity_map'],
            'presentation_fee' => $files['presentation_fee'],
            'site_inspection' => $files['site_inspection'],
            'battery_test' => $files['battery_test'],
            'valid_ids' => json_encode($valid_ids),
        ]);

        // Insert Staff Members
        if ($request->has('staff_name') && $request->has('staff_designation')) {
            foreach ($request->staff_name as $index => $name) {
                FranchiseStaff::create([
                    'franchise_id' => $franchise->id,
                    'staff_name' => $name,
                    'staff_designation' => $request->staff_designation[$index],
                ]);
                $this->logActivity('Added Staff', 'Franchise Management', "Added staff '{$name}' to franchise '{$franchise->branch}'.", $franchise->id);
            }
        }

        return redirect()->back()->with('success', 'Franchise, staff, and requirements added successfully!');
    }

    private function logActivity($action, $module, $description, $franchise_id = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'franchise_id' => $franchise_id,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
}
