var views = {};

(function ($) {
    "use strict";

    $(function() {

        $('.button.upload, .preview_image').on('click', function( event ){
            var tableRow = $(this).parents('tr'),
                title = tableRow.find('th').html(),
                hiddenInput = tableRow.find('input[type=hidden]'),
                previewImage = tableRow.find('img'),
                deleteButton = tableRow.find('.button.delete'),
                viewId = $(this).attr('id'),
                file_frame = views[viewId];

            event.preventDefault();

            if ( !file_frame ) {

                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Select ' + title,
                    button: {
                        text: 'Select ' + title
                    },
                    multiple: false,
                    library: {
                        type: 'image'
                    },
                    displaySettings: true
                });

                file_frame.on( 'select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    hiddenInput.val(attachment.url);
                    previewImage.attr('src', attachment.url).show();
                    deleteButton.show();
                });

                file_frame.on('ready', function() {
                    $('.media-sidebar').hide();
                    $('.attachments').css('right', 0);
                    $('.media-toolbar').css('right', 20);
                });

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