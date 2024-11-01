(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $(document).ready(function () {
        // Set iFrame height
        $('#webcamconsult-admin-iframe').height($('#wpwrap').height());

        //Fill widget selector
//        if ($('.webcamconsult-widget-selector').length) {
//            var data = {
//                'action': 'get_widgets',
//            };
//            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
//            jQuery.post(ajaxurl, data, function (response) {
//                if (response !== '0') {
//                    // fill the widget selector
//                    var obj = $.parseJSON(response);
//                    $(obj).each(function (index, widgetObj) {
//                            // fill the selectors
//                            $('.webcamconsult-widget-selector').append($('<option />').val(widgetObj._id).text(widgetObj.name));
//                        
//                    });
//                    $('.webcamconsult-widget-selector').each(function(){
//                        // Select the corrected value for each widget selector
//                        $(this).val($(this).data('current'));
//                    });
//                } else {
//                    //there are no widgets, or user id is undefined
//                }
//            });
//        }
    });
})(jQuery);
