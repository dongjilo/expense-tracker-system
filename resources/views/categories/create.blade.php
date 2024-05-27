@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Add Category</h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
            </div>
        </div>
    </div>
@endsection
