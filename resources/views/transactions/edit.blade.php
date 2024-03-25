@extends('layouts.master')
@include('layouts.footer')

@section('title', 'Edit Transaction')

@section('content')
<h2>Edit Transaction</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ $transaction->date }}" required>
    </div>

    <div class="mb-3">
        <label for="vendor" class="form-label">Vendor</label>
        <input type="text" class="form-control" id="vendor" name="vendor" value="{{ $transaction->vendor }}" required>
    </div>

    <div class="mb-3">
        <label for="withdraw" class="form-label">Withdraw</label>
        <input type="number" class="form-control" id="withdraw" name="withdraw" step="0.01" value="{{ $transaction->withdraw }}">
    </div>

    <div class="mb-3">
        <label for="deposit" class="form-label">Deposit</label>
        <input type="number" class="form-control" id="deposit" name="deposit" step="0.01" value="{{ $transaction->deposit }}">
    </div>

    <!-- Note: The balance field is intentionally omitted from editing -->

    <button type="submit" class="btn btn-primary">Update Transaction</button>
</form>
@endsection
