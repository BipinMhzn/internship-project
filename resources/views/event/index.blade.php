@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            @if ($events->count() == 0)
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title mb-4">
                            No programs were attended
                        </h2>
                    </div>
                </div>
            @else
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h2 class="page-title">Events</h2>
                        <p>Attendance of program</p>
                    </div>
                </div>

                <div class="row filter-bar">
                    <h6 class="col-md-12">Filter By:</h6>
                    <div class="col-md-12">
                        <div class="row input-daterange mb-4">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="start_date" id="start-date"
                                           placeholder="Start Date" readonly>
                                    <div class="input-group-append">
										<span class="input-group-text">
											<i class="fa fa-calendar"></i>
										</span>
                                    </div>
                                </div>
                                <div class="filter-error text-danger">Start date is required.</div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="end_date" id="end-date"
                                           placeholder="End Date" readonly disabled>
                                    <div class="input-group-append">
										<span class="input-group-text">
											<i class="fa fa-calendar"></i>
										</span>
                                    </div>
                                </div>
                                <div class="date-error text-danger">End date must be after start date.</div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" name="filter" id="filter" class="btn btn-theme btn-block">Filter
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" name="reset" id="reset" class="btn btn-outline-theme btn-block"
                                        disabled>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @include('partials.session.success')
                <div id="get_events">
                    @include('event.partials.events', $events)
                </div>
            @endif
        </div>
    </section>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/event/index.js') }}"></script>
    <script>
        function destroy() {
            return confirm('Are you sure to delete this event?');
        }
    </script>
@endpush
