<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\QmtSchedule;

class QmtScheduleController extends Controller
{
    public function index()
    {
        $franchises = Franchise::with('qmtSchedules')->get();
        return view('qmt.schedule', compact('franchises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'franchise_id' => 'required|exists:franchises,id',
            'year' => 'required|integer',
            'q1' => 'nullable|date',
            'q2' => 'nullable|date',
            'q3' => 'nullable|date',
            'q4' => 'nullable|date',
        ]);

        QmtSchedule::updateOrCreate(
            ['franchise_id' => $request->franchise_id, 'year' => $request->year],
            $request->only(['q1', 'q2', 'q3', 'q4'])
        );

        return redirect()->back()->with('success', 'QMT Schedule updated successfully!');
    }

    public function edit($id)
    {
        $schedule = QmtSchedule::findOrFail($id);
        return response()->json($schedule);
    }

    public function update(Request $request, $id)
    {
        $schedule = QmtSchedule::findOrFail($id);
        $schedule->update($request->only(['q1', 'q2', 'q3', 'q4']));

        return redirect()->back()->with('success', 'QMT Schedule updated successfully!');
    }

    public function destroy($id)
    {
        QmtSchedule::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'QMT Schedule deleted successfully!');
    }
}
