@extends('layouts.master')
@include('layouts.footer')

@section('title', 'Login')

@section('content')
<div class="container mt-5 text-center">
    <h2 style="margin: 50px;">Login</h2>
    <!-- Display general session error if available -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <!-- Display validation errors if available -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-custom">Login</button>
        <!-- Button to redirect to registration page -->
        <a href="{{ route('registration.index') }}" class="btn btn-custom">Register New User</a>
    </form>
</div>
@endsection
