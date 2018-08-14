(function( $ ) {

  wp.customize.bind( 'preview-ready', function() {

    var customizeEvents = [
     //{element: '.element', type: 'panel', target: 'target_target'},
     {element: '.top-line', type: 'section', target: 'top-header'},
     {element: '.tt-heading.title-wrapper', type: 'section', target: 'title-wrapper'},
     {element: '.tt-header-wrapper', type: 'control', target: 'magplus_theme_options[header-enable-switch]'},
     {element: '.tt-logo-1x', type: 'control', target: 'magplus_theme_options[logo]'},
     {element: '.tt-logo-2x', type: 'control', target: 'magplus_theme_options[logo-2x]'},
     {element: '.sidebar', type: 'section', target: 'sidebar-widgets-main'},
     //{element: '.sidebar .tt-title-block', type: 'control', target: 'magplus_theme_options[sidebar-heading-style]'},
     {element: '.tt-mag-slider, .tt-slider-info', type: 'section', target: 'slider'},
     {element: '.col-1', type: 'panel', target: 'sidebar-widgets-footer-1'},
     {element: '.col-2', type: 'section', target: 'sidebar-widgets-footer-2'},
     {element: '.col-3', type: 'section', target: 'sidebar-widgets-footer-3'},
     {element: '.col-4', type: 'section', target: 'sidebar-widgets-footer-4'},
     {element: '.tt-trending-slider-post .container', type: 'control', target: 'magplus_theme_options[footer-slider-heading]'},
     {element: '.tt-footer', type: 'section', target: 'footer'},
    ];

    $.each( customizeEvents, function( key, data ) {

      var $elem = $(data.element);
      $elem.addClass('customizer-border-transparent');
      $elem
      .mouseenter( function(){
        $elem.addClass('customizer-editing');
        $elem.removeClass('customizer-border-transparent');
      	$elem.append('<div class="customizer-edit"><i class="fa fa-pencil"></i>Edit</div>');
      })
      .mouseleave( function(){
      	$elem.removeClass('customizer-editing');
      	$elem.find('.customizer-edit').remove();
        $elem.addClass('customizer-border-transparent');
      });
      
      $elem.on('click', function(e) {
      
        e.preventDefault();

      frames.top.jQuery.redux.initFields();
        frames.top.wp.customize[data.type](data.target).focus();

        return false;

      });



    });

  });

})( jQuery );
