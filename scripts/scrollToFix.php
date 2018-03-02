<script type="text/javascript">
  var scrollDistance = $('.scroll-execute').attr('data-start-scroll');
  $(window).scroll(function() {
      var y_scroll_pos = window.pageYOffset;
      var fixed_start = scrollDistance;             
      // set to whatever you want it to be

      if(y_scroll_pos > fixed_start) {
      $('.scroll-execute').addClass('fixed');
      }
    else
    { 
      $('.scroll-execute').removeClass('fixed');
    }
  });

  $(document).ready(function(){

    var wdth = $('.width-gauge').width();
    $('.force-width').width(wdth);
  });
</script>