@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="brand mt-5 mb-5 text-center">
            <h1>WYESHR</h1>
        </div>
        <div class="justify-content-center login-control">
            <div class="offset-md-3 col-md-6">
                <div class="card">
                    <div class="card-header text-center">Reset Password</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="col-form-label">
                                    {{ __('Username') }}
                                </label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Email address" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-theme btn-block">
                                    Send Password Reset Link
                                </button>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('login') }}" class="btn btn-outline-theme btn-block">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
