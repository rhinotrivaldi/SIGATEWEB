@extends('layouts.app')

@section('title', 'User')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
    </div>
    <div class="card-body">
        <div class="md-3">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div> 
            @endif
        </div>
        <a href="{{ route('user-add') }}" class="btn btn-sm btn-primary shadow-sm mb-3"><span>Add User</span></a>
        <a href="{{ route('user-registered') }}" class="btn btn-sm btn-secondary shadow-sm mb-3">
            <span>New Register User</span></a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                {{ $item->role_id == 1 ? 'Administrator' : 'User' }}
                            </td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="user-edit/{{ $item->slug }}" class="btn btn-warning btn-icon-split">
                                    <span class="text">Edit</span></a>
                                <a href="user-delete/{{ $item->slug }}" class="btn btn-danger btn-icon-split"
                                    data-toggle="modal" data-target="#deleteModal"><span class="text">Delete</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete category?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are ready to delete your category.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-secondary" href="category-delete/{{ $item->slug }}">delete</a>
                </div>
            </div>
        </div>
    </div>

@endsection