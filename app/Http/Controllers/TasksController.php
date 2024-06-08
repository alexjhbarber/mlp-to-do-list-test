<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    public function index(): View
    {
        try {
            return view('tasks.index', ['tasks' => Tasks::all()]);
        } catch (\Exception $e) {
            Log::error('Error retrieving tasks: ' . $e->getMessage());
            return redirect(route('index'))->with('error', 'An error occurred while retrieving tasks. Please try again later.');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
            ]);

            Tasks::create($validated);
            return redirect(route('index'))->with('success', 'Task created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return redirect(route('index'))->with('error', 'An error occurred while creating the task. Please try again later.');
        }
    }

    public function update(Request $request, Tasks $task): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'completed' => 'required|boolean',
            ]);

            $task->update($validated);
            return redirect(route('index'))->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating task: ' . $e->getMessage());
            return redirect(route('index'))->with('error', 'An error occurred while updating the task. Please try again later.');
        }
    }

    public function destroy(Tasks $task): RedirectResponse
    {
        try {
            $task->delete();
            return redirect(route('index'))->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting task: ' . $e->getMessage());
            return redirect(route('index'))->with('error', 'An error occurred while deleting the task. Please try again later.');
        }
    }
}

