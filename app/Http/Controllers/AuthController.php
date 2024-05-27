<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:3|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $summary = DB::table('UserExpensesSummary')
            ->where('user_id', $user->id)
            ->first();
        $goal = $user->goals()->orderBy('created_at', 'desc')->first();

        // Get monthly expenses for the current year
        $year = date('Y');
        $monthlyExpenses = DB::table('MonthlyUserExpenses')
            ->select('month', 'total_expenses')
            ->where('user_id', $user->id)
            ->where('year', $year)
            ->orderBy('month')
            ->get();

        $months = [];
        $expenses = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("F", mktime(0, 0, 0, $i, 1));
            $expense = $monthlyExpenses->firstWhere('month', $i);
            $expenses[] = $expense ? $expense->total_expenses : 0;
        }


        return view('dashboard', compact('goal', 'summary', 'months', 'expenses'));
    }
}
