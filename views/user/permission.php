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
        <small><?php echo $model['display_name']; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?o=ticket&v=admin">Home</a></li>
        <li><a href="?o=<?php echo $page['model']; ?>&v=admin"><?php echo $page['parent']; ?></a></li>
        <li class="active">Edit <?php echo $page['model']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header pb-xs pt-sm pl-sm with-border">
              <div class="form-group inline-block">
                  <select class="form-control" onchange="location = this.value;">
                    <?php echo $jumper['view']; ?>
                  </select>
              </div>  
              <div class="form-group inline-block">
                  <select class="form-control" onchange="location = this.value;">
                    <option disabled="disabled" selected="selected">Select permission template</option>
                  </select>
              </div>  
            </div>
          </div>

          <?php require('snippets/alerts.php'); ?>

          <div class="box">

            <div class="box-body pb-xs pt-sm">
              
              <div class="row">
                <div class="col-xs-12">

                  <form class="form-horizontal" action="crud/<?php echo $page['model']; ?>.php?v=update_permission" method="post">

                    <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
                    <input type="hidden" name="Form[return]" value="index.php?o=<?php echo $page['model']; ?>&v=permission&id=<?php echo $model['id']; ?>&alert=updated">

                    <div class="box-body">

                      

                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="col-md-2">Modules</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $permissionTable['view']; ?>
                          
                        </tbody>
                      </table>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer mt-sm">
                      <a href="?o=<?php echo $page['model']; ?>&v=admin" class="btn btn-default">Back</a>
                      <button type="submit" class="btn btn-info pull-right">Update permission</button>
                    </div>
                    <!-- /.box-footer -->
                  </form>

                </div>
              </div>
              



            </div>
          </div>

        </div>
      </div>

    </section>
  </div>


