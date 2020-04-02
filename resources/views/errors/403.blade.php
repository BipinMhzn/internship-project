@extends('layouts.app')

@section('content')
    <div class="error-wrapper">
        <div class="content-wrapper col-light text-center">
            <h2>403</h2>
            <h3>Access denied</h3>
            <p>The page or resources you were trying to reach is absolutely forbidden for some reasons</p>
            <a href="/home" class="btn btn-theme">Dashboard</a>
        </div>
    </div>
@endsection
