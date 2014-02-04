var views = {};

function launchMediaUploader($, evt, title, fullscreen, ad) {
    var viewId = title + _.random(0, 100),
        fileFrame = views[viewId],
        $target = $(this),
        $mediaSidebar,
        attachment,
        firstHiddenInput,
        nextHiddenInput,
        parents;

    evt.preventDefault();

    if (!fileFrame) {

        fileFrame = (wp.media.frames.file_frame = wp.media({
            title: 'Select ' + title,
            button: {
                text: 'Select ' + title
            },
            multiple: false
        }));

        fileFrame.on('ready', function () {
            if (fullscreen) {
                $('.media-sidebar').hide();
                $('.attachments').css('right', 0);
                $('.media-toolbar').css('right', 20);
            } else {
                $mediaSidebar = fileFrame.$el.find('.media-sidebar');
                if (0 === $mediaSidebar.find('.setting').length) {
                    $mediaSidebar.append(
                        '<label class="setting link"><span>Link URL</span><input class="link" type="text" data-setting="linkUrl" value=""></label>'
                    );
                }
                $('.media-sidebar').addClass('widgets-uploader');
            }
        });

        fileFrame.on('select', function () {
            attachment = fileFrame.state().get('selection').first().toJSON();
            if (ad) {
                firstHiddenInput = $target.parent().next('input[type="hidden"]');
                nextHiddenInput = firstHiddenInput.next('input[type="hidden"]');

                $target.attr('src', attachment.url);
                firstHiddenInput.val(attachment.url);
                nextHiddenInput.val(fileFrame.$el.find('.setting input.link').val());
            } else {
                parents = $target.parents('tr');

                parents.find('img').attr('src', attachment.url).show();
                parents.find('input[type=hidden]').val(attachment.url);
                parents.find('.button.delete').show();
            }
        });

        views[viewId] = fileFrame;
    }

    fileFrame.open();
}

(function ($) {
    "use strict";

    $(function() {

        $('.button.upload').unbind('click')
            .click(function(evt) {
                launchMediaUploader.call(this, $, evt, $(this).parents('tr').find('th').html(), true, false);
            }
        );

        $('.button-delete').click(function(event) {
            event.preventDefault();

            $(this).parent().find('div').find('img').attr('src', '');
            $(this).parent().find('input[type=hidden]').val('');
            $(this).hide();
        });

    });
}(jQuery));