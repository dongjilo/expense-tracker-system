@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Expenses</h1>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-4">Add Expense</a>
        <div class="card shadow mb-4">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->category->name }}</td>
                                <td>{{ $expense->date }}</td>
                                <td>
                                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
