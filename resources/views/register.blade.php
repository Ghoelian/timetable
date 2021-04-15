@extends('layouts.head')

@section('title', 'Register')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-form-label">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required />
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-form-label">Email Address</label>

                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required />
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-form-label">Password</label>

                                <input id="password" type="password" class="form-control" name="password" required />
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
