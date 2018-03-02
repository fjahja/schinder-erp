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

                <div class="btn-group">
                  <?php if (!$_GET['search']): ?>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Search Contact <span class="caret"></span>
                    </button>
                  <?php else: ?>
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Showing <?php echo $output['count']; ?> Search Result <span class="caret"></span>
                    </button>
                  <?php endif; ?>
                  
                  <ul class="dropdown-menu">
                    <li><a href="#" data-toggle="modal" data-target="#crmctSearchByName"><i class="fa fa-search"></i>Search by name</a></li>
                    <?php if ($_GET['search']): ?>
                      <li role="separator" class="divider"></li>
                      <li><a href="?o=crm_contact&v=admin"><i class="glyphicon glyphicon-remove"></i>Clear search</a></li>
                    <?php endif; ?>
                  </ul>
                </div>

                <div class="pull-right" style="margin-bottom:15px;">

                  <?php if ($_GET['trash'] == 0): ?>
                    <a href="?o=crm_contact&v=admin&trash=1" class="btn btn-default" data-toggle="tooltip" data-placement="top" data-original-title="View all records in trash bin"><i class="glyphicon glyphicon-trash"></i> Trash bin</a>
                  <?php endif ?>

                  <?php if ($_GET['trash'] == 1): ?>
                    <a href="?o=crm_contact&v=admin" class="btn btn-default" data-toggle="tooltip" data-placement="top" data-original-title="View all active records"><i class="glyphicon glyphicon-saved"></i> Back to active records</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelEmptyTrash"><i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Empty trash</button>
                  <?php endif ?>

                  <?php if (hasPermission($admin,array(403))): ?>
                    <a href="?o=<?php echo $page['model']; ?>&v=create" class="btn btn-success">New</a>
                  <?php endif ?>
                </div>
            </div>

            <div class="box-body table-responsive no-padding ">
              <table class="table table-hover">
                 <tbody>
                  <?php if ($_GET['trash'] == 0): ?>
                    <td colspan="99" style="padding:0px;">
                      <table class="table" style="margin-bottom: 0;">
                        <tr class="alpha-click text-center warning">
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=A">A</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=B">B</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=C">C</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=D">D</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=E">E</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=F">F</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=G">G</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=H">H</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=I">I</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=J">J</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=K">K</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=L">L</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=M">M</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=N">N</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=O">O</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=P">P</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=Q">Q</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=R">R</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=S">S</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=T">T</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=U">U</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=V">V</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=W">W</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=X">X</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=Y">Y</a></td>
                          <td><a href="?<?php echo removeUrl($currentUrl,'idx'); ?>&idx=Z">Z</a></td>
                        </tr>
                      </table>
                    </td>
                  <?php endif; ?>
                  <?php echo $output['view']; ?>
                </tbody>
              </table>
            </div>


          </div>
        </div>
      </div>

    </section>
  </div>


  <div class="modal" id="modelEmptyTrash" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Confirm empty trash</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to empty the trash? All records will be deleted and this cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <form action="crud/<?php echo $page['model']; ?>.php?v=empty_trash" method="post" class="inline">
            <input type="hidden" name="Form[return]" value="index.php?o=<?php echo $page['model']; ?>&v=admin&alert=trash_emptied">
            <button type="submit" class="btn btn-primary">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>


