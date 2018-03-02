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

    <div class="row visible-print">
      <div class="col-sm-12">
        <h1 class="mt-none">
          <?php echo $page['title']; ?>
        </h1>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header pb-sm pt-sm with-border hidden-print">

                <?php require('snippets/alerts.php'); ?>

                <? if (hasPermission($admin,array(218))): ?>
                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <option value="?o=contribution&v=mycontributions&id=81">All Users</option>
                      <?php echo $jumper['view']; ?>
                    </select>
                </div> 
                <? endif; ?>

                <form action="index.php" method="get" class="inline">

                  <input type="hidden" name="o" value="contribution">
                  <input type="hidden" name="v" value="mycontributions">

                  <div class="form-group inline-block">
                      <input type="text" name="time" value="<?php echo date('F Y',$_GET['time']); ?>" class="form-control" id="month-only">
                  </div>  

                  <button class="btn btn-default" style="margin-top: -3px;" type="submit">Go</button>

                </form>

            </div>
          </div>
          <div class="box">
            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th style="width:3%;">ID</th>
                    <th style="width:15%;">Start</th>
                    <th style="width:15%;">Duration</th>
                    <th style="width:5%;">Task</th>
                    <th>Subject</th>
                    <th>Client</th>
                    <th>Type/Approval</th>
                  </tr>
                </thead>
                 <tbody>
                  <?php echo $table['view']; ?>
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


