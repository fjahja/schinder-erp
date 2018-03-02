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

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#tab_3" data-toggle="tab">
                  Settings
                </a>
              </li>
            </ul>
            <div class="tab-content p-none">

              <div class="tab-pane active p-sm" id="tab_3">
                <div class="row">
                  <div class="col-xs-8">

                    <form class="form-horizontal" action="crud/user.php?v=update" method="post">

                      <input type="hidden" name="Form[id]" value="<?php echo $admin['id']; ?>">
                      <input type="hidden" name="Form[return]" value="index.php?o=user&v=profile&alert=updated&tab=3">

                      <div class="box-body">

                        <div class="form-group" data-toggle="tooltip" data-placement="top" data-original-title="Emails are set by ERP admin">
                          <label class="col-sm-2 control-label">New notifications</label>
                          <div class="col-sm-10">
                            <input
                              type="email"
                              class="form-control"
                              placeholder="Email address"
                              name="Form[email]"
                              value="<?php echo $admin['email']; ?>"
                              autofocus="autofocus"

                              disabled="disabled"

                              
                            >
                            <p class="c-lightgrey mt-xs"><em>Please input only 1 email address</em></p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 control-label">Login password</label>
                          <div class="col-sm-10">
                            <input
                              type="password"
                              class="form-control"
                              placeholder="Password"
                              name="Form[password]"
                              value="<?php echo $admin['password']; ?>"
                            >
                          </div>
                        </div>

                      </div>
                      <div class="box-footer mt-sm">
                        <a href="javascript:history.back()" class="pull-left btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>

            </div>
          </div>


        </div>
      </div>

    </section>
  </div>


