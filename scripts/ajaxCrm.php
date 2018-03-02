<script type="text/javascript">
$(document).ready(function(){

// add button
$('body').on("click", 'a.x-add', function(event) {

	var ths = $(this);
	var tmpl = $('.model-add');
	var inp1 = $('.x-input1');

	tmpl.removeClass('hidden');
	ths.parents('tr').addClass('hidden');
	inp1.focus();
});

// cancel button
$('body').on("click", 'a.x-cancel', function(event) {

	var ths = $(this);
	var tmpl = $('.model-add');
	var tgl = $('.model-toggle');

	tmpl.addClass('hidden');
	tmpl.find('input').val('');
	tgl.removeClass('hidden');
});

function showAcTray(){
	$('.model-ac').removeClass('hidden');
}
function hideAcTray(){
	$('.model-ac').addClass('hidden');
}
function clearAcTray(){
	$('.model-ac').html('<div class="entry no-data"><em class="c-lightgrey">No result found</em></div>');
}

// autocomplete standalone
$('body').on("keyup", '.x-input1', function(event) {

	var ths = $(this);
	var inputVal = ths.val();
	var valLength = inputVal.length;
	
	if(valLength > 2 && valLength < 10){

		var Form = {};
		Form.input = inputVal;

		// append agreements after selecting client
		$.post( "crud/crm_contact.php?v=ajax_autocompleteCompanies", { Form })
		    .done(function( data ) {
		    	$('.model-ac').html(data);
		    	showAcTray();
		});
	}

	if(valLength < 2){ 
		hideAcTray();
		clearAcTray();
	}
});

// solution to autofocus click problem
$('.model-ac').hover(
   function(){ $(this).addClass('hover') },
   function(){ $(this).removeClass('hover') }
);

// click on autocomplete
$('body').on("click", '.model-ac .entry', function(event) {
	
	var ths = $(this);
	var inputVal = ths.attr('data-name');
	var inp = $('.x-input1');
	var company_id = ths.attr('data-company-id');

	inp.attr('data-company-id',company_id);
	inp.val(inputVal);

	hideAcTray();
	clearAcTray();
});

// autocomplete out of focus
$('body').on("focusout", '.x-input1', function(event) {

	if(!$('.model-ac').hasClass('hover')){
		hideAcTray();
		clearAcTray();
	}
});


// SUBMIT for CONTACT
$('body').on("click", '.x-submit', function(event) {
	event.preventDefault();

	var formIsValid = true;
	
	var ths = $(this);
	var input1 = $('.model-add .x-input1');
	var input2 = $('.model-add .x-input2');

	var company_id = input1.attr('data-company-id');
	var contact_id = input1.attr('data-contact-id');
	var position = input2.val();

	if(!input1.val()){
		formIsValid = false;
		input1.addClass('input-error');
	}

	if(!input2.val()){
		formIsValid = false;
		input2.addClass('input-error');
	}
	
	if(formIsValid){

		var Form = {};
		Form.company_id = company_id;
		Form.contact_id = contact_id;
		Form.position = position;

		// append agreements after selecting client
		$.post( "crud/crm_contact.php?v=ajax_attachContactToCompany", { Form })
		    .done(function( data ) {
		    	console.log(data);

		    	location.reload();
		});
	}
});


});
</script>