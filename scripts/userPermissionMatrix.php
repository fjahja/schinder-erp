<script type="text/javascript">
$(document).ready(function(){

	// permission toggle all mechanism
	$('body').on("change", 'label.groupck', function(event) {

	    var thiscl = $(this);
	    var thischeckbox = thiscl.children('input');
	    var datagroup = thiscl.attr('data-group');

	    if (thischeckbox.is(':checked')) {
	        $('.groupinp'+datagroup).prop('checked', true);
	    } else {
	        $('.groupinp'+datagroup).prop('checked', false);
	    }
	});
});
</script>