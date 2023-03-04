@extends('layouts.app')

@section('title', 'Edit Vehicle')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<form action="/vehicle-edit/{{ $vehicle->slug }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                    <a href="/vehicle" class="btn btn-sm btn-secondary shadow-sm mb-3"><span>Back</span></a>
                    <div class="form-group">
                        <label for="">Vehicle Name</label>
                        <input type="text" class="form-control" id="vehicle_name"
                        name="vehicle_name" value="{{ $vehicle->vehicle_name }}">
                    </div>

                    <div class="form-group">
                        <label for="">Vehicle Number Plate</label>
                        <input type="text" class="form-control" id="number_plate"
                        name="number_plate" value="{{ $vehicle->number_plate }}">
                    </div>

                    <div class="form-group">
                        <label for="category">Category Vehicle</label>
                        <select name="categories[]" id="category" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label for="currentCategories">Current Category Vehicle</label>
                        <ul>
                            @foreach ($vehicle->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="form-group">
                        <label for="image">Picture</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="form-group">
                        <label for="currentImage" style="display:block">Current Picture</label>
                        @if ($vehicle->picture != '')
                            <img src="{{ asset('storage/vehiclePic/'.$vehicle->picture) }}" alt="" width="300px">
                        @else
                            <img src="{{ asset('images/picture-not-found.jpg') }}" alt="" width="300px">
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
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