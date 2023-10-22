<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    public function index(){

        $users = User::orderBy('created_at', 'desc')->get();

        return view('backend.userManagement.index', compact('users'));
    }
}
