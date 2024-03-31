@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('title', 'List of Transactions')

@section('content')
<div class="container mt-4">
    <div class="text-center">
    <h2 >Transactions</h2>
    </div>

    <!-- Success & Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Upload Transactions Button/Form -->
    <div class="mb-3">
        <form action="{{ route('transactions.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="transaction_file" name="transaction_file" required>
                <button class="btn btn-outline-custom" type="submit">Import Transactions</button>
            </div>
        </form>
    </div>

    <!-- Add Transaction Button -->
    <div class="mb-3">
        <a href="{{ route('transactions.create') }}" class="btn btn-success">Add Transaction</a>
    </div>

    <!-- Table for displaying transactions -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Vendor</th>
                <th>Withdraw</th>
                <th>Deposit</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->date }}</td>
                <td>{{ $transaction->vendor }}</td>
                <td>{{ $transaction->withdraw }}</td>
                <td>{{ $transaction->deposit }}</td>
                <td>{{ $transaction->balance }}</td>
                <td>
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-edit-custom">Edit</a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-delete-custom" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <!-- TODO: Parin plz fix the styling. Might have to modify master.blade.php -->
    <div class="d-flex justify-content-center">
        {{ $transactions->links() }}
    </div>
</div>
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

    .btn-outline-custom{
        background-color: #ccd5ae; /* The unique color you want for this Edit button */
      
    }

</style>
@endsection