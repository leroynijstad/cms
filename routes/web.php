<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks
 */
Route::get('/', function () {

    return view('home', [
        'titel' => 'This is the best',
		'content' => 'welkom bij mijn nieuwe laravel website'
    ]);
});

Route::get('/view_tasks/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks,
		'titel' => 'titel'
    ]);
});
/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/view_tasks/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/view_tasks/');
});
/**
 * Delete An Existing Task
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/view_tasks/');
});