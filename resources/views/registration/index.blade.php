@extends('layouts.master')
@include('layouts.footer')

@section('title', 'Register')

@section('content')
<div class="container text-center">
    <h2 style="margin: 50px;">Register</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group text-center">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group text-center">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button style="margin: 30px;" type="submit" class="btn btn-custom">Register</button>
    </form>
</div>
@endsection
