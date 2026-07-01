<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('is_done', 0)->latest()->paginate(5);
        return view('tasks', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::where('is_done', 1)->latest()->paginate(10);
        return view('completed', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['task' => 'required']);
        Task::create($request->all());
        return redirect('/tasks')->with('success', 'Tugas berhasil ditambah! ✨');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['task' => 'required']);
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return redirect('/tasks')->with('success', 'Tugas berhasil diupdate! ✏️');
    }

    public function destroy($id)
    {
        Task::destroy($id);
        return redirect('/tasks')->with('success', 'Tugas dihapus 🗑️');
    }

    public function done($id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->is_done) {
            $task->is_done = 0;
            $message = 'Oke dibatalin, bisa dikerjain lagi 💪';
        } else {
            $task->is_done = 1;
            $message = 'Yey tugas selesai! 🎉';
        }
        
        $task->save();
        return redirect('/tasks')->with('success', $message);
    }
}