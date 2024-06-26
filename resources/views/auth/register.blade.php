@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" aria-label="Close" onclick="dismissAlert('errorAlert')"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Repeat Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
