@extends('layouts.app')

@section('title', 'Token | API Key')

@section('content')

<form action="{{ route('create-token') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Token | API Key</h6>
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
                    @foreach ($tokens as $item)
                    <div class="form-group">
                        <label for="">Token</label>
                        <label for="" class="form-control">{{ $item->token }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="submit" name="submit" value="create"
                        class="btn btn-primary">Generate New Token</button>
                    <button type="submit" name="submit" value="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection