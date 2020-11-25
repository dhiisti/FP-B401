(function($) { "use strict";
        //Animation

        $(document).ready(function() {
            $('body.hero-anime').removeClass('hero-anime');
        });

        //Menu On Hover
        $('body').on('mouseenter mouseleave','.nav-item',function(e){
                if ($(window).width() > 750) {
                    var _d=$(e.target).closest('.nav-item');_d.addClass('show');
                    setTimeout(function(){
                    _d[_d.is(':hover')?'addClass':'removeClass']('show');
                    },1);
                }
        });	
})(jQuery); 

$(window).scroll(function() {
  if ($(this).scrollTop() <= 450) {
    $('#wrapper').addClass('colorOne')
      .removeClass('colorTwo');
  } else if ($(this).scrollTop() <= 1000) {
    $('#wrapper').addClass('colorTwo')
      .removeClass('colorThree');
  } else {
    $('#wrapper').addClass('colorOne')
  }
});
