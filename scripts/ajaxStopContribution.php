<script type="text/javascript">
$(document).ready(function(){
  //ajax stop contribution from ticket view tab
  $('body').on("click", '.contribution-table-stop', function(event) {

      var thiscl = $(this);
      var Form = {};
      Form.contribution_id = thiscl.attr('data-stop');

      $.post( "crud/contribution.php?v=ajax_stop", { Form })
          .done(function( data ) {
              location = location + '&alert=updated';
              location.reload();
      });
  });
}); 
</script>