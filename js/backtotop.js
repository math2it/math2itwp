jQuery(document).ready(function($){
  // browser window scroll (in pixels) after which the "back to top" link is shown
  var scroll_top_duration = 700,
    //grab the "back to top" link
    $back_to_top = $('#a-backtotop');

  //smooth scroll to top
  $back_to_top.on('click', function(event){
    event.preventDefault();
    $('body,html').animate({
      scrollTop: 0 ,
      }, scroll_top_duration
    );
  });

});