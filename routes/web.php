<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// DISPLAY INDEX ROUTE
Route::get('/', function () {
    /* this is redirecting to another route */
    return redirect()->route('tasks.index');
});


// Display list of tasks from database
 Route::get('/tasks', function () {
    return view('index', [
        //'tasks' => Task::latest()->get() // return all records
        'tasks' => Task::latest()->paginate(10) // return all records paginated
    ]);
})->name('tasks.index');


// DISPLAY CREATE TASK CREATE FORM
Route::view('/tasks/create', 'create')->name('tasks.create');


// DISPLAY EDIT TASK DETAILS FORM (best practices applied)
// Display task information by task id from database
Route::get('/tasks/{task}/edit', function (Task $task) {
    // Push data from Model Task
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');


// DISPLAY TASK DETAILS ROUTE (best practices applied)
// Display task information by task id from database
// IMPORTANT: when using dynamic paraments like {id} it should be placed on bottom on non dynamic routes else it will match anything that comes next
Route::get('/tasks/{task}', function (Task $task) {
    // Push data from Model Task
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');


// PROCESS CREATE TASK FORM ROUTE
// POST create task form (THIS ADD DATA TO DATABASE)
Route::post('/tasks', function (TaskRequest $request) {
    //dd($request->all()); // dd() print a dump of data in console type

    // Process create task with validated fields (defined on app/Http/Requests/TaskRequest.php)
    $task = Task::create($request->validated());

    // Redirect to new task page (matching id)
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');


// PROCESS EDIT TASK FORM ROUTE (best practices applied)
// PUT update task form (THIS EDIT DATA TO DATABASE)
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    //dd($request->all()); // dd() print a dump of data in console type

    // Process update task with validated fields (defined on app/Http/Requests/TaskRequest.php)
    $task->update($request->validated());

    // Redirect to edited task page (matching id)
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');


// PROCESS DELETE TASK FROM ROUTE
Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');


// PROCESS MARK TASK AS COMPLETED ROUTE
Route::put('/tasks/{task}/toggle-complete', function(Task $task) {
    $task->toggleComplete(); // uses a method from Task Model to mark as completed

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.toggle-complete');


// Fallback route
Route::fallback(function () {
    return 'Still got somewhere!';
});
