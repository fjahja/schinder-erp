<?php 

$_GET['alert'] = (isset($_GET['alert']) ? $_GET['alert'] : NULL);

?>

<?php if ($_GET['alert'] == 'created'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The record has been created.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'resent'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The notification has been resent.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'blank_resent'): ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> ERROR: You must choose at least 1 email.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'updated'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The record has been updated.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'deleted'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The record has been deleted.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'restored'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The record has been restored.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'trash_emptied'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The trash has been emptied.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'incomplete'): ?>
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="glyphicon glyphicon-alert"></i>&nbsp;&nbsp;&nbsp;&nbsp;The form is incomplete.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'closed'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The ticket has been closed.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'reopened'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> The ticket has been reopened.
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'comment_created'): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-check"></i> Your comment has been posted.
	</div>	
<?php endif ?>


<!-- Backtrack request validations -->

<?php if ($_GET['alert'] == 'same_val'): ?>
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-exclamation"></i> The start and end date/time cannot be the same. 
	</div>	
<?php endif ?>

<?php if ($_GET['alert'] == 'start_larger'): ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fa fa-exclamation"></i> Ending date/time cannot be earlier than start date/time. 
	</div>	
<?php endif ?>