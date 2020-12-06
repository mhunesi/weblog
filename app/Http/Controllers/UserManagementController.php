<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public $users;
    public function __construct()
    {
        $this->users = User::all();
    }
    public function index()     
    {
        $u = request()->query('u');
        $u = request()->has('u') ? User::where('username', $u)->first() : "";
        
        $data['u'] = $u;

        $data['users'] =  $this->users;
        return view('backend.management.user', $data);
    }
}
