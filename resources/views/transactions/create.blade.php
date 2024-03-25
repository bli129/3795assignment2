@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('title', 'Create Transaction')

@section('content')
<div class="container mt-5">
    <h2>Add New Transaction</h2>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf <!-- CSRF token for security -->

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="mb-3">
            <label for="vendor" class="form-label">Vendor</label>
            <input type="text" class="form-control" id="vendor" name="vendor" required>
        </div>

        <div class="mb-3">
            <label for="withdraw" class="form-label">Withdraw</label>
            <input type="number" class="form-control" id="withdraw" name="withdraw" step="0.01">
        </div>

        <div class="mb-3">
            <label for="deposit" class="form-label">Deposit</label>
            <input type="number" class="form-control" id="deposit" name="deposit" step="0.01">
        </div>

        {{-- <div class="mb-3">
            <label for="balance" class="form-label">Balance</label>
            <input type="number" class="form-control" id="balance" name="balance" step="0.01" required>
        </div> --}}

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
