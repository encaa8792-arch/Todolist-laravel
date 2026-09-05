<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->where('is_done', 1)->count();
        $pendingTasks = Task::where('user_id', $userId)->where('is_done', 0)->count();
        $overdueTasks = Task::where('user_id', $userId)
            ->where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();

        $categoryStats = Task::where('user_id', $userId)
            ->selectRaw('category, COUNT(*) as total, SUM(is_done) as completed')
            ->groupBy('category')
            ->get();

        $recentTasks = Task::where('user_id', $userId)->latest()->take(5)->get();
        $upcomingDeadlines = Task::where('user_id', $userId)
            ->where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '>=', now())
            ->orderBy('deadline')
            ->take(5)
            ->get();

        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();
        $prevWeekStart = now()->subWeek()->startOfWeek();
        $prevWeekEnd = now()->subWeek()->endOfWeek();

        $weeklyTotal = Task::where('user_id', $userId)->whereBetween('created_at', [$weekStart, $weekEnd])->count();
        $weeklyCompleted = Task::where('user_id', $userId)
            ->where('is_done', 1)
            ->whereBetween('updated_at', [$weekStart, $weekEnd])->count();
        $weeklyPending = Task::where('user_id', $userId)
            ->where('is_done', 0)
            ->whereBetween('created_at', [$weekStart, $weekEnd])->count();

        $prevWeekCompleted = Task::where('user_id', $userId)
            ->where('is_done', 1)
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
                'created' => Task::where('user_id', $userId)->whereBetween('created_at', [$dayStart, $dayEnd])->count(),
                'completed' => Task::where('user_id', $userId)
                    ->where('is_done', 1)
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
        $userId = auth()->id();
        $tasks = Task::where('user_id', $userId)
            ->where('is_done', 0)
            ->orderByRaw("CASE
                WHEN deadline IS NOT NULL AND DATE(deadline) < CURDATE() THEN 0
                ELSE 1
            END")
            ->orderBy('deadline')
            ->latest()
            ->paginate(5);
        $categories = Category::where('user_id', $userId)->get();
        return view('tasks', compact('tasks', 'categories'));
    }

    public function completed()
    {
        $tasks = Task::where('user_id', auth()->id())->where('is_done', 1)->latest()->paginate(10);
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

        $validated['user_id'] = auth()->id();
        $validated['is_done'] = false;
        Task::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Tugas berhasil ditambah!']);
        }
        return redirect('/tasks')->with('success', 'Tugas berhasil ditambah! ✨');
    }

    public function edit($id)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id);
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

        $task = Task::where('user_id', auth()->id())->findOrFail($id);
        $task->update($validated);
        return redirect('/tasks')->with('success', 'Tugas berhasil diupdate! ✏️');
    }

    public function destroy(Request $request, $id)
    {
        Task::where('user_id', auth()->id())->where('id', $id)->delete();
        $redirect = $request->query('from') === 'completed' ? '/tasks/completed' : '/tasks';
        return redirect($redirect)->with('success', 'Tugas dihapus 🗑️');
    }

    public function done(Request $request, $id)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id);

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
        $count = Task::where('user_id', auth()->id())->where('is_done', 1)->count();
        Task::where('user_id', auth()->id())->where('is_done', 1)->delete();
        return redirect('/tasks')->with('success', "{$count} tugas selesai berhasil dihapus! 🧹");
    }

    public function markAllDone()
    {
        $count = Task::where('user_id', auth()->id())->where('is_done', 0)->count();
        Task::where('user_id', auth()->id())->where('is_done', 0)->update(['is_done' => true]);
        return redirect('/tasks')->with('success', "{$count} tugas ditandai selesai! 🎉");
    }

    public function deleteAll()
    {
        $count = Task::where('user_id', auth()->id())->count();
        Task::where('user_id', auth()->id())->delete();
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
            $count = Task::where('user_id', auth()->id())->whereIn('id', $taskIds)->update(['is_done' => false]);
            return redirect('/tasks')->with('success', "{$count} tugas dibatalkan! ↩️");
        }

        $count = Task::where('user_id', auth()->id())->whereIn('id', $taskIds)->update(['is_done' => true]);
        return redirect('/tasks')->with('success', "{$count} tugas ditandai selesai! 🎉");
    }

    public function bulkDelete(Request $request)
    {
        $taskIds = $request->input('delete_ids', []);

        if (empty($taskIds)) {
            return redirect('/tasks')->with('error', 'Pilih tugas dulu! 📋');
        }

        $count = Task::where('user_id', auth()->id())->whereIn('id', $taskIds)->delete();
        return redirect('/tasks')->with('success', "{$count} tugas berhasil dihapus! 🗑️");
    }

    public function reports()
    {
        $userId = auth()->id();

        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->where('is_done', 1)->count();
        $pendingTasks = Task::where('user_id', $userId)->where('is_done', 0)->count();
        $overdueTasks = Task::where('user_id', $userId)
            ->where('is_done', 0)
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();

        $categoryStats = Task::where('user_id', $userId)
            ->selectRaw('category, COUNT(*) as count')
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
                'created' => Task::where('user_id', $userId)->whereBetween('created_at', [$dayStart, $dayEnd])->count(),
                'completed' => Task::where('user_id', $userId)
                    ->where('is_done', 1)
                    ->whereBetween('updated_at', [$dayStart, $dayEnd])->count(),
            ];
        }

        $topCategory = !empty($categoryStats) ? array_keys($categoryStats, max($categoryStats))[0] : null;

        $overdueTaskList = Task::where('user_id', $userId)
            ->where('is_done', 0)
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
        $userId = auth()->id();

        $defaultCategories = [
            ['name' => 'Kerja', 'icon' => '💼', 'is_default' => true],
            ['name' => 'Kuliah', 'icon' => '📚', 'is_default' => true],
            ['name' => 'Pribadi', 'icon' => '💖', 'is_default' => true],
            ['name' => 'Sekolah', 'icon' => '📓', 'is_default' => true],
        ];

        $customCategories = Category::where('user_id', $userId)->get()->map(function($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->name,
                'icon' => $cat->icon,
                'is_default' => false
            ];
        })->toArray();

        $allCategories = array_merge($defaultCategories, $customCategories);

        $categoryStats = Task::where('user_id', $userId)
            ->selectRaw('category, COUNT(*) as count')
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
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'icon' => 'nullable|string|max:10',
            ]);

            $exists = Category::where('user_id', auth()->id())
                ->where('name', $request->name)
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kategori dengan nama tersebut sudah ada!'
                ], 422);
            }

            $category = Category::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'icon' => $request->icon ?? '📁'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan!',
                'category' => $category
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()['name'][0] ?? 'Validasi gagal'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan kategori: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyCategory(Request $request, $id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus!'
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = Category::where('user_id', auth()->id())->findOrFail($id);

        $exists = Category::where('user_id', auth()->id())
            ->where('name', $request->name)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori dengan nama tersebut sudah ada!'
            ], 422);
        }

        $category->update([
            'name' => $request->name,
            'icon' => $request->icon ?? $category->icon
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui!',
            'category' => $category
        ]);
    }

    public function apiCategories()
    {
        $categories = Category::where('user_id', auth()->id())->get(['id', 'name', 'icon']);
        return response()->json(['categories' => $categories]);
    }
}
