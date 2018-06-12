<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; 

class UsersController extends Controller
{
    public function index()
    {
        if(\Auth::check()){
        
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
        }
       else{
           return view('welcome');
        }
    }
    
    public function show($id)
   {
      $user = User::find($id);
     
     
       $task = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

       $data = [
           'user' => $user,
           'task' => $task,
       ];

       $data += $this->counts($user);

       return view('users.show', $data);
      }
     
}