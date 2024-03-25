@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('title', 'List of Transactions')

@section('content')
<div class="container mt-4">
    <h2>Transactions</h2>

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
                <button class="btn btn-outline-secondary" type="submit">Import Transactions</button>
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
                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
