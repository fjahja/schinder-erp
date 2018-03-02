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

                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <?php echo $jumper['view']; ?>
                    </select>
                </div> 


                <form action="index.php" method="get" class="inline">

                  <input type="hidden" name="o" value="contribution">
                  <input type="hidden" name="v" value="admin">
                  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                  <div class="form-group inline-block">
                      <input type="text" name="time" value="<?php echo date('F Y',$_GET['time']); ?>" class="form-control" id="month-only">
                  </div>  

                  <button class="btn btn-default" style="margin-top: -3px;" type="submit">Go</button>

                </form>

            </div>
          </div>
              <?php if ($model): ?>

                <div class="row mb-sm">

                  <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text c-pointer"  data-toggle="tooltip" data-placement="top" data-original-title="Total hours put in by user in a given month.">Month Total <i class="fa fa-question-circle"></i></span>
                        <span class="info-box-number"><? echo $table['total_diff']; ?> </span>

                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text c-pointer"  data-toggle="tooltip" data-placement="top" data-original-title="The number of clients this user is working on.">Total Clients <i class="fa fa-question-circle"></i></span>
                        <span class="info-box-number"><? echo $table['total_client']; ?> </span>

                      </div>
                    </div>
                  </div> -->
                  
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
                </div>
              <?php else: ?>
                Please select a user from the selector above.
              <?php endif ?>

              

              
            
        </div>
      </div>

    </section>
  </div>


