@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-10">
                    <h2 class="page-title">Profile</h2>
                    <p>Your Profile Details</p>
                </div>
                <div class="col-md-2 text-right">
                    <a href="/profile/edit" class="btn btn-lg btn-outline-theme"">
                    <i class="fa fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>

      @include('partials.session.success')

            <div class="row mb-4">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>{{ Auth()->user()->name }}</h4>
                            </div>
                            <hr>
                            <div class="card-text mb-2">
                                <i class="fa fa-envelope-o"></i> {{ Auth()->user()->email }}
                            </div>
                            <div class="card-text mb-4">
                                <i class="fa fa-user-secret"></i>
                                @if(Auth()->user()->role == 1)
                                    Manager
                                @else
                                    Employee
                                @endif
                            </div>
                            <a href="/change-password" class="btn btn-outline-theme">
                                <i class="fa fa-key"></i> <span>Change Password</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
