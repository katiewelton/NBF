jQuery(document).ready(function($) {
  $('.gallery-container').magnificPopup({
    delegate: 'a',
    type: 'image',
    gallery: {
      enabled:true
    }
  });
});
