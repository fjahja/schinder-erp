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
          <span class="c-lightgrey"><?php echo $page['title']; ?></span> <?php echo $model['agreement_number']; ?>
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

              <div class="row visible-print">
                <div class="col-sm-12">
                  <h1 class="mt-none">
                    <span class="c-lightgrey"><?php echo $page['title']; ?></span> <?php echo $model['subject']; ?>
                  </h1>
                </div>
              </div>

              <? echo $tasks['count']; ?> tasks found 

              <div class="pull-right hidden-print ">

                <a href="?<?php echo $currentUrl; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" data-original-title="Reload page"><i class="glyphicon glyphicon-refresh"></i></a>

                <?php if (hasPermission($admin,array(206))): ?>
                <a href="?o=agreement&v=update&id=<?php echo $model['id']; ?>" class="btn btn-default">Edit</a>
                <?php endif ?>

                <?php if (hasPermission($admin,array(205))): ?>
                <a href="?o=agreement&v=create" class="btn btn-success">New agreement</a>
                <?php endif ?>

                <?php if (hasPermission($admin,array(34))): ?>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ticketDelete">Move agreement to trash</button>
                <?php endif ?>

              </div>
            </div>

            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                 <tbody>
                  <? echo $tasks['view']; ?>
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
      <code style="padding-left:0;"><? echo $client['name']; ?></code>
      <div class="clear"></div>
      <br>
      <span class="c-lightgrey">
        Created on <?php echo date('j M, Y',strtotime($model['timestamp'])); ?>
        by 
        <?php echo $creator['display_name']; ?>
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
    
    <?php if ($model['_signed_date']): ?>
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Signed date:</h3>
        <a href="?o=agreement&v=update&id=<?php echo $model['id']; ?>" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <br>
      <span class="c-lightgrey"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<? echo $model['_signed_date']; ?>
      </span>
      <div class="clear"></div>
      <br>
    </div>
    <?php endif ?>
    
    <?php if ($model['agreement_value'] && hasPermission($admin,array(226))): ?>
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Agreement value:</h3>
        <a href="?o=agreement&v=update&id=<?php echo $model['id']; ?>" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <br>
      <span class="c-lightgrey">Rp <? echo number_format($model['agreement_value']); ?>
      </span>
      <div class="clear"></div>
      <br>
    </div>
    <?php endif ?>
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Category:</h3>
        <a href="?o=agreement&v=update&id=<?php echo $model['id']; ?>" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <br>
        
      <span class="c-lightgrey"><?php echo $category['name']; ?></span>
      <div class="clear"></div>
      <br>
    </div>

  </aside>


