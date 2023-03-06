@extends('layouts.app')

@section('title', 'Add Vehicle')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<form action="/vehicle-add" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Add Vehicle</h6>
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
                    <a href="vehicle" class="btn btn-sm btn-secondary shadow-sm mb-3"><span>Back</span></a>
                    <div class="form-group">
                        <label for="user">User Vehicle</label>
                        <select name="users[]" id="user" class="form-control">
                            <option value="">Select User</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vehicle_name">Vehicle Name</label>
                        <input type="text" class="form-control" id="vehicle_name" name="vehicle_name"
                            value="{{ old('vehicle_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="number_plate">Vehicle Number Plate</label>
                        <input type="text" class="form-control" id="number_plate" name="number_plate">
                    </div>

                    <div class="form-group">
                        <label for="category">Category Vehicle</label>
                        <select name="categories[]" id="category" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="">Picture</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#category').select2({
        multiple:true,
        allowClear: true
    });
</script>

@endsection