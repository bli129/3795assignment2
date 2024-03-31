@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('title', 'Create Bucket')

@section('content')
<div class="container mt-5 text-center">
    <h2>Add New Bucket</h2>
    <form action="{{ route('buckets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>

        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor</label>
            <input type="text" class="form-control" id="vendor" name="vendor" required>
        </div>

        <button type="submit" class="btn btn-custom">Submit</button>
    </form>
</div>
@endsection
