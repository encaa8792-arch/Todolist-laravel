<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
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

        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();
        $prevWeekStart = now()->subWeek()->startOfWeek();
        $prevWeekEnd = now()->subWeek()->endOfWeek();

        $weeklyTotal = Task::whereBetween('created_at', [$weekStart, $weekEnd])->count();
        $weeklyCompleted = Task::where('is_done', 1)
            ->whereBetween('updated_at', [$weekStart, $weekEnd])->count();
        $weeklyPending = Task::where('is_done', 0)
            ->whereBetween('created_at', [$weekStart, $weekEnd])->count();

        $prevWeekCompleted = Task::where('is_done', 1)
            ->whereBetween('updated_at', [$prevWeekStart, $prevWeekEnd])->count();

        $weeklyTrend = $prevWeekCompleted > 0 
            ? round((($weeklyCompleted - $prevWeekCompleted) / $prevWeekCompleted) * 100) 
            : ($weeklyCompleted > 0 ? 100 : 0);

        $dailyStats = [];
        for ($i = 0; $i < 7; $i++) {
            $dayStart = $weekStart->copy()->addDays($i)->startOfDay();
            $dayEnd = $weekStart->copy()->addDays($i)->endOfDay();
            $dailyStats[] = [
                'day' => $dayStart->format('D'),
                'created' => Task::whereBetween('created_at', [$dayStart, $dayEnd])->count(),
                'completed' => Task::where('is_done', 1)
                    ->whereBetween('updated_at', [$dayStart, $dayEnd])->count(),
            ];
        }

        return view('dashboard', compact(
            'totalTasks', 'completedTasks', 'pendingTasks', 
            'overdueTasks', 'categoryStats', 'recentTasks', 'upcomingDeadlines',
            'weeklyTotal', 'weeklyCompleted', 'weeklyPending', 'weeklyTrend', 'dailyStats',
            'weekStart', 'weekEnd'
        ));
    }

    public function index()
    {
        $tasks = Task::where('is_done', 0)
            ->orderByRaw("CASE
                WHEN deadline IS NOT NULL AND DATE(deadline) < CURDATE() THEN 0
                ELSE 1
            END")
            ->orderBy('deadline')
            ->latest()
            ->paginate(5);
        $categories = Category::where('user_id', auth()->id())->get();
        return view('tasks', compact('tasks', 'categories'));
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
            'start_date' => 'nullable',
            'deadline' => 'nullable',
        ]);

        $monthMap = [
            'Jan' => 'January', 'Feb' => 'February', 'Mar' => 'March', 'Apr' => 'April',
            'Mei' => 'May', 'Jun' => 'June', 'Jul' => 'July', 'Agu' => 'August',
            'Sep' => 'September', 'Okt' => 'October', 'Nov' => 'November', 'Des' => 'December'
        ];

        if (!empty($validated['start_date'])) {
            $date = str_replace(array_keys($monthMap), array_values($monthMap), $validated['start_date']);
            $validated['start_date'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
        if (!empty($validated['deadline'])) {
            $date = str_replace(array_keys($monthMap), array_values($monthMap), $validated['deadline']);
            $validated['deadline'] = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }

        if (!empty($validated['start_date']) && !empty($validated['deadline'])) {
            if (strtotime($validated['start_date']) > strtotime($validated['deadline'])) {
                return back()->withErrors(['deadline' => 'Tanggal selesai harus setelah tanggal mulai'])->withInput();
            }
        }

        $validated['is_done'] = false;
        Task::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Tugas berhasil ditambah!']);
        }
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
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
        ]);
        
        if ($validated['start_date'] && $validated['deadline']) {
            if (strtotime($validated['start_date']) > strtotime($validated['deadline'])) {
                return back()->withErrors(['deadline' => 'Tanggal selesai harus setelah tanggal mulai'])->withInput();
            }
        }
        
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
            $redirect = '/tasks';
        } else {
            $task->is_done = true;
            $message = 'Yey tugas selesai! 🎉';
            $redirect = '/tasks/completed';
        }

        $task->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message, 'redirect' => $redirect]);
        }
        return redirect($redirect)->with('success', $message);
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

    public function reports()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('is_done', 1)->count();
        $pendingTasks = Task::where('is_done', 0)->count();
        $overdueTasks = Task::where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();

        $categoryStats = Task::selectRaw('category, COUNT(*) as count')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        $weekStart = now()->startOfWeek();
        $weeklyStats = [];
        for ($i = 0; $i < 7; $i++) {
            $dayStart = $weekStart->copy()->addDays($i)->startOfDay();
            $dayEnd = $weekStart->copy()->addDays($i)->endOfDay();
            $weeklyStats[] = [
                'day' => $dayStart->format('D'),
                'created' => Task::whereBetween('created_at', [$dayStart, $dayEnd])->count(),
                'completed' => Task::where('is_done', 1)
                    ->whereBetween('updated_at', [$dayStart, $dayEnd])->count(),
            ];
        }

        $topCategory = !empty($categoryStats) ? array_keys($categoryStats, max($categoryStats))[0] : null;

        $overdueTaskList = Task::where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->orderBy('deadline')
            ->limit(5)
            ->get(['id', 'task', 'deadline', 'category']);

        return view('reports', compact(
            'totalTasks', 'completedTasks', 'pendingTasks', 'overdueTasks',
            'categoryStats', 'weeklyStats', 'topCategory', 'overdueTaskList'
        ));
    }

    public function categories()
    {
        $defaultCategories = [
            ['name' => 'Kerja', 'icon' => '💼', 'is_default' => true],
            ['name' => 'Kuliah', 'icon' => '📚', 'is_default' => true],
            ['name' => 'Pribadi', 'icon' => '💖', 'is_default' => true],
            ['name' => 'Sekolah', 'icon' => '📓', 'is_default' => true],
        ];

        $customCategories = Category::all()->map(function($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->name,
                'icon' => $cat->icon,
                'is_default' => false
            ];
        })->toArray();

        $allCategories = array_merge($defaultCategories, $customCategories);

        $categoryStats = Task::selectRaw('category, COUNT(*) as count')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        foreach ($allCategories as &$cat) {
            $cat['count'] = $categoryStats[$cat['name']] ?? 0;
        }

        return view('categories', compact('allCategories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
            'icon' => 'nullable|string|max:10',
        ]);

        $validated['icon'] = $validated['icon'] ?? '📁';
        $validated['user_id'] = auth()->id();

        $category = Category::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan!',
                'category' => $category
            ], 201);
        }

        return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroyCategory(Request $request, $id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $category->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus!'
            ]);
        }

        return redirect('/categories')->with('success', 'Kategori berhasil dihapus!');
    }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,' . $id,
        ]);

        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $category->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diperbarui!',
                'category' => $category
            ]);
        }

        return redirect('/categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function apiCategories()
    {
        $categories = Category::where('user_id', auth()->id())->get(['id', 'name', 'icon']);
        return response()->json(['categories' => $categories]);
    }
}
