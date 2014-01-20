var views = {};

(function ($) {
    "use strict";

    $(function() {

        $('.button.upload').on('click', function( event ){
            var tableRow = $(this).parents('tr'),
                title = tableRow.find('th').html(),
                hiddenInput = tableRow.find('input[type=hidden]'),
                previewImage = tableRow.find('img'),
                deleteButton = tableRow.find('.button.delete'),
                attachment,
                viewId = $(this).attr('id'),
                file_frame = views[viewId];

            file_frame = views[viewId];

            event.preventDefault();

            if ( !file_frame ) {

                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Select ' + title,
                    cid: viewId,
                    button: {
                        text: 'Select ' + title
                    },
                    multiple: false
                });

                file_frame.on( 'select', function() {
                    attachment = file_frame.state().get('selection').first().toJSON();
                    hiddenInput.val(attachment.url);
                    previewImage.attr('src', attachment.url).show();
                    deleteButton.show();
                });

                file_frame.open();

                views[viewId] = file_frame;
            }

            file_frame.open();
        });

        $('.button.delete').click(function() {
            $(this).parent().find('div').find('img').attr('src', '');
            $(this).parent().find('input[type=hidden]').val('');
            $(this).hide();
        });

    });
}(jQuery));