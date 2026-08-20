<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
Route::get('/debug-tasks', function() {
    $tasks = \App\Models\Task::where('is_done', 0)->paginate(5);
    $html = '<h1>DEBUG - Task Actions Test</h1>';
    foreach($tasks as $task) {
        $html .= '<div style="border:1px solid #ccc;padding:10px;margin:5px;">';
        $html .= '<p>' . e($task->task) . '</p>';
        $html .= '<div class="task-actions">';
        $html .= '<form method="POST" action="/tasks/'.$task->id.'/done"><button type="submit" class="btn-action btn-done-action">Done</button></form>';
        $html .= '<a href="/tasks/'.$task->id.'/edit" class="btn-action btn-edit-action">Edit</a>';
        $html .= '<form method="POST" action="/tasks/'.$task->id.'"><input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" name="_method" value="DELETE"><button type="submit" class="btn-action btn-delete-action">Hapus</button></form>';
        $html .= '</div>';
        $html .= '</div>';
    }
    $html .= '<style>.btn-action{padding:8px 12px;border:none;border-radius:5px;cursor:pointer;margin-right:5px;}.btn-done-action{background:#4CAF50;color:white;}.btn-edit-action{background:#a0c4ff;color:white;}.btn-delete-action{background:#ff8fa3;color:white;}</style>';
    return $html;
});
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/completed', [TaskController::class, 'completed'])->name('tasks.completed');
Route::post('/tasks', [TaskController::class, 'store']);
Route::post('/tasks/clear-completed', [TaskController::class, 'clearCompleted'])->name('tasks.clearCompleted');
Route::post('/tasks/mark-all-done', [TaskController::class, 'markAllDone'])->name('tasks.markAllDone');
Route::delete('/tasks/delete-all', [TaskController::class, 'deleteAll'])->name('tasks.deleteAll');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::get('/', fn() => redirect('/dashboard'));
Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
Route::post('/tasks/{id}/done', [TaskController::class, 'done'])->name('tasks.done');
Route::post('/tasks/bulk-done', [TaskController::class, 'bulkDone'])->name('tasks.bulkDone');
Route::delete('/tasks/bulk-delete', [TaskController::class, 'bulkDelete'])->name('tasks.bulkDelete');
