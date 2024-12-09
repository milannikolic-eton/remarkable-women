jQuery(document).ready(function ($) {
    let paged = 2; // Start from page 2, as page 1 is already loaded

    $('#load-more-voice').on('click', function () {
        const button = $(this);
        button.text('Loading...');

        $.ajax({
            url: load_more_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_voice_posts',
                paged: paged,
                security: load_more_params.security,
            },
            success: function (response) {
                if (response.html) {
                    $('.voice-posts').append(response.html);
                    paged++;
                    button.text('Load More');
                }

                if (!response.has_more) {
                    button.hide(); // Hide the button if no more posts
                }
            },
            error: function () {
                button.text('Error');
            },
        });
    });
});
