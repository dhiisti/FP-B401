(function($) { "use strict";
            
        //Menu On Hover
        $('body').on('mouseenter mouseleave','.nav-item',function(e){
                if ($(window).width() > 750) {
                    var _d=$(e.target).closest('.nav-item');_d.addClass('show');
                    setTimeout(function(){
                    _d[_d.is(':hover')?'addClass':'removeClass']('show');
                    },1);
                }
        });	

        //pdf 
        PDFObject.embed("LAB1.pdf", "#pdf1")
        PDFObject.embed("LAB2.pdf", "#pdf2");
        PDFObject.embed("LAB4.pdf", "#pdf4");
        PDFObject.embed("LAB5.pdf", "#pdf5");

        //next slide
        $('.js-next').on('click', function() {
            var current = $('.page.active');
            var findNext = $(current).next(".page");
            $(current).removeClass('active');
            setTimeout(function() {
                $(findNext).addClass("active");
            }, 200);
        });

        $('.js-prev').on('click', function() {
            var current = $('.page.active');
            var findPrev = $(current).prev(".page");
            $(current).removeClass('active');
            setTimeout(function() {
                $(findPrev).addClass("active");
            }, 200);
        });

        $('.js-back-to-1').on('click', function() {
            var current = $('.page.active');
            $(current).removeClass('active');
            setTimeout(function() {
                $('.page-cover').addClass("active");
            }, 400);
        });

})(jQuery); 