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

          <?php require('snippets/alerts.php'); ?>

          <div class="box">
            <div class="box-header pb-xs pt-sm with-border">

                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <option <?php echo ($_GET['trash'] == '0' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'trash'); ?>&trash=0">Active Categories (<?php echo $output['not_trash']; ?>)</option>
                      <option <?php echo ($_GET['trash'] == '1' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'trash'); ?>&trash=1">Trash Bin (<?php echo $output['trash']; ?>)</option>
                    </select>
                </div>  

                <div class="pull-right" style="margin-bottom:15px;">
                  <a href="?o=<?php echo $page['model']; ?>&v=create" class="btn btn-success">New Category</a>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding ">

              <table class="table">
                 <tbody>
                  <?php echo $output['view']; ?>
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


