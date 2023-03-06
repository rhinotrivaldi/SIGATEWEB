@extends('layouts.app')

@section('title', 'Vehicle')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicle List</h6>
    </div>
    <div class="card-body">
        <div class="md-3">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
        </div>
        <a href="vehicle-add" class="btn btn-sm btn-primary shadow-sm mb-3"><span>Add Vehicle</span></a>
        <a href="vehicle-delete" class="btn btn-sm btn-secondary shadow-sm mb-3"><span>View Deleted Vehicle</span></a>
        <form action="" method="get">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <select name="category" id="" class="form-control mb-3">
                        <option value="">Select Category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6" >
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search"
                        placeholder="Search" aria-describedby="basic-addon2">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Owner</th>
                        <th>Vehicle Name</th>
                        <th>Vehicle Number Plate</th>
                        <th>Category</th>
                        <th>Picture</th>
                        <th>Position Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @foreach ($item->users as $user)
                                    {{ $user->name }}
                                @endforeach
                            </td>
                            <td>{{ $item->vehicle_name }}</td>
                            <td>{{ $item->number_plate }}</td>
                            <td>
                                @foreach ($item->categories as $category)
                                    - {{ $category->name }} <br>
                                @endforeach
                            </td>
                            <td>
                                <div class="form-group">
                                    @if ($item->picture != '')
                                        <img src="{{ asset('storage/vehiclePic/'.$item->picture) }}"
                                        alt="" width="150px">
                                    @else
                                        <img src="{{ asset('images/picture-not-found.jpg') }}" alt="" width="150px">
                                    @endif
                                </div>
                            </td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="/vehicle-edit/{{$item->slug}}" class="btn btn-warning btn-icon-split">
                                    <span class="text">Edit</span></a>
                                <a href="/vehicle-delete/{{$item->slug}}" class="btn btn-danger btn-icon-split"
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
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete vehicle?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are ready to delete your vehicle.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-secondary" href="vehicle-delete/{{ $item->slug }}">delete</a>
                </div>
            </div>
        </div>
    </div>

@endsection