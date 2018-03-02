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

          <?php require('snippets/alerts.php'); ?>


          <div class="box">
            <div class="box-header pb-sm pt-sm with-border hidden-print">

                <?php require('snippets/alerts.php'); ?>

                <div class="form-group inline-block mb-none">
                    <select class="form-control" onchange="location = this.value;">
                      <option <?php echo ($_GET['approved'] == '1' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'approved'); ?>&approved=1">Pending Requests</option>
                      <!-- <option <?php echo ($_GET['approved'] == '2' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'approved'); ?>&approved=2">Rejected</option> -->
                    </select>
                </div> 

            </div>
          </div>
          <div class="box">
            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th style="width:10%;">User</th>
                    <th style="width:3%;">CID</th>
                    <th style="width:15%;">Start</th>
                    <th style="width:15%;">Duration</th>
                    <th style="width:5%;">Task</th>
                    <th>Subject</th>
                    <th>Client</th>
                    <th style="width:15%;">Approval</th>
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


