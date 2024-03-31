@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('title', 'List of Buckets')

@section('content')
<div class = "text-center" style="margin: 40px;  ">
<h2 style="font-size: 3rem;">Buckets</h2>
</div>

<!-- Add Bucket Button -->
<a href="{{ route('buckets.create') }}" class="btn btn-success mb-3">Add Bucket</a>

<!-- Table for displaying buckets -->
<table class="table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Vendor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($buckets as $bucket)
        <tr>
            <td>{{ $bucket->category }}</td>
            <td>{{ $bucket->vendor }}</td>
            <td>
                <a href="{{ route('buckets.edit', $bucket->id) }}" class="btn btn-edit-custom">Edit</a>
                <form action="{{ route('buckets.destroy', $bucket->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete-custom" onclick="return confirm('Are you sure?')">Delete</button>
                </form>                                                                                                       
            </td>            
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
{{ $buckets->links() }}
@endsection

@section('styles')
<style>
    .btn-delete-custom {
        background-color: #d3ab9e; /* The unique color you want for this Delete button */
        border-color: #E9EDC9; /* Optional: set the border color */
        /* Other styles if needed */
        color: rgb(0, 0, 0)
    }
    .btn-delete-custom:hover {
        background-color: #d3ab9e; /* A slightly darker shade for hover state */
        border-color: #d0d3a2;
        /* Other hover styles if needed */
    }

    .btn-edit-custom{
        background-color: #eac9c1; /* The unique color you want for this Edit button */
        border-color: #E9EDC9; /* Optional: set the border color */
        /* Other styles if needed */
        color: rgb(0, 0, 0)
    }

</style>
@endsection
