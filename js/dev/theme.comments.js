(function($) {
    "use strict";
    $(function () {

        var $gravatar,
            sDefaultImageUrl,
            sUrl,
            $respond;

        // Grab a reference to the gravatar container and its default image
        $gravatar = $('#comment-form-avatar').children('img');
        sDefaultImageUrl = $gravatar.attr('src');

        // When the focus blurs from the field, update the gravatar
        $('#email').blur(function() {

            if( '' === $(this).val() ) {
                $gravatar.attr('src', sDefaultImageUrl);
            } else {
                sUrl = 'http://www.gravatar.com/avatar/' + md5( $(this).val() ) + '?d=' + sDefaultImageUrl;
                $gravatar.attr('src', sUrl);
            }

        });

        $respond = $('#respond');

        if($respond.length > 0) {
            $respond.find('#reply-title')
                .removeClass('comment-reply-title')
                .addClass('page-header');
        }
    });
}(jQuery));