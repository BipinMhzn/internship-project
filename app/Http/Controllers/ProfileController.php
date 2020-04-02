<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5'
        ]);

        Auth()->user()->name = $request->name;
        Auth()->user()->save();

        return redirect('profile')->with('success', 'Profile have been successfully updated');
    }
}
