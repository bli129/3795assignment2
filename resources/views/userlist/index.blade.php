@extends('layouts.master')
@include('partials._navbar')
{{-- @include('layouts.footer') --}}

@section('content')
<div class="container mt-4">
    <h2>User List</h2>
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->Email }}</td>
                <td>{{ $user->Status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <form action="{{ route('userlist.updateStatus', $user->UserId) }}" method="POST" class="d-inline">
                        @csrf
                        @if($user->Status == 0)
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-sm btn-custom ">Approve</button>
                        @else
                            <input type="hidden" name="status" value="0">
                            <button  type="submit" class="btn btn-sm btn-custom ">Revoke</button>
                        @endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

