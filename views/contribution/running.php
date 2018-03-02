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
        <small>All Users</small>
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
          <small><?php echo (empty($client['name']) ? 'All clients' : $client['name']); ?></small>
        </h1>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th style="width:3%;"></th>
                    <th style="width:3%;"><span data-toggle="tooltip" data-placement="top" data-original-title="Contribution Id">ID</span></th>
                    <th>Contributor</th>
                    <th>Client</th>
                    <th>Duration</th>
                    <th>Task ID</th>
                    <th>Contribution Subject</th>
                    <th>Start</th>
                    <th>Type</th>
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


