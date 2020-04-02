@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-7">
                    <h2 class="page-title">Change Password</h2>
                </div>
                <div class="col-md-5 v-align">
                    <a href="{{ url()->previous() }}" class="link float-right mt-2">< Back to profile</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mr-md-auto">
                    <form method="POST" action="/change-password">
                        @csrf
                        <div class="form-group">
                            <label for="password" class="col-form-label">Current Password</label>
                            <input type="password" name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="Enter Current Password" required autocomplete="current-password">
                            @error('current_password')
                            <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">New Password</label>
                            <input type="password" name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   placeholder="Enter New Password" required autocomplete="new-password">
                            @error('new_password')
                            <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Confirm New Password</label>
                            <input type="password" name="new_confirm_password"
                                   class="form-control @error('new_confirm_password') is-invalid @enderror"
                                   placeholder="Re-enter New Password" required autocomplete="new-confirm-password">
                            @error('new_confirm_password')
                            <p class="text-danger mb-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-theme btn-lg">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
