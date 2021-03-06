(function ($) {
    "use strict";
    $(function () {

        var themeName = 'Lean',
            aActiveTab,
            sActiveTab,
            $menuMessage = $('<div />')
                .attr('id', 'post-editor')
                .attr('class', 'error warning')
                .append(
                    $('<p />')
                        .html('<strong>' + themeName + ' supports two levels of navigation, levels above that will not be displayed.</strong>')
                );

        $menuMessage.insertBefore($('#nav-menus-frame'));

        if($('.menu-item-depth-2').length > 0) {
            $menuMessage.show();
        } else {
            $menuMessage.hide();
        }

        // Display the notice if there are more than two levels of navigation present
        $( '#menu-to-edit' ).on( 'sortstop', function() {

            setTimeout(function() {
                if($('.menu-item-depth-2').length > 0) {
                    $menuMessage.show();
                } else {
                    $menuMessage.hide();
                }
            }, 1);

        } );

        // Hide the theme name item under the custom menu
        $('.wp-submenu-head:contains("' + themeName +'")')
            .next()
            .children(':first')
            .hide();

        aActiveTab = document.location.href.split('tab=');
        if(aActiveTab !== undefined && aActiveTab !== null && aActiveTab.length > 1) {

            sActiveTab = aActiveTab[1];

            // Global
            if(sActiveTab.indexOf('_global_') > 0) {
                $('a:contains("Global")').parent().addClass('current');
            } // end if

            // Presentation
            if(sActiveTab.indexOf('_presentation_') > 0) {
                $('a:contains("Presentation")').parent().addClass('current');
            } // end if

            // Social
            if(sActiveTab.indexOf('_social_') > 0) {
                $('a:contains("Social")').parent().addClass('current');
            } // end if

            // Presentation
            if(sActiveTab.indexOf('_publishing_') > 0) {
                $('a:contains("Publishing")').parent().addClass('current');
            } // end if

        } else {

            // If they click the top-level menu item, we'll default to Global
            /* Translators: This will need to be localized. */
            if($('a.wp-menu-open').text().toLowerCase() === themeName.toLowerCase()) {
                $('a:contains("Global")').parent().addClass('current');
            } // end if

        } // end if

    });
}(jQuery));