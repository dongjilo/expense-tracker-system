<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $settings = $user->settings->first();
        $currencySymbol = $settings->currency->symbol;

        // Fetch total monthly expenses
        $currentYear = date('Y');
        $currentMonth = date('m');
        $monthlyExpenses = DB::select('CALL GetMonthlyExpenses(?, ?, ?)', [$userId, $currentYear, $currentMonth]);
        $totalMonthlyExpenses = $monthlyExpenses[0]->total_expenses ?? 0;

        // Fetch goal
        $goal = $user->goals()->orderBy('created_at', 'desc')->first();

        // Fetch monthly expenses for the year
        $yearlyExpenses = DB::select('CALL GetMonthlyUserExpenses(?, ?)', [$userId, $currentYear]);

        $months = [];
        $expenses = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date("F", mktime(0, 0, 0, $i, 1));
            $expense = collect($yearlyExpenses)->firstWhere('month', $i);
            $expenses[] = $expense ? $expense->total_expenses : 0;
        }

        // Fetch user category expenses
        $categoryExpenses = DB::select('CALL GetUserCategoryExpenses(?)', [$userId]);
        $categoryNames = collect($categoryExpenses)->pluck('category_name');
        $categoryTotals = collect($categoryExpenses)->pluck('total_expenses');

        // Fetch user expense summary
        $summary = DB::select('CALL GetUserExpensesSummary(?)', [$userId]);
        $summary = $summary ? $summary[0] : null;

        return view('dashboard', compact(
            'totalMonthlyExpenses', 'goal', 'summary', 'months', 'expenses', 'categoryNames', 'categoryTotals', 'currencySymbol'
        ));
    }




}
