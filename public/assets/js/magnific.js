(function($) {
    "use strict";

    // Magnific Popup untuk gambar
    $('.image-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    // Magnific Popup untuk video
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    // Form submit menggunakan AJAX
    $('#registrationForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#responseMessage').html('<div class="alert alert-success">' + data.message + '</div>');
                form.trigger('reset');
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                $('#responseMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + errorMessage + '</div>');
            }
        });
    });

})(jQuery);
