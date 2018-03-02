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
        <small><?php echo $output['client_name']; ?></small>
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
                      <option value="?o=ticket&v=admin">All Clients</option>
                      <?php echo $filterClient['select']; ?>
                    </select>
                </div>  

                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <option <?php echo ($_GET['status'] == 'all' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'status'); ?>&status=all">All Status (<?php echo $output['all']; ?>)</option>
                      <option <?php echo ($_GET['status'] == '0' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'status'); ?>&status=0">Open (<?php echo $output['open']; ?>)</option>
                      <option <?php echo ($_GET['status'] == 2 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'status'); ?>&status=2">Closed (<?php echo $output['closed']; ?>)</option>
                    </select>
                </div>   

                <a href="?o=ticket&v=board&client=<?php echo $_GET['client']; ?>" class="btn btn-default">Task Board</a>


                <div class="btn-group hidden">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Edit labels <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><span class="taglabel2">
                      &nbsp;<div class="label lbl" style="background:#ff9800;">To-do</div>
                    </span></a></li>
                  </ul>
                </div>

                <div class="pull-right">



                  <a href="?<?php echo $currentUrl; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" data-original-title="Reload page"><i class="glyphicon glyphicon-refresh"></i></a>

                  <a href="?o=ticket&v=admin&status=0" class="btn btn-default"  data-toggle="tooltip" data-placement="top" data-original-title="Reset filters">Reset</a> 

                  <div class="btn-group">
                    <button type="button" class="btn <?php echo ($_GET['sort'] ? 'btn-warning' : 'btn-default'); ?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Sort by <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li class="<?php echo ($_GET['sort'] == 'timestamp' ? 'active' : ''); ?>"><a href="?<?php echo removeUrl($currentUrl,'sort'); ?>&sort=timestamp"><i class="glyphicon glyphicon-sort-by-attributes"></i>Sort by created</a></li>
                      <li class="<?php echo ($_GET['sort'] == 'due' ? 'active' : ''); ?>"><a href="?<?php echo removeUrl($currentUrl,'sort'); ?>&sort=due"><i class="glyphicon glyphicon-sort-by-attributes"></i>Sort by due date</a></li>
                    </ul>
                  </div>

                  <div class="btn-group">
                    <?php if (!$_GET['search']): ?>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Search Task <span class="caret"></span>
                      </button>
                    <?php else: ?>
                      <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Showing <?php echo $output['count']; ?> Search Result <span class="caret"></span>
                      </button>
                    <?php endif; ?>
                    
                    <ul class="dropdown-menu">
                      <li><a href="#" data-toggle="modal" data-target="#ticketSearchById"><i class="fa fa-search"></i>Search by #id</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#ticketSearchBySubject"><i class="fa fa-search"></i>Search by subject</a></li>
                      <?php if ($_GET['search']): ?>
                        <li role="separator" class="divider"></li>
                        <li><a href="?o=ticket&v=admin&status=0"><i class="glyphicon glyphicon-remove"></i>Clear search</a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
                  
                  <a href="?o=ticket&v=create" class="btn btn-success">New <?php echo ucwords($page['model']); ?></a>
                </div>



                
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding ">

              <table class="table table-hover">
                 <tbody>
                  <?php echo $output['table']; ?>
                </tbody>
              </table>

              
              <div class="p-sm text-center">
                <p class="c-grey mb-none mt-md">
                    Showing <?php echo $output['count']; ?> out of 
                    
                    <?php if ($_GET['status'] == 'all'): ?>
                        <?php echo $output['all']; ?>    
                    <?php endif ?>
                    
                    <?php if ($_GET['status'] == '0'): ?>
                        <?php echo $output['open']; ?>    
                    <?php endif ?>

                    <?php if ($_GET['status'] == '2'): ?>
                        <?php echo $output['closed']; ?>    
                    <?php endif ?>
                    
                    entries.</p>
                    
                <?php if (!$_GET['search']): ?>
                  <nav aria-label="Page navigation">
                      <ul class="pagination">
                          <?php echo $output['navb']; ?>
                      </ul>
                  </nav>
                <?php endif; ?>
              </div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
  </div>


