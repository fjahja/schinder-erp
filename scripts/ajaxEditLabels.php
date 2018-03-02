<script type="text/javascript">
  $(document).ready(function(){
    //ajax editlabels
    $('body').on("click", 'td.labeltrigger', function(event) {
        event.preventDefault();

        var thiscl = $(this);
        var checkmark = thiscl.find('.chck9');

        var Form = {};
        Form.ticket_id = $('.ajax_ticketid').val();
        Form.tag_id = thiscl.attr('data-tag-id');

        // check if checked, if checked run a delete command
        // if not checked, run a attach command

        if (thiscl.hasClass('tdchecked')) {

            // show preloader
            $('#editlabels .loader').css('opacity','1');

            // detach
            $.post( "crud/ticket.php?v=detach_tag", { Form })
                .done(function( data ) {
                    $('.taglabel'+Form.tag_id).remove();
                    $('#editlabels .loader').css('opacity','0');
                    checkmark.addClass('hidden');
            });

        } else {

            // show preloader
            $('#editlabels .loader').css('opacity','1');

            // attach
            $.post( "crud/ticket.php?v=attach_tag", { Form })
                .done(function( data ) {
                    $('.lbl-container').append(data);
                    $('.cnone').hide();
                    $('#editlabels .loader').css('opacity','0');
                    checkmark.show();
            });
        }
    });
  });
</script>