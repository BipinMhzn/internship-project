$(document).ready(function () {
    function on_click_paginate(name = null, place = null) {
        $('li.page-item a.page-link').on('click', function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            let page = url.split('page=')[1];
            let start_date = url.split('start_date=')[1];
            let end_date = url.split('end_date=')[1];
            get_events(page, start_date, end_date, name, place);
        });
    }

    on_click_paginate();

    function on_click_filter() {
        $('#filter').on('click', function (event) {
            event.preventDefault();
            let page = 1;
            let start_date = ($('#start-date').val() == '') ? 'null' : $('#start-date').val();
            let end_date = ($('#end-date').val() == '') ? 'null' : $('#end-date').val();
            if (start_date != "null") {
                if (end_date != "null" && end_date < start_date) {
                    $('.date-error').css("visibility", "visible");
                    $('#end_date').addClass("is-invalid");
                    setTimeout(function () {
                        $('.date-error').css("visibility", "hidden");
                        $('#end_date').removeClass("is-invalid");
                    }, 2000);
                }
                get_events(page, start_date, end_date);
            } else {
                $('.filter-error').css("visibility", "visible");
                $('#start-date').addClass("is-invalid");
                setTimeout(function () {
                    $('.filter-error').css("visibility", "hidden");
                    $('#start-date').removeClass("is-invalid");
                }, 2000);
            }
        });
    }

    on_click_filter();

    function on_click_name() {
        $('span.name i.fa-caret-up').click(function (event) {
            event.preventDefault();
            let page = 1;
            let start_date = ($('#start-date').val() == '') ? 'null' : $('#start-date').val();
            let end_date = ($('#end-date').val() == '') ? 'null' : $('#end-date').val();
            let name = 'desc';
            get_events(page, start_date, end_date, name);
        });

        $('span.name i.fa-caret-down').click(function (event) {
            event.preventDefault();
            let page = 1;
            let start_date = ($('#start-date').val() == '') ? 'null' : $('#start-date').val();
            let end_date = ($('#end-date').val() == '') ? 'null' : $('#end-date').val();
            let name = 'asc';
            get_events(page, start_date, end_date, name);
        });
    }

    on_click_name();

    function on_click_place() {
        $('span.place i.fa-caret-up').click(function (event) {
            event.preventDefault();
            let page = 1;
            let start_date = ($('#start-date').val() == '') ? 'null' : $('#start-date').val();
            let end_date = ($('#end-date').val() == '') ? 'null' : $('#end-date').val();
            let name = null;
            let place = 'desc';
            get_events(page, start_date, end_date, name, place);
        });

        $('span.place i.fa-caret-down').click(function (event) {
            event.preventDefault();
            let page = 1;
            let start_date = ($('#start-date').val() == '') ? 'null' : $('#start-date').val();
            let end_date = ($('#end-date').val() == '') ? 'null' : $('#end-date').val();
            let name = null;
            let place = 'asc';
            get_events(page, start_date, end_date, name, place);
        });
    }

    on_click_place();

    function on_click_reset() {
        $('#reset').on('click', function (event) {
            event.preventDefault();
            $('#start-date').val('');
            $('#end-date').val('').attr('disabled', 'disabled');
            $('#reset').prop('disabled', 'true');
            get_events();
        });
    }

    on_click_reset();

    function get_events(page = null, start_date = null, end_date = null, name = null, place = null) {
        $.ajax({
            url: `/api/events?page=${page}&start_date=${start_date}&end_date=${end_date}&name=${name}&place=${place}`,
            success: function (events) {
                $('#get_events').html(events);
                $(".row-clickable").click(function () {
                    window.location.href = $(this).attr('data-href');
                });
                on_click_paginate(name, place);
                on_click_filter();
                on_click_reset();
                on_click_name();
                on_click_place();
            }
        });
    }

    $('#start-date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        minYear: 1999,
        maxYear: parseInt(moment().format('YYYY')),
        startDate: "01/01/2000",
        locale: {
            cancelLabel: 'Clear'
        }
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
        if ($('#start-date').val()) {
            $('#end-date').removeAttr('disabled');
            $('#reset').removeAttr('disabled');
        }
    });

    $('#end-date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        minYear: 2000,
        maxYear: parseInt(moment().format('YYYY')) + 1,
        endDate: parseInt(moment().format('MM/DD/YYYY')),
        locale: {
            cancelLabel: 'Clear'
        }
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.endDate.format('YYYY-MM-DD'));
    });
});
