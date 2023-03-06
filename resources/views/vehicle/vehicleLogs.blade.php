@extends('layouts.app')

@section('title', 'Vehicle Logs')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicle Logs</h6>
    </div>
    <div class="card-body">
        <div class="md-3">
            @if (session('status'))
            <div class="alert alert-success">
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
                            <td>{{ item->user->name }}</td>
                            <td>{{ item->vehicle->number_plate }}</td>
                            <td>{{ item->in_date }}</td>
                            <td>{{ item->out_date }}</td>
                            <td>{{ item->vehicle->status }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>

    </div>
</div>

@endsection