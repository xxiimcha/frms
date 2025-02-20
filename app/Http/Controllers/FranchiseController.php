<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\FranchiseRequirement;
use App\Models\FranchiseStaff;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\FranchiseVariant;

class FranchiseController extends Controller
{
    public function index()
    {
        $franchises = Franchise::all();
        return view('franchise.manage', compact('franchises'));
    }

    public function create()
    {
        $variants = FranchiseVariant::all();
        return view('franchise.add', compact('variants'));
    }

    public function show($id)
    {
        $franchise = Franchise::with(['requirements', 'staff', 'activity_logs.user'])->findOrFail($id);
        return view('franchise.view', compact('franchise'));
    }

    public function store(Request $request)
{
    $request->validate([
        'branch_code' => 'required|string|max:50|unique:franchises,branch_code',
        'branch' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'franchisee_name' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'email' => 'required|email|max:255|unique:franchises,email',
        'birthday' => 'required|date',
        'home_address' => 'required|string|max:500',
        'variant_id' => 'required|exists:franchise_variants,id',
        'franchise_date' => 'required|date',
        'end_of_contract' => 'nullable|date|after_or_equal:franchise_date',
        'staff_name' => 'array|required',
        'staff_name.*' => 'required|string|max:255',
        'staff_designation' => 'array|required',
        'staff_designation.*' => 'required|string|max:255',
    ]);

    // Create franchise record
    $franchise = Franchise::create([
        'branch_code' => $request->branch_code,
        'branch' => $request->branch,
        'region' => $request->region,
        'location' => $request->location,
        'franchisee_name' => $request->franchisee_name,
        'contact_number' => $request->contact_number,
        'email' => $request->email,
        'birthday' => $request->birthday,
        'home_address' => $request->home_address,
        'variant_id' => $request->variant_id,
        'franchise_date' => $request->franchise_date,
        'end_of_contract' => $request->end_of_contract
    ]);

    // Log activity for franchise creation
    $this->logActivity('Created Franchise', 'Franchise Management', 
        "Franchise '{$franchise->branch}' was created with email '{$franchise->email}' and home address '{$franchise->home_address}'.", 
        $franchise->id
    );

    // Handle file uploads (Optimized Logging)
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

    $uploadedFiles = [];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $files[$field] = $request->file($field)->store('franchise_requirements');
            $uploadedFiles[] = $field;
        } else {
            $files[$field] = null;
        }
    }

    // Log activity for all uploaded files in a single entry
    if (!empty($uploadedFiles)) {
        $this->logActivity(
            'Uploaded Files',
            'Franchise Management',
            "Uploaded " . implode(', ', $uploadedFiles) . " for franchise '{$franchise->branch}'.",
            $franchise->id
        );
    }

    // Handle multiple file uploads for valid IDs
    $valid_ids = [];
    if ($request->hasFile('valid_ids')) {
        foreach ($request->file('valid_ids') as $file) {
            $valid_ids[] = $file->store('franchise_requirements');
        }
        $this->logActivity('Uploaded Valid IDs', 'Franchise Management', 
            "Uploaded valid IDs for franchise '{$franchise->branch}'.", 
            $franchise->id
        );
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

    // Insert Staff Members (Optimized Logging)
    $staffNames = [];

    if ($request->has('staff_name') && $request->has('staff_designation')) {
        foreach ($request->staff_name as $index => $name) {
            FranchiseStaff::create([
                'franchise_id' => $franchise->id,
                'staff_name' => $name,
                'staff_designation' => $request->staff_designation[$index],
            ]);
            $staffNames[] = $name;
        }
    }

    // Log activity for all staff members in a single entry
    if (!empty($staffNames)) {
        $this->logActivity(
            'Added Staff',
            'Franchise Management',
            "Added staff members: " . implode(', ', $staffNames) . " to franchise '{$franchise->branch}'.",
            $franchise->id
        );
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
