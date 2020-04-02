$(document).ready(function () {
    function on_click_paginate() {
        $('a.page-link').on('click', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let page = url.split('page=')[1];
            let start_date = url.split('start_date=')[1];
            let end_date = url.split('end_date=')[1];
            let name = url.split('name=')[1];
            let address = url.split('address=')[1];
            get_survey(page, start_date, end_date, name, address);
        });
    }

    on_click_paginate();

    function on_click_filter() {
        $('#filter').on('click', function (e) {
            e.preventDefault();
            let page = 1;
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();
            if (start_date != '') {
                if (end_date != '' && end_date < start_date) {
                    $('.date-error').css("visibility", "visible");
                    $('#end_date').addClass("is-invalid");
                    setTimeout(function () {
                        $('.date-error').css("visibility", "hidden");
                        $('#end_date').removeClass("is-invalid");
                    }, 2000);
                }
                get_survey(page, start_date, end_date);
            } else {
                $('.filter-error').css("visibility", "visible");
                $('#start_date').addClass("is-invalid");
                setTimeout(function () {
                    $('.filter-error').css("visibility", "hidden");
                    $('#start_date').removeClass("is-invalid");
                }, 2000);
            }
        });
    }

    on_click_filter();

    function on_click_reset() {
        $('#reset').on('click', function (e) {
            e.preventDefault();
            $('#start_date').val('');
            $('#end_date').val('').prop('disabled', 'true');
            $('#reset').prop('disabled', 'true');
            get_survey();
        });
    }

    on_click_reset();

    function on_click_name() {
        $('span.name i.fa-caret-up').on('click', function (e) {
            e.preventDefault();
            let page = 1;
            let start_date = $('#start_date').val() == '' ? 'null' : $('#start_date').val();
            let end_date = $('#end_date').val() == '' ? 'null' : $('#end_date').val();
            let name = 'asc';
            get_survey(page, start_date, end_date, name);
        });

        $('span.name i.fa-caret-down').on('click', function (e) {
            e.preventDefault();
            let page = 1;
            let start_date = $('#start_date').val() == '' ? 'null' : $('#start_date').val();
            let end_date = $('#end_date').val() == '' ? 'null' : $('#end_date').val();
            let name = 'desc';
            get_survey(page, start_date, end_date, name);
        });
    }

    on_click_name();

    function on_click_address() {
        $('span.address i.fa-caret-up').on('click', function (e) {
            e.preventDefault();
            let page = 1;
            let start_date = $('#start_date').val() == '' ? 'null' : $('#start_date').val();
            let end_date = $('#end_date').val() == '' ? 'null' : $('#end_date').val();
            let name = 'null';
            let address = 'asc';
            get_survey(page, start_date, end_date, name, address);
        });

        $('span.address i.fa-caret-down').on('click', function (e) {
            e.preventDefault();
            let page = 1;
            let start_date = $('#start_date').val() == '' ? 'null' : $('#start_date').val();
            let end_date = $('#end_date').val() == '' ? 'null' : $('#end_date').val();
            let name = 'null';
            let address = 'desc';
            get_survey(page, start_date, end_date, name, address);
        });
    }

    on_click_address();

    function get_survey(page = null, start_date = null, end_date = null, name = null, address = null) {
        $.ajax({
            url: `/api/surveys?page=${page}&start_date=${start_date}&end_date=${end_date}&name=${name}&address=${address}`,
            success: function (womens) {
                $('#survey_data').html(womens);
                $('.row-clickable').on('click', function () {
                    window.location.href = $(this).attr('data-href');
                });
                on_click_paginate();
                on_click_filter();
                on_click_name();
                on_click_address();
                on_click_reset();
            }
        });
    }

    $('#start_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        minYear: 1999,
        maxYear: parseInt(moment().format('YYYY')) + 1,
        startDate: "2000-01-01",
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear'
        }
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
        $('#end_date').removeAttr('disabled');
        $('#reset').removeAttr('disabled');
    });

    $('#end_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        maxYear: parseInt(moment().format('YYYY')) + 1,
        autoUpdateInput: false,
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear'
        }
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.endDate.format('YYYY-MM-DD'))
    });
});
