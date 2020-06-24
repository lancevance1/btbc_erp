<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($user)
    {

        $tmp = User::findOrFail($user);
        return view('dashboard.index', ['user' => $tmp]);
    }
}
