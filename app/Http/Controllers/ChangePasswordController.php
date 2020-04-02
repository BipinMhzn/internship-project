<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.passwords.change');
    }

    public function store(Request $request)
    {
        $request->validate([
           'current_password' => ['required', new MatchOldPassword],
           'new_password' => ['required', 'string', 'min:8', 'different:current_password'],
           'new_confirm_password' => ['same:new_password']
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect('profile')->with('success', 'Password Changed Successfully');
    }
}
