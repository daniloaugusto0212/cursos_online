

  // Smooth scrolling using jQuery easing
  jQuery(document).ready(function($){
    $('.scroll-suave').click(function(e) {
      e.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
    });
});

  