@extends('layouts.app')

@section('title', 'Detail Vehicle')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Vehicle</h6>
            </div>
            <div class="card-body">
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
                            @if ($vehicle->picture != '')
                                <img src="{{ asset('storage/vehiclePic/'.$vehicle->picture) }}" alt="" width="300px">
                            @else
                                <img src="{{ asset('images/picture-not-found.jpg') }}" alt="" width="300px">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="currentUser">Owner Vehicle</label>
                            <ul>
                                @foreach ($vehicle->users as $user)
                                    <li>{{ $user->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Vehicle Data</label>
                            <ul>
                                <li>{{ $vehicle->vehicle_name }} - {{ $vehicle->number_plate }}</li>
                                @foreach ($vehicle->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Period Date</label>
                            <ul>
                                @if ($vehicle->period_date == '')
                                    <li>Belum Di Set</li>
                                @else
                                    {{ $vehicle->period_date }}
                                @endif
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Active Hour</label>
                            <ul>
                                @if ($vehicle->active_hour == '')
                                    <li>Belum Di Set</li>
                                @else
                                    {{ $vehicle->active_hour }}
                                @endif
                            </ul>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/vehicle-edit/{{$vehicle->slug}}" class="btn btn-primary btn-icon-split">
                    <span class="text">Edit</span></a>
            </div>
        </div>
    </div>
</div>

@endsection