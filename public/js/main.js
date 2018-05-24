(function ($) {
    // Toggle search form on click search icon.
    var form = $('#search-form'),
        formIcon = $('#search-trigger');
    formIcon.on('click',function () {
        form.fadeIn('slow');
    });
    $(document).on('click',function (e) {
        if (!$(e.target).closest('.navbar').length) {
            form.fadeOut('slow');
        }
    });

})(jQuery);
