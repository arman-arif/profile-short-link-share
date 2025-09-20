<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('front.index', [
            'user' => \Auth::user()
        ]);
    }

    public function user(User $user)
    {
        return view('front.user', compact('user'));
    }
}
