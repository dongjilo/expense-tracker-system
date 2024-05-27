@extends('layouts.app')

@section('title', 'Add Expense')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add Expense</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('expenses.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Expense</button>
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
@endsection
