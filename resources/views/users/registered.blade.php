@extends('layouts.app')

@section('title', 'New User Register')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">New User List</h6>
    </div>
    <div class="card-body">
        <div class="md-3">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div> 
            @endif
        </div>
        <a href="{{ route('user') }}" class="btn btn-sm btn-primary shadow-sm mb-3"><span>Registered User</span></a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newUsers as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="/user-approve/{{ $item->slug }}" class="btn btn-success btn-icon-split">
                                    <span class="text">Approve</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection