<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Http\Requests\UpdateTaskStatusRequest;


class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateTaskStatusRequest $request)
    {
        $taskStatus = new TaskStatus();
        $taskStatus->fill($request->validated());
        $taskStatus->save();
        return redirect()->route('task_statuses.index')->with('success', __('task_statuses.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        return view('task_statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, string $id)
    {
        $taskStatus = TaskStatus::findOrFail($id);
        $taskStatus->fill($request->validated());
        $taskStatus->save();
        return redirect()->route('task_statuses.index')->with('success', __('task_statuses.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        //dd($taskStatus->tasks()->count());
        if ($taskStatus->tasks()->exists()) {
            return redirect()
                    ->route('task_statuses.index')
                    ->with('error', __('task_statuses.delete_failed'));
        }

        $taskStatus->delete();

        return redirect()
            ->route('task_statuses.index')
            ->with('success', __('task_statuses.deleted'));
    }

}
