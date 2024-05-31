@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')

@section('title', 'Goals')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Goals</h1>
        <a href="{{ route('goals.create') }}" class="btn btn-primary mb-4">Set a New Goal</a>

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

        @php
            $settings = Auth::user()->settings->first();
            $currencySymbol = optional($settings->currency)->symbol ?? '';
        @endphp

        <div class="row">
            @forelse ($goals as $goal)
                <div class="col-lg-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Goal #{{$goal->id}}: {{ $currencySymbol }} {{ number_format($goal->target_amount, 2) }}</h5>
                            <p class="card-text">
                                Current Progress: {{ $currencySymbol }} {{ number_format($goal->current_amount, 2) }}
                            <div class="progress mb-2">
                                <div class="progress-bar {{ $goal->progress >= 100 ? 'bg-success' : '' }}" role="progressbar"
                                     style="width: {{ number_format($goal->progress, 2) }}%"
                                     aria-valuenow="{{ number_format($goal->progress, 2) }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($goal->progress, 2) }}%
                                </div>
                            </div>
                            <p class="card-text">
                                Target Date: {{ $goal->target_date }}
                            </p>
                            <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete Goal #{{$goal->id}}?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <span class="mx-auto"><p>No goals set yet.</p></span>
            @endforelse
        </div>
    </div>
@endsection
