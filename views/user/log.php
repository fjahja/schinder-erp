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
          <div class="box">
            <div class="box-header pb-xs pt-sm with-border">

                <?php require('snippets/alerts.php'); ?>

                <div class="pull-left lh-34 c-lightgrey">
                  
                  Showing <?php echo $activity['count']; ?> activities for <u class="c-grey"><?php echo $model['display_name']; ?></u> 
                  on <u class="c-grey"><?php echo date('l, j F Y',strtotime($timestamp)); ?></u>
                </div>



                <div class="pull-right">
                    
                    <div class="form-group inline-block">
                        <select class="form-control" onchange="location = this.value;">
                          <?php echo $users['select']; ?>
                        </select>
                    </div>
                    
                    <div class="form-group inline-block mr-sm">
                        <select class="form-control" onchange="location = this.value;">
                          <option value="?<?php echo removeUrl($currentUrl,'at'); ?>">All Activity</option>
                          <option <?php echo ($_GET['at'] == 31 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=31">Ticket - Create</option>
                          <option <?php echo ($_GET['at'] == 33 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=33">Ticket - Update</option>
                          <option <?php echo ($_GET['at'] == 35 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=35">Ticket - Close</option>
                          <option <?php echo ($_GET['at'] == 36 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=36">Ticket - Reopen</option>
                          <option <?php echo ($_GET['at'] == 34 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=34">Ticket - Delete</option>
                          <option <?php echo ($_GET['at'] == 51 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=51">Ticket - Comment</option>
                          <option <?php echo ($_GET['at'] == 41 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=41">Asset - Create</option>
                          <option <?php echo ($_GET['at'] == 43 ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'at'); ?>&at=43">Asset - Update</option>
                        </select>
                    </div>
                    
                    <form action="index.php" method="get" class="inline">

                      <input type="hidden" name="o" value="user">
                      <input type="hidden" name="v" value="log">
                      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                      <?php if ($_GET['at'] != 'all'): ?>
                        <input type="hidden" name="at" value="<?php echo $_GET['at']; ?>">
                      <?php endif ?>

                      <div class="form-group inline-block">
                          <select class="form-control" name="day">
                            <!-- <option value="all" <?php echo ($_GET['day'] == 'all' ? 'selected="selected"' : ''); ?>>All</option> -->
                            <?php displayDateSelect($timestamp); ?>
                          </select>
                      </div>

                      <div class="form-group inline-block">
                          <select class="form-control" name="month">
                            <!-- <option value="all" <?php echo ($_GET['month'] == 'all' ? 'selected="selected"' : ''); ?>>All</option> -->
                            <?php displayMonthSelect($timestamp); ?>
                          </select>
                      </div>

                      <div class="form-group inline-block">
                          <select class="form-control" name="year">
                            <!-- <option value="all" <?php echo ($_GET['year'] == 'all' ? 'selected="selected"' : ''); ?>>All</option> -->
                            <?php displayYearSelect($timestamp); ?>
                          </select>
                      </div>

                      <button class="btn btn-default" type="submit"><i class="c-lightgrey glyphicon glyphicon-search"></i>&nbsp;&nbsp;Search Date</button>

                    </form>

                    <a href="?o=user&v=log&id=<?php echo $_GET['id']; ?>" class="btn btn-default">Today</a>
                  
                </div>


                
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding ">

              <table class="table">
                <tbody>
                  <?php echo $activity['table']; ?>
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


