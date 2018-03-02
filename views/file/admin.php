<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require('snippets/header.php'); ?>

  <?php require('snippets/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page['title']; ?>
        <? if ($directory['file_count'] != 0): ?>
          <small><? echo $directory['file_count']; ?> files found</small>
        <? endif ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="?o=ticket&v=admin">Home</a></li>
        <li><a href="?o=file&v=admin"><?php echo $page['title']; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

          <?php require('snippets/alerts.php'); ?>

          <div class="box">
            <!-- <div class="box-header pb-xs pt-sm with-border">

                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <option <?php echo ($_GET['client'] == 'all' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'client'); ?>&client=all">All Clients</option>
                      <? echo $output['client_select']; ?>
                    </select>
                </div>

            </div> -->
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                 <tbody>
                  <? echo $directory['up']; ?>
                  <? echo $directory['view']; ?>
                </tbody>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
  </div>


