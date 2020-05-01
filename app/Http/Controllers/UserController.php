<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (\Auth::user()->role !== 'admin') {
            return abort(403);
        }

        $users = User::all();

        return view('users', [
            'users' => $users,
        ]);
    }

    public function increment(User $user, Request $request)
    {
        if (\Auth::user()->role !== 'admin') {
            return abort(403);
        }

        $user->available_visits += $request->count;
        $user->save();

        return redirect()
            ->route('user.index')
            ->withSuccess(['Successfully increased!']);
    }


}
