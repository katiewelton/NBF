(function($) {
  var term_media_uploader;

  $('body').on('click', '.term-image-upload-btn', function(e) {
    e.preventDefault();

    var upload_field = $(this).parent().children('.term-image-upload-field');

    if(term_media_uploader) {
      term_media_uploader.open();

      return;
    }

    term_media_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose / Upload Image',
      button: {
        text: 'Add Image'
      },
      multiple: false
    });

    term_media_uploader.on('select', function() {
      var attachment = term_media_uploader.state()
                                          .get('selection')
                                          .first()
                                          .toJSON();

      upload_field.prop('readonly', false)
                  .val(attachment.url)
                  .prop('readonly', true);

      upload_field.next('.term-image-attachment-id')
                  .prop('readonly', false)
                  .val(attachment.id)
                  .prop('readonly', true);

    });

    term_media_uploader.open();
  });
})(jQuery);
