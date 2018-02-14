<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
    * The task repository instance.
    *
    * @var TaskRepository
    */
    protected $tasks;

	/**
    * Create a new controller instance
    *
    * @param TaskRepository $tasks
    * @return void
    */
    public function __construct(TaskRepository $tasks)
    {
    	//authenticating all task routes to logged in users
    	$this->middleware('auth');
    	$this->tasks = $tasks;
    }

	/**
    * Display a list of all the user's task
    *
    * @param Request $request
    * @return Response
    */
    public function index(Request $request)
    {
        // $tasks = Task::where('user_id', $request->user()->id)->get();

    	return view('tasks.index', [
    		'tasks' => $this->tasks->forUser($request->user())
            // 'tasks' => $tasks;
    	])
    }

	/**
    * Create a new task
    *
    * @param Request request
    * @return Response
    */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255'
    	]);

        // the create method will automatically set the  user_id property of the given task to the ID of the currently authenticated user, which we are accessing using $request->user()
    	$request->user()->tasks()->create([
    		'name' => $request->name
    	]);

    	return redirect('/tasks');
    }

	/**
    * Destroy a given task
    *
    * @param Request $request
    * @param Task @task
    * @return Response
    */
	public function destroy(Request $request, Task $task) 
	{
        // The first argument passed to the  authorize method is the name of the policy method we wish to call. The second argument is the model instance that is our current concern. 
		$this->authorize('destroy', $task);
		$task->delete();
		return redirect('/tasks');
	}

}
