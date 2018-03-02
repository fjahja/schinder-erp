<script type="text/javascript">
$(document).ready(function(){

  //ajax query assignee from client select on ticket create
  $('body').on("change", 'select.clientselect', function(event) {

      var thiscl = $(this);
      var Form = {};
      Form.client_id = thiscl.val();

      // append agreements after selecting client
      $.post( "crud/agreement.php?v=ajax_getAgreementsFromClient", { Form })
          .done(function( data1 ) {
              $('.rsjk').remove();
              $('.agreement-select').append(data1);
      });

      // append to multi select
      // $.post( "crud/user.php?v=ajax_getUserFromClient", { Form })
      //     .done(function( data1 ) {
      //         $('.rsjk').remove();
      //         $('.assignto-select').append(data1);
      // });

      // append to form info
      // $.post( "crud/user.php?v=ajax_getUserEmails", { Form })
      //     .done(function( data2 ) {
      //         $('.jyskk').remove();
      //         $('.blc-container').append(data2);
      // });
  });

  //ajax query assignee from client select on ticket create
  $('body').on("change", 'select.agreement-select', function(event) {

      var thiscl = $(this);
      var thisnumber = $(this).children(":selected").html();

      // imbue task subject with agreement number
      $('textarea.task-subject').html(thisnumber);
  });

});
</script>