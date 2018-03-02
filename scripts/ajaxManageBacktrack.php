<script type="text/javascript">
$(document).ready(function(){
  //ajax backtrack
  $('body').on("click", '.bt-approve', function(event) {

      var thiscl = $(this);
      var thiscl_td = thiscl.parents('td');
      var thiscl_tr = thiscl.parents('tr');

      var Form = {};
      Form.contribution_id = thiscl.attr('data-id');
      
      $.post( "crud/contribution.php?v=ajax_approve", { Form })
          .done(function( data ) {
              thiscl_td.html('Approved');
              thiscl_tr.addClass('success');
      });
  });
}); 
</script>