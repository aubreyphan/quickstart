<?php

use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks
 */
Route::get('/', function () {
    $tasks = Task::orderBy('createdBy', 'asc')->get();
    
    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required:max:255'
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
            // flash the errors from the given validator instance into the session 
            // so that they can be accessed by $errors var in our view
            // @include('common.errors')
    }

    //Create tasks here
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');

});

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    
    return redirect('/');
});

?>