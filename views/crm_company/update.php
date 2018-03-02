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
        <li><a href="?o=<?php echo $page['model']; ?>&v=admin"><?php echo $page['parent']; ?></a></li>
        <li class="active">Edit ticket</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">


          <div class="box">

            <div class="box-body pb-xs pt-sm">
              
              <div class="row">
                <div class="col-xs-8">

                  <form class="form-horizontal" action="crud/<?php echo $page['model']; ?>.php?v=update" method="post">

                    <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
                    <input type="hidden" name="Form[return]" value="index.php?o=<?php echo $page['model']; ?>&v=admin&alert=updated">

                    <?php require('_form.php'); ?>

                  </form>

                </div>
              </div>
              



            </div>
          </div>

        </div>
      </div>

    </section>
  </div>

