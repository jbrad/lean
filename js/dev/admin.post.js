(function ($) {
    "use strict";
    $(function () {

        // Create the notice that will appear above the post title
        /* Translators: This will need to be localized. */
        var postFormatSlides,
            $titleMessage = $('<div />')
            .attr('id', 'post-editor')
            .attr('class', 'error warning')
            .append(
                $('<p />')
                    .html('<strong>A long post title has been detected. Search engines prefer titles with 70 characters or less.</strong>')
            );

        // Display the notice if the existing title is too long ( >= 70 characters)
        if($.trim($('#title').val()).length >= 70) {
            $titleMessage.insertBefore($('#title'));
        } // end if

        // Display the notice if the user types a title that is too long ( >= 70 characters)
        $('#title').keydown(function () {

            if($.trim($(this).val()).length >= 70) {
                $titleMessage.insertBefore($('#title'));
            } else {
                $titleMessage.remove();
            } // end if

        });

        // Initially hide the link post format unless this is a Link
        if ('post-format-link' !== $('#post-formats-select').children(':checked').attr('id')) {
            $('#link_format_url').hide();
        } // end if

        // Monitor which post format is selected
        $('#post-formats-select').children()
            .click(function () {

                // If the link post format is selected, toggle the visibility
                if ('post-format-link' === $(this).attr('id')) {
                    $('#link_format_url').show();
                } else {
                    $('#link_format_url').hide();
                } // end if/else

            });

        postFormatSlides = $('.post-type-slides');
        postFormatSlides.find('#postexcerpt').find('span').html('Slide Caption');
        postFormatSlides.find('#pageparentdiv').find('span').html('Slide Attributes');
        postFormatSlides.find('#postimagediv').find('span').html('Slide Image');
        postFormatSlides.find('#remove-post-thumbnail').text('Remove Slide Image');

    });
}(jQuery));