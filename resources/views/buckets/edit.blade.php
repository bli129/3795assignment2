@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('content')
<div class="container">
    <h1>Edit Bucket</h1>
    <form action="{{ route('buckets.update', $bucket->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $bucket->category }}" required>
        </div>
        
        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor</label>
            <input type="text" class="form-control" id="vendor" name="vendor" value="{{ $bucket->vendor }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Bucket</button>
    </form>
</div>
@endsection
