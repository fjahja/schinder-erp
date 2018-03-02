<body class="hold-transition skin-blue sidebar-mini control-sidebar-open">
<div class="wrapper">

  <?php require('snippets/header.php'); ?>

  <?php require('snippets/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
      <div class="col-sm-10">
        <h1 class="mt-none mb-sm">
          <span class="c-ccc"><?php echo $page['title']; ?></span> <?php echo $model['name']; ?>
        </h1>
      </div>
      <ol class="breadcrumb">
        <li><a href="?o=agreement&v=admin">Home</a></li>
        <li><a href="?o=agreement&v=admin&client=<?php echo $client['id']; ?>"><?php echo $page['parent']; ?></a></li>
        <li class="active"><?php echo $page['title']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

          <?php require('snippets/alerts.php'); ?>

          <div class="box">
            <div class="box-header with-border lh-34" style="height:57px;">
              <div class="pull-left">
                <h4>Related companies:</h4>
              </div>
              <div class="pull-right hidden-print ">
                <a href="javascript:history.back()" class="btn btn-default">Back to list</a>
                <a href="?<?php echo $currentUrl; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" data-original-title="Reload page"><i class="glyphicon glyphicon-refresh"></i></a>

                <?php if ($model['trash'] == 1): ?>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelRestore"><i class="glyphicon glyphicon-retweet"></i>&nbsp;&nbsp;Restore</button>
                <?php endif ?>

                <?php if ($model['trash'] == 0): ?>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelDelete"><i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Delete</button>
                <?php endif ?>
                
              </div>
            </div>
            <div class="box-body no-padding ">
              <table class="table table-hover">
                <tbody>
                  <?php if ($model['trash'] == 1): ?>
                    <tr>
                      <td>This record is in the trash bin. Restore to view more information.</td>
                    </tr>
                  <?php endif ?>
                  <?php if ($model['trash'] == 0): ?>
                    <?php echo $companies['view']; ?>  
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>

    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light control-sidebar-open h100 pl-sm pr-sm hidden-print">
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <code style="padding-left:0;">CRM Contact</code>
      <div class="clear"></div>
      <br>
      <span class="c-lightgrey">
        Created on <?php echo date('j M Y',strtotime($model['timestamp'])); ?>
      </span>
      <br>
      <br>
    </div>
    
    <?php if ($model['_agreement_date']): ?>
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Agreement date:</h3>
        <a href="?o=agreement&v=update&id=<?php echo $model['id']; ?>" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <br>
      <span class="c-lightgrey"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<? echo $model['_agreement_date']; ?>
      </span>
      <div class="clear"></div>
      <br>
    </div>
    <?php endif ?>
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Notes:</h3>
      <br>
      <span class="c-lightgrey">
        <?php echo (empty($model['notes']) ? 'No notes for this contact' : $model['notes']); ?>
      </span>
      <div class="clear"></div>
      <br>
    </div>

  </aside>


  <div class="modal" id="modelRestore" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Confirm restore</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to restore this record?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <form action="crud/<?php echo $page['model']; ?>.php?v=restore" method="post" class="inline">
            <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
            <input type="hidden" name="Form[return]" value="index.php?o=<?php echo $page['model']; ?>&v=view&id=<?php echo $model['id']; ?>&alert=restored">
            <button type="submit" class="btn btn-primary">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="modelDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Confirm delete</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this record?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <form action="crud/<?php echo $page['model']; ?>.php?v=delete" method="post" class="inline">
            <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
            <input type="hidden" name="Form[return]" value="index.php?o=<?php echo $page['model']; ?>&v=admin&alert=deleted">
            <button type="submit" class="btn btn-primary">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  


