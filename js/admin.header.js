(function ($) {
    $(function () {
       
        // Unconditionally hide the ability to check to include text with the image
        $('.form-table:last tr:first').hide();
       
        /* If the header image is displayed, then we hide the next. Users can
         * only have an image or text, but not both.
         */
        if($('#header-bottom').length > 0) {
        
            $('#header-top').hide();
            
            // Add a 'disabled' class and disable the elements in the second form
            $('.form-table:last').addClass('disabled');
            $('.form-table:last input').attr('disabled', 'disabled');
            
            // Create the new notification row for 
            var $notificationRow, $notificationCell;
            
            /* Translators: This will need to be localized. */
            $notificationCell = $('<td />')
                .attr('colspan', '2')
                .html('<p class="description">Remove header image to activate header text.</p>');
                
            $notificationRow = $('<tr />')
                .append($notificationCell);
                
            $('.form-table:last').prepend($notificationRow);
            
            // Since the form is disabled, we need to hide the 'Select a Color' anchor
            $('.form-table:last a').hide();
        
        } else {
        
            $('#header-top').show();        
            
        } // end if
        
    });
}(jQuery));