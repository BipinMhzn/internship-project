@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            <div class="row page-title">
                <div class="col-md-7">
                    <h2 class="page-title mb-4">
                        {{ $event->name }}
                    </h2>
                </div>
                <div class="col-md-5 v-align">
                    <a href="{{ url()->previous() }}" class="link float-right mt-2">< Back to events lists</a>
                </div>
            </div>

            <div class="records-section survey-details">
                <section class="detailed-rows mb-4">
                    <h5 class="list-head"><i class="fa fa-dot-circle-o"></i> Details:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Id:</strong> {{ $event->id }}</li>
                        <li><strong>Name:</strong> {{ $event->name }}</li>
                        <li><strong>Place:</strong> {{ $event->place }}</li>
                        <li><strong>Date:</strong> {{ $event->date }}</li>
                        <li><strong>Prepared By::</strong> {{ $event->prepared_by }}</li>
                        <li><strong>Checked By:</strong> {{ $event->checked_by }}</li>
                        <li><strong>Approved By:</strong> {{ $event->approved_by }}</li>
                    </ul>
                </section>
            </div>

            <div class="records-section survey-details">
                <section class="detailed-rows mb-4">
                    <h5 class="list-head"><i class="fa fa-dot-circle-o"></i> Objective:</h5>
                    <p class="quoted mt-4">{{ $event->objective }}</p>
                </section>
            </div>

            <div class="records-section survey-details">
                <section class="detailed-rows mb-4">
                    @if ($participants->count() == 0)
                        <p>There are no participants right now.</p>
                    @else
                        <h5 class="list-head"><i class="fa fa-dot-circle-o"></i> Participants:</h5>
                        <div id="get_participants">
                            @include('event.partials.participants', $participants)
                        </div>
                    @endif
                </section>
            </div>

        </div>
    </section>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/event/show.js') }}"></script>
@endpush
