<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FranchiseVariant;

class FranchiseVariantController extends Controller
{
    public function index()
    {
        $variants = FranchiseVariant::all();
        return view('franchise.variants', compact('variants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        FranchiseVariant::create($request->all());

        return redirect()->route('franchise.variants')->with('success', 'Franchise Variant Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $variant = FranchiseVariant::findOrFail($id);
        $variant->update($request->all());

        return redirect()->route('franchise.variants')->with('success', 'Franchise Variant Updated Successfully');
    }

    public function destroy($id)
    {
        $variant = FranchiseVariant::findOrFail($id);
        $variant->delete();

        return redirect()->route('franchise.variants')->with('success', 'Franchise Variant Deleted Successfully');
    }
}
