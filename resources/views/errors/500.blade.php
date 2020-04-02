@extends('layouts.app')

@section('content')
    <div class="error-wrapper">
        <div class="content-wrapper col-light text-center">
            <h2>500</h2>
            <h3>Internal Server Error</h3>
            <p>Something went wrong. The server has been deserted for a while. Please be patient or try again later.</p>
            <a href="/home" class="btn btn-theme">Dashboard</a>
        </div>
    </div>
@endsection
