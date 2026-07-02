<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/completed', [TaskController::class, 'completed'])->name('tasks.completed');
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::get('/', fn() => redirect('/dashboard'));
Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
Route::post('/tasks/{id}/done', [TaskController::class, 'done'])->name('tasks.done');
