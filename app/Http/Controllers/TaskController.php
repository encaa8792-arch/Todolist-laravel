<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function dashboard()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('is_done', 1)->count();
        $pendingTasks = Task::where('is_done', 0)->count();
        $overdueTasks = Task::where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();

        $categoryStats = Task::selectRaw('category, COUNT(*) as total, SUM(is_done) as completed')
            ->groupBy('category')
            ->get();

        $recentTasks = Task::latest()->take(5)->get();
        $upcomingDeadlines = Task::where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '>=', now())
            ->orderBy('deadline')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTasks', 'completedTasks', 'pendingTasks', 
            'overdueTasks', 'categoryStats', 'recentTasks', 'upcomingDeadlines'
        ));
    }

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
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
            'deadline' => 'nullable|date',
        ]);
        Task::create($validated);
        return redirect('/tasks')->with('success', 'Tugas berhasil ditambah! ✨');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            'category' => 'nullable|string|max:50',
            'deadline' => 'nullable|date',
        ]);
        $task = Task::findOrFail($id);
        $task->update($validated);
        return redirect('/tasks')->with('success', 'Tugas berhasil diupdate! ✏️');
    }

    public function destroy(Request $request, $id)
    {
        Task::destroy($id);
        $redirect = $request->query('from') === 'completed' ? '/tasks/completed' : '/tasks';
        return redirect($redirect)->with('success', 'Tugas dihapus 🗑️');
    }

    public function done(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->is_done) {
            $task->is_done = false;
            $message = 'Oke dibatalin, bisa dikerjain lagi 💪';
        } else {
            $task->is_done = true;
            $message = 'Yey tugas selesai! 🎉';
        }
        
        $task->save();
        return redirect('/tasks')->with('success', $message);
    }

    public function clearCompleted()
    {
        $count = Task::where('is_done', 1)->count();
        Task::where('is_done', 1)->delete();
        return redirect('/tasks')->with('success', "{$count} tugas selesai berhasil dihapus! 🧹");
    }

    public function markAllDone()
    {
        $count = Task::where('is_done', 0)->count();
        Task::where('is_done', 0)->update(['is_done' => true]);
        return redirect('/tasks')->with('success', "{$count} tugas ditandai selesai! 🎉");
    }

    public function deleteAll()
    {
        $count = Task::count();
        Task::truncate();
        return redirect('/tasks')->with('success', "Semua tugas ($count) berhasil dihapus! 🗑️");
    }

    public function bulkDone(Request $request)
    {
        $taskIds = $request->input('task_ids', []);
        $action = $request->input('action', 'done');

        if (empty($taskIds)) {
            return redirect('/tasks')->with('error', 'Pilih tugas dulu! 📋');
        }

        if ($action === 'undo') {
            $count = Task::whereIn('id', $taskIds)->update(['is_done' => false]);
            return redirect('/tasks')->with('success', "{$count} tugas dibatalkan! ↩️");
        }

        $count = Task::whereIn('id', $taskIds)->update(['is_done' => true]);
        return redirect('/tasks')->with('success', "{$count} tugas ditandai selesai! 🎉");
    }

    public function bulkDelete(Request $request)
    {
        $taskIds = $request->input('delete_ids', []);

        if (empty($taskIds)) {
            return redirect('/tasks')->with('error', 'Pilih tugas dulu! 📋');
        }

        $count = Task::whereIn('id', $taskIds)->delete();
        return redirect('/tasks')->with('success', "{$count} tugas berhasil dihapus! 🗑️");
    }
}
