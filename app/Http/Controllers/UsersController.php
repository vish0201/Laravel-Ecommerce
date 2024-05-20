<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function usersPage()
    {
        $users = User::all();
        
        return view('AdminComponents.users.users', compact('users'));
    }
}
