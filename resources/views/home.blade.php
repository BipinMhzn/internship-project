@extends('layouts.app')

@section('content')
    <section class="main-content w-100">
        <div class="container-fluid">
            <div class="row dashboard-cards mb-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body brand">
                                    <h4 class="count">{{ $total_womens }}</h4>
                                    <span>Total Surveyed Women</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body brand">
                                    <h4 class="count">{{ $average_motherhood }}</h4>
                                    <span>Average Age of First Motherhood</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body brand">
                                    <h4 class="count">{{ $average_marriage_age }}</h4>
                                    <span>Average Marriage Age</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body brand">
                                    <h4 class="count">{{ $know_about_child_marriage }}</h4>
                                    <span>Knows about Child Marriage</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body brand">
                                    <h4 class="count">{{ $total_events }}</h4>
                                    <span>Total Events Conducted</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card-body brand">
                                    <h4 class="count">{{ $average_participants }}</h4>
                                    <span>Average Participants in Events</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row dashboard-fields">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3 offset-9" id="legend"></div>
                    </div>
                    <div id="bar"></div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-9 mb-2"><h5>Latest Events Conducted</h5></div>
                        <div class="col-md-3 mb-2"><a href="/event">View All</a></div>
                    </div>
                    <ul class="list-group mb-4">
                        @foreach($events as $event)
                            <li class="list-group-item">
                                <p>{{ $event->name }}</p>
                                <span><i class="fa fa-calendar brand"></i> {{ $event->date }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer-scripts')
    <script src="{{ asset('js/counter.js') }}"></script>
    <script>
        let marriage_count = @json($marriage_count);
        let child_marriage_count = @json($child_marriage_count);

        if (marriage_count !== 0 && child_marriage_count !== 0) {
            let years = Object.keys(marriage_count);
            let marriage_data = Object.values(marriage_count);
            let child_marriage_data = Object.values(child_marriage_count);

            const margin = {
                top: 5,
                bottom: 50,
                left: 15,
                right: 20,
            };

            let svg = d3.select("div#bar")
                .append("svg")
                .attr("preserveAspectRatio", "xMinYMin meet")
                .attr("viewBox", "0 0 1000 400")
                .classed("svg-content", true);

            const innerWidth = 1000 - margin.left - margin.right;
            const innerHeight = 400 - margin.top - margin.bottom;

            const xScale = d3.scaleBand()
                .domain(d3.range(years.length))
                .range([0, innerWidth])
                .padding(0.2);

            const yScale = d3.scaleLinear()
                .domain([0, d3.max(marriage_data)])
                .range([0, innerHeight - margin.top]);

            let x = d3.scaleBand()
                .domain(years.map(num => num))
                .range([0, innerWidth]);

            let y = d3.scaleLinear()
                .domain([0, d3.max(marriage_data)])
                .range([innerHeight, margin.top]);

            const g = svg.append('g')
                .attr("transform", "translate(" + margin.left + ", 0)");

            let bar = g.selectAll("rect")
                .data(marriage_data)
                .enter()
                .append("rect")
                .attr("class", "rect")
                .attr("x", function (d, i) {
                    return xScale(i);
                })
                .attr("y", function (d) {
                    return innerHeight - yScale(d);
                })
                .attr("width", xScale.bandwidth())
                .attr("height", function (d) {
                    return yScale(d);
                });

            svg.append("g")
                .attr("transform", "translate(" + margin.left + "," + (innerHeight) + ")")
                .call(d3.axisBottom(x))
                .selectAll("text")
                .attr("transform", "translate(-12,10)rotate(-90)")
                .style("text-anchor", "end")
                .style("font-size", 10)
                .style("fill", "#606d6e");

            svg.append("g")
                .attr("transform", "translate(" + (margin.left) + ", 0)")
                .call(d3.axisLeft(y)
                    .tickFormat(function (e) {
                        if (Math.floor(e) != e) {
                            return;
                        }
                        return e;
                    }))
                .selectAll("text")
                .style("font-size", 10)
                .style("fill", "#606d6e");

            svg.append("text")
                .attr("text-anchor", "end")
                .attr("x", innerWidth / 2)
                .attr("y", innerHeight + margin.bottom)
                .text("Child marriage survey year");

            let line = d3.line()
                .x(function (d, i) {
                    return xScale(i);
                })
                .y(function (d) {
                    return innerHeight - yScale(d);
                })
                .curve(d3.curveMonotoneX);

            g.append("path")
                .datum(child_marriage_data)
                .attr("class", "line")
                .attr("d", line)
                .attr("transform", "translate(8,0)");

            g.selectAll(".dot")
                .data(child_marriage_data)
                .enter().append("circle")
                .attr("class", "dot")
                .attr("cx", function (d, i) {
                    return xScale(i);
                })
                .attr("cy", function (d) {
                    return innerHeight - yScale(d);
                })
                .attr("r", 4)
                .attr("transform", "translate(8,0)");

            let legend = d3.select("div#legend")
                .append("svg")
                .attr("preserveAspectRatio", "xMinYMin meet")
                .attr("viewBox", "0 0 400 60");

            legend.append("rect").attr("x", margin.left).attr("y", 5).attr("height", "20").attr("width", "20").style("fill", "#003178");
            legend.append("rect").attr("x", margin.left).attr("y", 30).attr("height", "20").attr("width", "20").style("fill", "#ffdd00");
            legend.append("text").attr("x", margin.left + 25).attr("y", 15).text("Total number of marriages").style("font-size", "20px").attr("alignment-baseline", "middle");
            legend.append("text").attr("x", margin.left + 25).attr("y", 40).text("Total number of child marriages").style("font-size", "20px").attr("alignment-baseline", "middle");
        }
    </script>

@endpush
