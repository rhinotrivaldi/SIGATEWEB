@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicle</h6>
    </div>
    <div class="card-body">
        <div class="md-3">
            @if (session('message'))
            <div class="alert {{ session('alert-class') }}">
                {{ session('status') }}
            </div>
            @endif
        </div>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number Plate</th>
                    <th>Picture</th>
                    <th>Position Status</th>
                    <th>Period Date</th>
                    <th>Active Hour</th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($vehicles as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->vehicle->vehicle_name }}</td>
                        <td>{{ $item->vehicle->number_plate }}</td>
                        <td>
                            <div class="form-group">
                                @if ($item->vehicle->picture != '')
                                    <img src="{{ asset('storage/vehiclePic/'.$item->vehicle->picture) }}"
                                    alt="" width="150px">
                                @else
                                    <img src="{{ asset('images/picture-not-found.jpg') }}" alt="" width="150px">
                                @endif
                            </div>
                        </td>
                        <td>{{ (Str::upper($item->vehicle->status))}}</td>
                        <td>
                            @if ($item->vehicle->period_date != '')
                                {{ $item->vehicle->period_date }}
                            @else
                            -
                            @endif
                        </td>
                        <td>@if ($item->vehicle->active_hour != '')
                            {{ $item->vehicle->active_hour }}
                        @else
                        -
                        @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicle Logs</h6>
    </div>
    <div class="card-body">
        <div class="md-3">
            @if (session('message'))
            <div class="alert {{ session('alert-class') }}">
                {{ session('status') }}
            </div>
            @endif
        </div>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Number Plate</th>
                    <th>In Date</th>
                    <th>Out Date</th>
                    <th>Status</th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($logs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->vehicle->number_plate }}</td>
                            <td>{{ $item->in_date }}</td>
                            <td>{{ $item->out_date }}</td>
                            <td>{{ $item->vehicle->status }}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection