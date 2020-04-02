$(document).ready(function () {
    function on_click_paginate(name = null) {
        $('a.page-link').on('click', function (event) {
            event.preventDefault();
            get_participants($(this).attr('href').split('page=')[1], name);
        });
    }

    on_click_paginate();

    function on_click_name() {
        $('i.fa-caret-up').click(function (event) {
            event.preventDefault();
            get_participants(1, 'desc');
        });

        $('i.fa-caret-down').click(function (event) {
            event.preventDefault();
            get_participants(1, 'asc');
        });
    }

    on_click_name();

    function get_participants(page, name = null) {
        let event_id = window.location.href.split('event/')[1];
        $.ajax({
            url: `/api/participants?page=${page}&event_id=${event_id}&name=${name}`,
            success: function (participants) {
                $('#get_participants').html(participants);
                on_click_paginate(name);
                on_click_name();
            }
        });
    }
});
