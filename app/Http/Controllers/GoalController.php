<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function index()
    {
        $goals = Auth::user()->goals;
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'target_amount' => 'required|numeric',
            'target_date' => 'required|date',
            'current_amount' => 'required|numeric',
        ]);

        Auth::user()->goals()->create($request->all());

        return redirect()->route('goals.index')->with('success', 'Goal set successfully');
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);

        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        $request->validate([
            'target_amount' => 'required|numeric',
            'target_date' => 'required|date',
            'current_amount' => 'required|numeric',
        ]);

        $goal->update($request->all());

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully.');
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);

        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully.');
    }
}
