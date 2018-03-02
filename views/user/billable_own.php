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
        <small><? echo $model['display_name']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?o=ticket&v=admin">Home</a></li>
        <li><a href="?o=<?php echo $page['model']; ?>&v=admin"><?php echo $page['parent']; ?></a></li>
        <li class="active"><?php echo $page['title']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

          <div class="box hidden-print">
            <div class="box-header pb-xs pt-sm pl-sm with-border">
              
              <form action="index.php" method="get" class="inline">

                <input type="hidden" name="o" value="user">
                <input type="hidden" name="v" value="billable_own">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                <div class="form-group inline-block">
                    <input type="text" name="time" value="<?php echo date('F Y',$_GET['time']); ?>" class="form-control" id="month-only">
                </div>  

                <button class="btn btn-default" style="margin-top: -3px;" type="submit">Go</button>

              </form>

            </div>
          </div>

          <h3 class="m-none mb-sm visible-print">
            <span class="c-lightgrey"><?php echo $page['title']; ?></span> <?php echo $model['display_name']; ?>
            <small><?php echo date('F Y'); ?></small>
          </h3>

          <div class="row">
            <div class="col-sm-8">

              <?php echo $table['view']; ?>

            </div>
            <div class="col-sm-4 hidden-print posrel">

              <div class="anchor-wrapper scroll-execute" data-start-scroll="200">

                
                <?php echo $table['anchor']; ?>
              </div>

            </div>
          </div>


          

        </div>
      </div>

    </section>
  </div>


