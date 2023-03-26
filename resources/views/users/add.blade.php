@extends('layouts.app')

@section('title', 'Add User')

@section('content')

<form action="{{ route('user-store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Add User</h6>
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
                    <a href="{{ route('user') }}" class="btn btn-sm btn-secondary shadow-sm mb-3">
                        <span>Back</span></a>

                    <div class="form-group">
                        <input name="name" type="text" class="form-control form-control-user
                            @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                                        
                    </div>

                    <div class="form-group">
                        <input name="username" type="text" class="form-control form-control-user
                        @error('username') is-invalid @enderror" id="exampleInputName" placeholder="Username">
                        @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                            
                    </div>

                    <div class="form-group">
                        <input name="email" type="email" class="form-control form-control-user
                        @error('email') is-invalid @enderror" id="exampleInputEmail"
                        placeholder="Email Address">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                            
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input name="password" type="password"
                            class="form-control form-control-user
                            @error('password') is-invalid @enderror"
                                id="exampleInputPassword" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                                
                        </div>
                        <div class="col-sm-6">
                            <input name="password_confirmation" type="password"
                            class="form-control form-control-user
                            @error('password_confirmation') is-invalid @enderror"
                                id="exampleRepeatPassword" placeholder="Repeat Password">
                            @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                                
                        </div>
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