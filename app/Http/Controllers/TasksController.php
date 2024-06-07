<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TasksController extends Controller
{
    public function index(): View
    {
        return view('tasks.index', ['tasks' => Tasks::all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Tasks::create($validated);
        return redirect(route('index'));
    }

    public function update(Request $request, Tasks $task): RedirectResponse
    {
        $validated = $request->validate([
            'completed' => 'required|boolean',
        ]);

        $task->update($validated);
        return redirect(route('index'));
    }

    public function destroy(Tasks $task): RedirectResponse
    {
        $task->delete();
        return redirect(route('index'));
    }
}
