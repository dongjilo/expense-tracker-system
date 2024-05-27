@extends('layouts.app')

@section('title', 'Edit Expense')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Expense</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('expenses.update', $expense) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $expense->description }}" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $expense->date }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Expense</button>
                </form>
            </div>
        </div>
    </div>
@endsection
