@php use Illuminate\Support\Facades\Auth; @endphp

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
    </div>
    <div class="row">

        <!-- Expenses (Monthly)-->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                Expense this month
                            </div>
                            @php
                                $currentYear = date('Y');
                                $currentMonth = date('m');

                                $monthlyExpenses = DB::select('CALL GetMonthlyExpenses(?, ?, ?)', [Auth::id(), $currentYear, $currentMonth]);
                                $totalMonthlyExpenses = isset($monthlyExpenses[0]->total_expenses) ? $monthlyExpenses[0]->total_expenses : 0;

                                $settings = Auth::user()->settings->first();
                                $currencySymbol = optional($settings->currency)->symbol ?? '';
                            @endphp
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $currencySymbol }}
                                {{ number_format($totalMonthlyExpenses, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Expenses (Annual) -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                Total Expenses (All time)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $currencySymbol }} {{ number_format(optional(Auth::user()->userExpensesTotal)->total_expenses, 2) ?? 'No expenses yet' }}
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
    <!-- User Expense Summary Card -->
    <div class="col-xl-5 col-md-6 mb-4">
        <div class="card border-bottom-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                          <div class="text-md font-weight-bold text-info text-uppercase mb-1">Expense Summary</div>
                        @if($summary)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Count: {{ $summary->expense_count }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Average: {{ $currencySymbol }} {{ number_format($summary->average_expense, 2) }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Maximum: {{ $currencySymbol }} {{ number_format($summary->max_expense, 2) }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Minimum: {{ $currencySymbol }} {{ number_format($summary->min_expense, 2) }}</div>
                        @else
                            <div class="h5 mb-0 font-weight-bold text-gray-800">No expenses yet</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-lightbulb fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Goal card -->
    <div class="col-xl-7 col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @if($goal)
                                <div class="text-md font-weight-bold text-info text-uppercase mb-1">Goal: {{ $currencySymbol }}     {{ number_format($goal->target_amount, 2) }} ({{ number_format($goal->progress) }}%)</div>

                                <div class="row no-gutters align-items-center mt-2">
                                    <div class="col">
                                        <div class="progress progress mr-2">
                                            <div class="progress-bar {{ $goal->progress == 100 ? 'bg-success' : 'bg-info' }}" role="progressbar"
                                                 style="width: {{ number_format($goal->progress, 2) }}%" aria-valuenow="{{ number_format($goal->progress, 2) }}" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-lg font-weight-bold text-gray-800 mt-2">{{ number_format($goal->current_amount) }}/{{ number_format($goal->target_amount) }}</div>
                                <div class="text font-weight-bold text-gray-800">Target Date: {{ $goal->target_date }}</div>
                            @else
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">No Goals Set</div>
                                <a href="{{ route('goals.index') }}"><div class="h5 mb-0 font-weight-bold text-gray-800">Set a new goal to track progress</div></a>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullseye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <!-- Bar Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Expenses for {{ date('Y') }}</h6>
                </div>
                <div class="card-body">
                    <div id="chart-data"
                         data-months='@json($months)'
                         data-expenses='@json($expenses)'
                         data-currency='{{ $currencySymbol }}'>
                    </div>
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('sb-admin-2/js/demo/chart-bar-demo.js') }}"></script>
    @endpush
@endsection
