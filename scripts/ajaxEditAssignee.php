<script type="text/javascript">
$(document).ready(function(){
  //ajax editAssignee
  $('body').on("click", 'td.editAssigneeCheck', function(event) {

      var thiscl = $(this);

      var Form = {};
      Form.ticket_id = $('.ajax_ticketid').val();
      Form.assignee_id = thiscl.attr('data-id');

      // check if checked, if checked run a delete command
      // if not checked, run a attach command

      if (thiscl.hasClass('tdchecked')) {

          // show preloader
          $('#editassignee .loader').css('opacity','1');

          // detach
          $.post( "crud/ticket.php?v=detach_assignee", { Form })
              .done(function( data ) {
                  $('.assg'+Form.assignee_id).remove();
                  $('#editassignee .loader').css('opacity','0');
          });

          thiscl.removeClass('tdchecked');

      } else {

          // show preloader
          $('#editassignee .loader').css('opacity','1');

          // attach
          $.post( "crud/ticket.php?v=attach_assignee", { Form })
              .done(function( data ) {
                  $('.asignee-container').append(data);
                  $('.anone').hide();
                  $('#editassignee .loader').css('opacity','0');
          });

          thiscl.addClass('tdchecked');
      }
  });
});
</script>