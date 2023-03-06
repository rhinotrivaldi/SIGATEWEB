@extends('layouts.app')

@section('title', 'Dummy Logs')

@section('content')

    <div class="card-body">
        <div class="md-3">
            @if (session('message'))
            <div class="alert {{ session('alert-class') }}">
                {{ session('message') }}
            </div>
            @endif
        </div>
        
<form action="/dummy-in" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Dummy Logs In</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Name</label>
                        <select class="form-control" id="name" name="user_id">
                            <option value="">Select User</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="number_plate">Number Plate</label>
                        <select class="form-control" id="number_plate" name="vehicle_id">
                            <option value="">Select Number Plate</option>
                            @foreach ($vehicles as $item)
                                <option value="{{ $item->id }}">{{ $item->number_plate }} - 
                                    @foreach ($item->users as $user)
                                    {{ $user->name }}
                                @endforeach</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/dummy-out" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Dummy Logs Out</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Name</label>
                        <select class="form-control" id="name" name="user_id">
                            <option value="">Select User</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="number_plate">Number Plate</label>
                        <select class="form-control" id="number_plate" name="vehicle_id">
                            <option value="">Select Number Plate</option>
                            @foreach ($vehicles as $item)
                                <option value="{{ $item->id }}">{{ $item->number_plate }} - 
                                    @foreach ($item->users as $user)
                                    {{ $user->name }}
                                @endforeach</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection