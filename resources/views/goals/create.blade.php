@extends('layouts.app')

@section('title', 'Set a Goal')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Set a Goal</h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('goals.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="target_amount">Target Amount</label>
                                <input type="number" step="0.01" class="form-control" id="target_amount" name="target_amount" value="{{ old('target_amount') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="current_amount">Current Amount</label>
                                <input type="number" step="0.01" class="form-control" id="current_amount" name="current_amount" value="{{ old('current_amount') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="target_date">Target Date</label>
                                <input type="date" class="form-control" id="target_date" name="target_date" value="{{ old('target_date') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Set Goal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
