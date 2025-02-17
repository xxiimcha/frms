<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\FranchiseRequirement;
use App\Models\FranchiseStaff;
use Illuminate\Support\Facades\Storage;

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

        // ✅ Insert Staff Members
        if ($request->has('staff_name') && $request->has('staff_designation')) {
            foreach ($request->staff_name as $index => $name) {
                FranchiseStaff::create([
                    'franchise_id' => $franchise->id,
                    'staff_name' => $name,
                    'staff_designation' => $request->staff_designation[$index],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Franchise, staff, and requirements added successfully!');
    }
}
