/*global infiniteScroll */
/*global md5 */

(function($) {
    "use strict";
    $(function() {

        var shareDaddySelector = '.sharedaddy.sd-sharing-enabled',
            leftOrRight,
            sharingPosition,
            shareDaddyPlus = '.sd-gplus';

        if ( $(shareDaddySelector).length ) {

            $('.sd-sharing-enabled .sd-social .sd-content ul').addClass('list-unstyled').find('li').removeAttr('class');

            $('.sd-sharing-enabled .sd-social .sd-content').find('a').each(function () {
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

            if (window.outerWidth > 800 && $('.single').length > 0 ) {

                if ( $('.col-md-push-4').length ) {
                    leftOrRight = 'right';
                    sharingPosition = (window.outerWidth - $('aside').width() - $('article').width() - $('aside').offset().left) / 2;
                } else {
                    leftOrRight = 'left';
                    sharingPosition = $('article').offset().left - 60;
                }

                $('.sd-sharing-enabled .sd-title').remove();
                $('.sd-sharing-enabled .sd-content').css('position', 'fixed')
                    .css('top', '30%')
                    .css(leftOrRight, sharingPosition)
                    .css('z-index', '5');

                $('.sd-sharing-enabled').removeClass('sharedaddy');

                $(shareDaddySelector).insertAfter('.post');
                $('.sd-sharing-enabled .sd-title').addClass('page-header');
            } else {
                $('.sd-sharing-enabled .sd-social .sd-content ul').removeClass('list-unstyled').addClass('nav nav-pills');
            }
        }

        if ( $('.author-box').length > 0 ) {
            var googlePlusLink = $('.gplus-profile').attr('href');
            var googlePlusIcon = '.icn-gplus';

            if ( $(googlePlusIcon).length > 0 ) {
                $(googlePlusIcon).attr('href', googlePlusLink);
            } else {
                $('.author-box ul').append('<li><a class="author-link icn-gplus" rel="author" href="' + googlePlusLink + '" title="Google+" target="_blank"><span class="fa fa-google-plus"></span> Google+</a></li>');
            }

            $(shareDaddyPlus).remove();
        } else {
            $('.sd-gplus .sd-title').addClass('page-header');
        }

        $('.jp-relatedposts-headline').removeClass()
            .addClass('page-header')
            .html('Related Posts');

        setTimeout(function () {
            $('.jp-relatedposts-items').removeClass()
                .addClass('row');

            $('.jp-relatedposts-post').removeClass()
                .addClass('col-sm-4');
        }, 1000);

        $('.jp-relatedposts').removeClass().insertAfter(shareDaddySelector);

        $(shareDaddyPlus).insertAfter(shareDaddySelector);

    });
}(jQuery));