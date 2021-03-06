@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-7">
                    <h2 class="page-title">Register New User</h2>
                </div>
                <div class="col-md-5 v-align">
                    <a href="{{ url()->previous() }}" class="link float-right mt-2">< Back to users</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mr-md-auto">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>

                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="Enter User Name" required autocomplete="name" autofocus>

                            @error('name')
                            <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">Email Address</label>

                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="Enter Email Address" required autocomplete="email">

                            @error('email')
                            <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-form-label">Role</label>

                            <select name="role" id="role" class="form-control">
                                <option value="">--- Select a role ---</option>
                                <option value="1">Manager</option>
                                <option value="2">Employee</option>
                            </select>

                            @error('role')
                                <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-theme btn-lg">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
