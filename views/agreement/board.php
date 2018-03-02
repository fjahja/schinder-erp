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
        <?php if ($_GET['client'] == 'all'): ?>
          <small>All clients</small>
        <?php else: ?>
          <small><?php echo $client['name']; ?></small>
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

              <div class="form-group inline-block">
                  <select class="form-control" onchange="location = this.value;">
                    <option value="?o=ticket&v=board&client=all">All Clients</option>
                    <?php echo $jumper['view']; ?>
                  </select>
              </div> 

              <div class="pull-right">

                <a href="?<?php echo $currentUrl; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" data-original-title="Reload page"><i class="glyphicon glyphicon-refresh"></i></a>

              </div>
            </div>
          </div>

          <?php require('snippets/alerts.php'); ?>

          <div class="row">

           <div class="col-sm-4">
              <div class="box">
                <div class="box-header pl-md pb-xs pt-sm with-border posrel c-pointer pb-sm" data-toggle="tooltip" data-placement="top" data-original-title="Tasks that have no contributors, comments or labels.">
                  <i class="c-ccc glyphicon glyphicon-time act-1" style="
                      top: 20px;
                      left: 18px;
                  "></i>
                  <p class="m-none"><b>Open (<?php echo $table['open_count']; ?>)</b></p>
                </div>
                <div class="box-body table-responsive no-padding ">
                  <table class="table table-hover">
                     <tbody>
                      <?php echo $table['open']; ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

           <div class="col-sm-4">
              <div class="box">
                <div class="box-header pl-md pb-xs pt-sm with-border posrel c-pointer pb-sm" data-toggle="tooltip" data-placement="top" data-original-title="Tasks with comments, labels or contributions in them are considered in-progress.">
                  <i class="c-yellow glyphicon glyphicon-refresh act-1" style="
                      top: 20px;
                      left: 18px;
                  "></i>
                  <p class="m-none"><b>In Progress (<?php echo $table['inprogress_count']; ?>)</b></p>
                </div>
                <div class="box-body table-responsive no-padding ">
                  <table class="table table-hover">
                     <tbody>
                      <?php echo $table['inprogress']; ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

           <div class="col-sm-4">
              <div class="box">
                <div class="box-header pl-md pb-xs pt-sm with-border posrel c-pointer pb-sm" data-toggle="tooltip" data-placement="top" data-original-title="Finished Tasks. Ready for Finance department invoicing process.">
                  <i class="c-green glyphicon glyphicon-ok act-1" style="
                      top: 20px;
                      left: 18px;
                  "></i>
                  <p class="m-none"><b>Closed (<?php echo $table['closed_count']; ?>)</b></p>
                </div>
                <div class="box-body table-responsive no-padding ">
                  <table class="table table-hover">
                     <tbody>
                      <?php echo $table['closed']; ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </section>
  </div>


