<script type="text/javascript">
$(document).ready(function(){
  //ajax backtrack
  $('body').on("change", 'input.backtrack-start-time, input.backtrack-end-time, input.backtrack-start-date, input.backtrack-end-date', function(event) {

      var Form = {};
      Form.start_time = $('input.backtrack-start-time').val();
      Form.start_date = $('input.backtrack-start-date').val();

      Form.end_time = $('input.backtrack-end-time').val();
      Form.end_date = $('input.backtrack-end-date').val();


      $.post( "crud/contribution.php?v=ajax_calculate_backtrack", { Form })
          .done(function( data ) {
              $('.calc-duration').html(data);
      });
  });
}); 
</script>