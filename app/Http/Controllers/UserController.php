<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = DB::table('users')
            ->select('name', 'email',)
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($users, 200);
    }
}
