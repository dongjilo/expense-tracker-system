@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">User Profile</h1>
        <div class="row">
            <div class="col-lg-6">
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
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                                <ul class="list-unstyled mb-0">
                                    <li>{{ session('error') }}</li>
                                </ul>
                                <button type="button" class="close" aria-label="Close" onclick="dismissAlert('errorAlert')"><span aria-hidden="true">&times;</span></button>
                            </div>
                        @endif

                        <h5 class="card-title">Profile Information</h5>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <input type="text" id="currency" class="form-control"
                                   value="{{ $user->settings->first()->currency->name }} ({{ $user->settings->first()->currency->symbol }})"
                                   readonly>
                        </div>

                        <!-- Add more fields as needed -->

                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        <form action="{{ route('profile.destroy', Auth::user()) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete your account?')">Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
