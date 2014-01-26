/*global infiniteScroll */
/*global md5 */

/**
 * Resizes the videos on page load, when the browser is resized,
 * and when Infinite Scroll is activated.
 */
function resizeVideos($) {
    "use strict";

    // FitVid
    $('.entry-content, .comment-text').fitVids();

    // Look to see if there are any video wrappers from FitVid
    if(0 < $('.fluid-width-video-wrapper').length) {

        // For each video wrapper, we only want to change the styles if the video is posted alone (without text)
        $('.fluid-width-video-wrapper').each(function() {

            // First, clear the margin on the video itself
            $(this).css('margin', 0);

            // Next, if the video is the only content, we can remove both margin and padding
            if(0 === $(this).parents('p').siblings().length) {

                $(this)
                    .parents('p')
                    .css({ margin: 0, padding: 0 });

            } // end if

        });

    } // end if

} // end resizeVideos

/* ---------------------------------------------------------------- *
 * Post-page load functionality
 * ---------------------------------------------------------------- */

(function($) {
    "use strict";
    $(function() {

        var iHeaderHeight, iWidgetHeight, iMargin, bCmdDown;

        // Properly position the header widget, but only do so after the window is loaded
        if( 1 === $('.header-widget').length && 1 === $('#logo').length ) {

            $(window).load(function() {

                // Get the header and the widget heights
                iHeaderHeight = parseInt($('#hgroup').height(), 10);
                iWidgetHeight = parseInt($('.header-widget').height(), 10);

                // Calculate the margins based on the size of the header and the widget
                if(iHeaderHeight > iWidgetHeight) {
                    iMargin = ( iHeaderHeight / 2 ) - ( iWidgetHeight / 2 );
                } else {
                    iMargin = ( iWidgetHeight / 2 ) - ( iHeaderHeight / 2 );
                } // end if/else

                $('.header-widget').css('margin-top', iMargin);

            });

        } // end if

        // If the Activity Widget is present, activate the first tab
        if($('.tabbed-widget').length > 0) {

            $('.nav-tabs').children('li:first')
                .addClass('active');

            $('.tab-content').children('.tab-pane:first')
                .addClass('active');

        } // end if

        // Add form-control class to all inputs
        $('form input, form textarea').addClass('form-control');
        $('form input[type="submit"]').removeClass('form-control');

        $('.form-submit #submit').addClass('btn');
        $('input[type="submit"]').addClass('btn');

        // Hide pagination controls if infiniteScroll is on
        if( 'object' === typeof infiniteScroll ) {
            $('#post-nav').hide();
        } // end if

        // Resize videos properly
        resizeVideos($);

        // If there is no content below the link container, then kill the margin
        if(0 === $('.format-link .entry-content').children('p').length) {
            $('.format-link .entry-content').css({
                marginTop: 0,
                paddingBottom: 0
            });
        } // end if

        // Change up sharedaddy

        if ( $('.sharedaddy').length ) {

            $('.sd-content ul').addClass('nav nav-pills').find('li').removeAttr('class');

            $('.sd-content').find('a').each(function () {
                $(this).removeClass('sd-button share-icon');
            });

            $('a.share-facebook').addClass('fa fa-facebook-square');
            $('a.share-twitter').addClass('fa fa-twitter-square');
            $('a.share-linkedin').addClass('fa fa-linkedin-square');
            $('a.share-google-plus-1').addClass('fa fa-google-plus-square');
            $('a.share-pinterest').addClass('fa fa-pinterest-square');
            $('a.share-email').addClass('fa fa-envelope-o');
            $('a.share-print').addClass('fa fa-print');
            $('a.share-tumblr').addClass('fa fa-tumblr');
            $('a.share-pocket').addClass('fa fa-caret-square-o-down');
            $('a.share-reddit').addClass('fa fa-group');
            $('a.share-stumbleupon').addClass('fa fa-external-link');
            $('a.share-digg').addClass('fa fa-thumbs-o-up');
        }

        $('table').addClass('table table-bordered').wrap('<div class="table-responsive">');

    });
}(jQuery));