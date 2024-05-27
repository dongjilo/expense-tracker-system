<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.index', ['user' => $user]);
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        $currencies = Currency::all();
        return view('user.edit', ['user' => $user, 'currencies' => $currencies]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255',
           'old_password' => 'nullable|string|min:3',
           'new_password' => 'nullable|string|min:3|confirmed',
           'currency_id' => 'required|exists:currencies,id'
        ]);

        if ($request->filled('old_password')) {
            if(!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'The old password is incorrect.']);
            }
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('new_password')) {
            $userData['password'] = Hash::make($request->new_password);
        }

        $user->update($userData);

        $user->settings()->updateOrCreate(
            ['user_id' => $user->id],
            ['currency_id' => $request->currency_id]
        );

        return redirect()->route('profile.show')->with('success', 'Profile updated sucessfully');
    }

    public function destroy()
    {
        // cant destory user can we
    }

}
