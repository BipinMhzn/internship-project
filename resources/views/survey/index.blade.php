@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            @if ($womens->count() == 0)
                <div class="row page-title mb-4">
                    <h2 class="col-md-12">
                        No Data Collection of Child Marriage and Women Status in Province 7
                    </h2>
                </div>
            @else
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h2 class="page-title">Survey</h2>
                        <p>Data Collection of Child Marriage and Women Status in Province 7</p>
                    </div>
                </div>
                <div class="row filter-bar">
                    <h6 class="col-md-12">Filter By:</h6>
                    <form class="col-md-12">
                        <div class="row input-daterange mb-4">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="start_date" id="start_date"
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
                                    <input type="text" class="form-control" name="end_date" id="end_date"
                                           placeholder="End Date" disabled readonly>
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
                    </form>
                </div>
                @include('partials.session.success')
                <div id="survey_data">
                    @include('survey.partials.womens', $womens)
                </div>
            @endif
        </div>
    </section>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/survey/index.js') }}"></script>
    <script>
        function destroy() {
            return confirm('Are you sure to delete this women survey?');
        }
    </script>
@endpush
