<script type="text/javascript">
  $(document).ready(function(){
    //ajax delete comment
    $('body').on("click", '.delete_comment', function(event) {
        event.preventDefault();

        var thiscl = $(this);

        var Form = {};
        Form.comment_id = $(this).attr('data-id');

        $.post( "crud/comment.php?v=delete", { Form })
            .done(function( data ) {
                thiscl.parents('.cm-wrapper').slideUp('fast');
        });
    });
  });
</script>