<?php 

namespace App\Repositories;

use App\User;
use App\Task;

// TaskRepo holds all of our data access logic for the Task model

class TaskRepository
{
	/**
    * Get all of the tasks for a given user.
    *
    * @param  User  $user
    * @return Collection
    */
    public function forUser(User $user) 
    {
    	// Dependency injection
    	return Task::where('user_id', $user->id)
    		->orderBy('created_at', 'asc')
    		->get();
    }
}

?>