<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->where('completed', true)->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{id}', function ($id) {

    return view('show', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::get('/tasks/{id}/edit', function ($id) {

    return view('edit', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.edit');


Route::put('/tasks/{id}', function ($id) {

    $data = request()->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();

    return redirect()->route('tasks.show', ['id' => $id])->with('success', 'Task was updated!');
})->name('tasks.update');

Route::post("/tasks", function () {
    $data = request()->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    // dd(session('errors'));
    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];
    $task->save();



    return redirect()->route('tasks.show', ['id' => $task->id])->with('success', 'Task was created!');
})->name('tasks.store');



Route::fallback(function () {
    return view("404");
});