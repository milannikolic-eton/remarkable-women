jQuery(document).ready(function ($) {
    $('#stories-country-dropdown').change(function () {
        var country = $(this).val();

        $.ajax({
            url: ajax_stories.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_stories',
                country: country,
            },
            beforeSend: function () {
                $('#stories-list').html('<p>Loading...</p>');
            },
            success: function (response) {
                $('#stories-list').html(response);
            },
        });
    });
});
