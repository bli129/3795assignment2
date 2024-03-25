@extends('layouts.master')
@include('partials._navbar')
@include('layouts.footer')

@section('title', 'List of Buckets')

@section('content')
<h2>Buckets</h2>

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
                <a href="{{ route('buckets.edit', $bucket->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('buckets.destroy', $bucket->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>                                                                                                       
            </td>            
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
{{ $buckets->links() }}
@endsection
