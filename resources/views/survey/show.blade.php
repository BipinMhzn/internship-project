@extends('layouts.app')

@section('content')
    <section class="main-content w-100 mb-5">
        <div class="container-fluid">
            <div class="row page-title mb-4">
                <div class="col-md-7">
                    <h2 class="page-title">
                        Child Marriage Survey
                    </h2>
                </div>
                <div class="col-md-5 v-align">
                    <a href="{{ url()->previous() }}" class="link float-right mt-2">< Back to Survey List</a>
                </div>
            </div>

            <div class="records-section survey-details">
                <section class="detailed-rows mb-4">
                    <h5 class="list-head"><i class="fa fa-dot-circle-o"></i> Basic information:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Surveyed Person:</strong> {{ $women->name }}</li>
                        <li><strong>Date of Birth:</strong> {{ $women->date_of_birth }}</li>
                        <li><strong>Age:</strong> {{ $age }}</li>
                        <li><strong>Contact:</strong> {{ $women->contact }}</li>
                        <li><strong>Temporary Address:</strong> {{ $women->temporary_address }}</li>
                        <li><strong>Permanent Address:</strong> {{ $women->permanent_address }}</li>
                    </ul>
                </section>

                <section class="detailed-rows mb-4">
                    <h5 class="list-head"><i class="fa fa-dot-circle-o"></i> Health &amp; marriage details:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Age of Marriage:</strong> {{$women->MarriageDetail->age_of_marriage}}</li>
                        <li><strong>Number of Years of
                                Marriage:</strong> {{ $women->MarriageDetail->number_of_years_of_marriage }}</li>
                        <li><strong>Total Number of Children:</strong> {{ $total_children }}</li>
                        @if($total_children > 0)
                            <li><strong>Number of Sons:</strong> {{ $women->MarriageDetail->number_of_sons }}</li>
                            <li><strong>Number of Daughters:</strong> {{ $women->MarriageDetail->number_of_daughters }}
                            </li>
                            <li><strong>Number of Others:</strong> {{ $women->MarriageDetail->number_of_others }}</li>
                    </ul>
                    <div class="detail-list mb-3">
                        <table class="table table-bordered table-theme col-sm-6 col-lg-4">
                            <thead>
                            <tr>
                                <th>Child Number</th>
                                <th>Age During Child Birth</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php($number = 1)
                            @foreach( $women->MarriageDetail->AgeDuringChildBirths as $age )
                                <tr>
                                    <td>{{$number++}}</td>
                                    <td> {{$age->age_during_child_birth}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <ul class="list-unstyled">
                        @endif
                        <li><strong>Contraceptive Device
                                Used:</strong> {{ $women->HealthDetail->used_contraceptive_device  ? 'Yes': 'No'}}</li>
                        @if($women->HealthDetail->used_contraceptive_device == true)
                            <li><strong>Contraceptive Device
                                    Type:</strong> {{ $women->HealthDetail->type_of_contraceptive_device ? 'Temporary' : 'Permanent' }}
                            </li>
                            <li><strong>Contraceptive Device
                                    Information:</strong> {{ $women->HealthDetail->contraceptive_device }}</li>
                        @endif

                        <li><strong>Age of First
                                Mensuration:</strong> {{ $women->HealthDetail->age_of_first_mensuration }}</li>
                        <li><strong>Menopause:</strong> {{ $women->HealthDetail->menopause ? 'Yes' : 'No' }}</li>
                        @if(  $women->HealthDetail->menopause == true)
                            <li><strong>Age during Menopause:</strong> {{ $women->HealthDetail->age_of_menopause }}</li>
                        @endif

                        <li><strong>Health
                                Problem:</strong> {{ $women->HealthDetail->have_health_problem ? 'Yes' : 'No' }}</li>
                        @if(  $women->HealthDetail->have_health_problem == true)
                            <li><strong>Health Problem Type:</strong> {{ $women->HealthDetail->health_problem }}</li>
                        @endif
                    </ul>
                </section>

                <section class="detailed-rows mb-4">
                    <h5 class="list-head"><i class="fa fa-dot-circle-o"></i> Health and marriage details:</h5>
                    <ul class="list-unstyled">
                        <li><strong>Know Child
                                Marriage:</strong> {{ $women->ChildMarriage->know_child_marriage ? 'Yes' : 'No' }}</li>
                        @if ( $women->ChildMarriage->know_child_marriage == true)
                            <li><strong>Child Marriage:</strong> {{ $women->ChildMarriage->child_marriage }}</li>
                        @endif

                        <li><strong>Girls marry age:</strong> {{ $women->ChildMarriage->girl_marry_age }}</li>
                        <li><strong>Boys marry age:</strong> {{ $women->ChildMarriage->boy_marry_age }}</li>
                        <li><strong>Know marriage laws in
                                Nepal:</strong> {{ $women->ChildMarriage->know_marriage_laws ? 'Yes' : 'No' }}</li>
                        @if ($women->ChildMarriage->know_marriage_laws == true)
                            <li><strong>Appropriate age for marriage of girls and
                                    boys:</strong> {{ $women->ChildMarriage->marriage_laws }}</li>
                        @endif
                    </ul>
                </section>
            </div>
        </div>
    </section>
@endsection
