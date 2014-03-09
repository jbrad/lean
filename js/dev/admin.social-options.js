/**
 * Checks to see if the recommended number of icons are active. If so, displays a warning message.
 */
function checkForMaxIcons() {
    "use strict";

    // If the user has seven icons, we need to disable sorting.
    if(jQuery('#active-icon-list').children().length >= 7) {
        jQuery('#social-icon-max').removeClass('hidden');
    } else {
        jQuery('#social-icon-max').addClass('hidden');
    } // end if

} // end checkForMaxIcons 

/**
 * Updates the input field of active icons.
 *
 * @params	$	A reference to the jQuery function
 */
function updateActiveIcons($) {
    "use strict";

    var sActiveIcons = '';
    $('#active-icons ul').children('li')
        .each(function() {
            if($(this).children().length > 0) {

                // Set the image's src and url
                if($(this).children('img').attr('src').length > 0) {

                    sActiveIcons += $(this).children('img').attr('src');

                    if($(this).attr('data-url') !== undefined && $(this).attr('data-url') !== null) {
                        sActiveIcons += '|' + $(this).attr('data-url');
                    } // end if

                    sActiveIcons += ';';

                } // end if

            } // end if
        });

    $('#active-social-icons').val(sActiveIcons);

} // end updateActiveIcons

/**
 * Updates the list of active icons and available icons. Fired when sorting has been completed.
 */
function updateIconValues(evt) {
    "use strict";

    // Update the inputs to track the active icon arrangement.
    updateActiveIcons(jQuery);

    // Update the inputs to track the available icon arrangement.
    updateAvailableIcons(jQuery);

    // Clear the drag and drop border
    jQuery(this).css('border', '0');

    jQuery.post(ajaxurl, {

        action: 'save_social_icons',
        nonce: jQuery('#save-social-icons-nonce').text(),
        availableSocialIcons: jQuery('#available-social-icons').val(),
        activeSocialIcons: jQuery('#active-social-icons').val(),
        updateSocialIcons: 'true'

    }, function(response) {

        if( parseInt(response, 10) === 0 ) {

            jQuery('#active-icon-list > li').each(function() {

                var bIsNowActive = evt === undefined ? false : jQuery(evt.srcElement).parents('ul').attr('id') === 'active-icon-list';
                setupIconClickHander(jQuery, jQuery(this), bIsNowActive);

            });

        } // end if

    });

    checkForMaxIcons();

} // end updateIconValues

/**
 * Helper function that's fired when the user clicks 'Done' or hits 'Enter'
 * when working to save their social icons.
 *
 * @params	$	A reference to the jQuery functioin
 * @params	evt	The source event of this handler
 */
function saveIconUrl($, evt) {
    "use strict";

    evt.preventDefault();

    if( $.trim($('#social-icon-url').val()).length > 0 ) {

        // Set the list item's URL
        var sUrl = $('#social-icon-url').val();
        $('li.active-icon').attr('data-url', sUrl);

        // Clear out the input
        $('#social-icon-url').val('');

        // Hide the container
        $('#active-icon-url').addClass('hidden');

        // Remove active icons
        $('.active-icon').removeClass('active-icon');

        // Update the data
        updateIconValues();

        // Update the icons
        updateActiveIcons($);

    } else {

        // Hide the container
        $('#active-icon-url').addClass('hidden');

        // Remove active icons
        $('.active-icon').removeClass('active-icon');

    } // end if

    $('.icon-url').val('');

} // end if

/**
 * Sets up the icon media uploader to render with limited fields when the upload button
 * has been clicked.
 *
 * @params		$				A reference to the jQuery function
 * @params		sInputId		A reference to the input field that contains the icons to display
 * @params		sWrapperId		A reference to the container that will contain the list of icons.
 */
function displayIcons($, sInputId, sWrapperId) {
    "use strict";

    var aIconSrc,
        aIconUrl,
        sUrl,
        sSrc,
        $listItem,
        $socialIcon,
        values,
        icon;

    if($('#' + sInputId).length > 0) {

        // Clear out the existing list
        $('#' + sWrapperId + ' > ul')
            .children('li')
            .remove();

        // Rebuild the list based on the available icons
        aIconSrc = $('#' + sInputId)
            .val()
            .split(';');

        $(aIconSrc).each(function() {

            if( this.length > 0) {

                // Look to see if there are URL's
                aIconUrl = this.split('|');
                sUrl = null;
                sSrc = null;
                if(aIconUrl.length === 1) {
                    sSrc = aIconUrl[0];
                } else {
                    sSrc = aIconUrl[0];
                    sUrl = aIconUrl[1];
                } // end if

                // Create the image
                $socialIcon = $('<img />')
                    .attr('src', sSrc)
                    .hide();

                values = sSrc
                    .replace('.png', '')
                    .split('/');
                icon = values[values.length - 1];

                if (icon == 'email') {
                    icon = 'envelope';
                } else if (icon == 'soundcloud') {
                    icon = 'cloud';
                } else if (icon == 'vimeo') {
                    icon = 'vimeo-square';
                } else if (icon == 'google_plus') {
                    icon = 'google-plus';
                }

                // Create a list item from the image
                $listItem = $('<li />')
                    .attr('data-url', sUrl)
                    .addClass('fa fa-' + icon)
                    .append($socialIcon);

                // If we're active icons, let's setup click handlers
                if(sWrapperId === 'active-icons') {
                    setupIconClickHander($, $listItem);
                } // end if

                // Append it to the list of available icons
                $('#' + sWrapperId)
                    .children('ul')
                    .append($listItem);

            } // end if

        });

    } // end if

} // end displayIcons

/**
 * Adds a border around an element that is about to receive an icon.
 */
function overHandler() {
    "use strict";

    jQuery(this).css('border', '1px dashed #ccc');

} // end overHandler

/**
 * Enables sorting for the social icon containers.
 *
 * @params		$				A reference to the jQuery function
 * @params		sActiveId		A reference to the container of the active icons
 * @params		sWrapperId		A reference to the container of the available icons
 */
function makeSortable($, sActiveId, sAvailableId) {
    "use strict";

    $(sActiveId).children('ul').sortable({
        connectWith: sAvailableId + ' > ul',
        update: updateIconValues,
        over: overHandler
    });

    $(sAvailableId).children('ul').sortable({
        connectWith: sActiveId + ' > ul',
        update: updateIconValues,
        over: overHandler
    });

} // end makeSortable

/**
 * Attachs a click handler to the incoming element.
 *
 * @params	$		The jQuery function
 * @params	$this	The element on which to attach the handler
 */
function setupIconClickHander($, $this, bIsNowActive) {
    "use strict";

    $this.click(function(evt) {

        var sRssUrl = '';
        if($(evt.srcElement).attr('src') !== '' && $(evt.srcElement).attr('src') !== undefined) {
            if($(evt.srcElement).attr('src').toString().indexOf('rss.png') > 0) {
                sRssUrl = $('#wordpress-rss-url').text();
            } // end if
        } // end if

        // if the input is visible, clear it out; otherwise, show it.
        if($('#active-icon-url').is(':visible')) {

            $(this).parent()
                .siblings('#active-icon-url')
                .children('input[type=text]')
                .val('');

        } else {

            $(this).parent()
                .siblings('#active-icon-url')
                .removeClass('hidden');

        } // end if/else

        $(this).parent()
            .siblings('#active-icon-url')
            .children('input[type=text]')
            .val($(this).attr('data-url'));

        // Update the active icon that we're editing
        $('.active-icon').removeClass('active-icon');
        $(this).addClass('active-icon');

        updateIconValues();
        makeSortable($, '#active-icons', '#available-icons');

        // If we're looking at the RSS feed icon, disable the input
        // and link the user to the Global options for where to set it.
        if('' !== sRssUrl) {

            $('#social-icon-url').val(sRssUrl).attr('disabled', 'disabled');
            $('#social-rss-icon-controls').removeClass('hidden');
            $('#social-icon-controls').addClass('hidden');

        } else {

            $('#social-icon-url').removeAttr('disabled');
            $('#social-icon-controls').removeClass('hidden');
            $('#social-rss-icon-controls').addClass('hidden');

        } // end if

    });

} // end setupIconClickHander

/**
 * Updates the input field of available icons.
 *
 * @params	$	A reference to the jQuery function
 */
function updateAvailableIcons($) {
    "use strict";

    var sAvailableIcons = '';
    $('#available-icons ul').children('li').each(function() {
        if($(this).children('img').length > 0 && $(this).children('img').attr('src').length > 0) {
            sAvailableIcons += $(this).children('img').attr('src') + ';';
        } // end if
    });
    $('#available-social-icons').val(sAvailableIcons);

} // end updateAvailableIcons

(function($) {
    "use strict";
    $(function() {

        if( 0 < $('#available-icon-list').length ) {

            // Hide the table of options.
            $('.social-icons-wrapper').siblings('table').hide();

            // Render the avaialable icons and the active icons
            displayIcons($, 'available-social-icons', 'available-icons');
            displayIcons($, 'active-social-icons', 'active-icons');

            // Make the lists sortable
            makeSortable($, '#active-icons', '#available-icons');

            // Setup the handler for triggering the social icon url
            $('#set-social-icon-url').click(function(evt) {
                saveIconUrl($, evt);
            });

            // Save the input field if the user presses enter
            $(document).keypress(function(evt) {

                if(evt.keyCode === 13) {
                    evt.preventDefault();
                    saveIconUrl($, evt);
                } // end if

            });

            // Cancel entering a URL
            $('#cancel-social-icon-url').click(function(evt) {

                evt.preventDefault();
                cancelSettingIconURL($);

            });

            checkForMaxIcons();

            // Offer the ability to reset the icons
            $('#reset-social-icons').click(function(evt) {

                var activeIcons = $('#active-icon-list li');

                $.each(activeIcons, function () {
                   $(this).appendTo('#available-icon-list');
                });

                updateIconValues();

                $('#submit').click();

            });

        } // end if

    });
}(jQuery));