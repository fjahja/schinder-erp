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
        <?php if ($_GET['trash'] == 0): ?>
          <small>Active Clients</small>
        <?php elseif($_GET['trash'] == 1): ?>
          <small>Trash Bin</small>
        <?php endif; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?o=ticket&v=admin">Home</a></li>
        <li class="active"><?php echo $page['title']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header pb-xs pt-sm with-border">

                <?php require('snippets/alerts.php'); ?>

                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <option <?php echo ($_GET['trash'] == '0' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'trash'); ?>&trash=0">Active Users (<?php echo $output['not_trash']; ?>)</option>
                      <option <?php echo ($_GET['trash'] == '1' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'trash'); ?>&trash=1">Trash Bin (<?php echo $output['trash']; ?>)</option>
                    </select>
                </div>  

                <div class="pull-right" style="margin-bottom:15px;">
                  <a href="?o=<?php echo $page['model']; ?>&v=create" class="btn btn-success">New User</a>
                </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                 <tbody>
                  <?php echo $output['table']; ?>
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


