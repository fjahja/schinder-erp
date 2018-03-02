<body class="hold-transition skin-blue sidebar-mini control-sidebar-open">
<div class="wrapper">

  <?php require('snippets/header.php'); ?>

  <?php require('snippets/sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="col-sm-10">
        <h1 class="mt-none">
          <span class="c-lightgrey"><?php echo $page['title']; ?></span> <?php echo $model['subject']; ?>
        </h1>
      </div>
      <ol class="breadcrumb">
        <li><a href="?o=ticket&v=admin">Home</a></li>
        <li><a href="?o=ticket&v=admin&client=<?php echo $client['id']; ?>"><?php echo $page['parent']; ?></a></li>
        <li class="active"><?php echo $page['title']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

          <?php require('snippets/alerts.php'); ?>

          <div class="box pb-sm">
            <div class="box-header with-border lh-34" style="height:57px;">

              <div class="row visible-print">
                <div class="col-sm-12">
                  <h1 class="mt-none">
                    <span class="c-lightgrey"><?php echo $page['title']; ?></span> <?php echo $model['subject']; ?>
                  </h1>
                </div>
              </div>

              <ul class="intab p-none pull-left">
                <li class="<?php echo ($_GET['tab'] == 'home' ? 'active' : ''); ?>"><a href="#home" data-toggle="tab" role="tab">Description</a></li>
                <li class="<?php echo ($_GET['tab'] == 'contributions' ? 'active' : ''); ?>"><a href="#contributions" data-toggle="tab" role="tab">Contributions (12)</a></li>
              </ul>

              <div class="pull-right hidden-print">

                <?php if ($model['status'] == 0): ?>
                  <?php if (hasPermission($admin,array(35))): ?>
                    <form action="crud/ticket.php?v=close" method="post" class="inline">
                      <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
                      <input type="hidden" name="Form[return]" value="index.php?o=ticket&v=view&id=<?php echo $model['id']; ?>&alert=closed">
                      <button type="submit" class="btn btn-default">Close</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if ($model['status'] == 2): ?>
                  <?php if (hasPermission($admin,array(36))): ?>
                    <form action="crud/ticket.php?v=reopen" method="post" class="inline">
                      <input type="hidden" name="Form[id]" value="<?php echo $model['id']; ?>">
                      <input type="hidden" name="Form[return]" value="index.php?o=ticket&v=view&id=<?php echo $model['id']; ?>&alert=reopened">
                      <button type="submit" class="btn btn-default">Reopen task</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if (hasPermission($admin,array(33))): ?>
                <a href="?o=ticket&v=update&id=<?php echo $model['id']; ?>" class="btn btn-default">Edit</a>
                <?php endif ?>

                <?php if (hasPermission($admin,array(31))): ?>
                <a href="?o=ticket&v=create" class="btn btn-success">New task</a>
                <?php endif ?>

                <?php if (hasPermission($admin,array(34))): ?>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ticketDelete">Delete</button>
                <?php endif ?>

              </div>
            </div>

            <div class="box-body pb-xs pt-sm">

              <div class="tab-content ticketview">

                <div role="tabpanel" class="tab-pane <?php echo ($_GET['tab'] == 'home' ? 'active' : ''); ?>" id="home">
                  <?php if (!empty($model['issue'])): ?>
                    <?php echo htmlspecialchars_decode($model['issue']); ?>
                  <?php else: ?>
                    <em>No issue description.</em>
                  <?php endif; ?>
                </div>

                <div role="tabpanel" class="tab-pane <?php echo ($_GET['tab'] == 'contributions' ? 'active' : ''); ?>" id="contributions">

                  <table class="table table-condensed c-grey">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Contributor</th>
                        <th>Duration</th>
                        <th>Remarks</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><i class="c-ccc glyphicon glyphicon-time c-pointer" data-toggle="tooltip" data-placement="top" data-original-title="Running"></i></td>
                        <td class="c-lightgrey">28 Oct 2017</td>
                        <td>Dewi Susanti</td>
                        <td>3 hrs, 20 min</td>
                        <td style="width:30%;">Lupa start.</td>
                        <td style="width:10%;" class="text-center"><a href="#" class="c-lightgrey"></a></td>
                      </tr>
                      <tr class="warning">
                        <td><i class="c-green glyphicon glyphicon-ok c-pointer" data-toggle="tooltip" data-placement="top" data-original-title="Finished"></i></td>
                        <td class="c-lightgrey">29 Oct 2017</td>
                        <td>Juliani</td>
                        <td>15 min</td>
                        <td style="width:30%;"></td>
                        <td style="width:10%;" class="text-center"><a href="#" class="c-lightgrey">edit</a></td>
                      </tr>
                      <tr>
                        <td><i class="c-ccc glyphicon glyphicon-time c-pointer" data-toggle="tooltip" data-placement="top" data-original-title="Running"></i></td>
                        <td class="c-lightgrey">01 Nov 2017</td>
                        <td>Dewi Susanti</td>
                        <td>4 hrs, 3 min</td>
                        <td style="width:30%;"></td>
                        <td style="width:10%;" class="text-center"><a href="#" class="c-lightgrey"></a></td>
                      </tr>
                      <tr>
                        <td><i class="c-ccc glyphicon glyphicon-time c-pointer" data-toggle="tooltip" data-placement="top" data-original-title="Running"></i></td>
                        <td class="c-lightgrey">03 Nov 2017</td>
                        <td>Budhi</td>
                        <td>1 hrs, 23 min</td>
                        <td style="width:30%;"></td>
                        <td style="width:10%;" class="text-center"><a href="#" class="c-lightgrey"></a></td>
                      </tr>
                      <tr class="tbl-total">
                        <td></td>
                        <td></td>
                        <td><b>Total man-hours:</b></td>
                        <td><b>24 hrs, 23 min</b></td>
                        <td style="width:30%;"></td>
                        <td style="width:10%;" class="text-center"><a href="#" class="c-lightgrey"></a></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>

              <br><br>

              <?php echo $activity['table']; ?>

              <div class="hidden-print bd-top pt-sm" id="commentbox">
                <form class="posrel" action="crud/comment.php?v=create_ticket" method="post">

                  <div class="usr-comment" style="background:<?php echo $admin['color']; ?>;"><?php echo userInitial($admin['display_name']); ?></div>

                  <input type="hidden" name="Form[ticket_id]" value="<?php echo $model['id']; ?>">
                  <input type="hidden" name="Form[return]" value="index.php?o=ticket&v=view&id=<?php echo $model['id']; ?>&alert=comment_created">

                  <div class="form-group pl-xl">
                    <div class="col-sm-10 p-none">
                      <textarea id="ticket_comment" name="Form[comment]" class="textarea mb-xs" placeholder="Comments will be sent as emails replies to all users and administrators..."
                      style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      <?php if($_GET['vld'] == 'blank'): ?>
                        <p class="c-red mt-xs"><em>Comment cannot be blank</em></p>
                      <?php endif;  ?>
                      <br>
                      <button type="submit" class="btn btn-success">Comment</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>

        </div>
      </div>

    </section>
  </div>

  <div class="modal" id="editlabels" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit tags</h4>
          <?php require('snippets/loader.php'); ?>
        </div>
          <input type="hidden" class="ajax_ticketid" value="<?php echo $model['id']; ?>">
          <input type="hidden" value="index.php?o=ticket&v=view&id=<?php echo $model['id']; ?>&alert=updated">

        <div class="modal-body">
          <?php echo $tags_checks['table']; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="editassignee" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
      <div class="modal-content p-none ">
        <div class="modal-header">
          <h4 class="modal-title">Edit assignee</h4>
          <?php require('snippets/loader.php'); ?>
        </div>
          <input type="hidden" class="ajax_ticketid" value="<?php echo $model['id']; ?>">
          <input type="hidden" value="index.php?o=ticket&v=view&id=<?php echo $model['id']; ?>&alert=updated">

        <div class="modal-body p-none">
          <table class="table table-hover mb-none">
            <tbody>
                          
              <?php echo $assigneeCheck['view']; ?>

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light control-sidebar-open h100 pl-sm pr-sm">
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <?php if ($model['status'] == 0): ?>
        <button type="button" class="btn btn-info btn-xs mt-n2">Open</button>&nbsp;
      <?php endif; ?>
      <?php if ($model['status'] == 2): ?>
        <button type="button" class="btn btn-danger btn-xs mt-n2">Closed</button>&nbsp;
      <?php endif; ?>
      <a href="?o=ticket&v=admin&client=<?php echo $client['id']; ?>" class="btn btn-default btn-xs mt-n2"><?php echo $client['name']; ?></a>
      <div class="clear"></div>
      <br>
      <span class="c-lightgrey">
        <em>
        Reported on <?php echo date('j M, Y',strtotime($model['timestamp'])); ?>
        by 
        <?php echo $reporter['display_name']; ?>
        </em>
      </span>
      <br>
      <br>
    </div>
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Due date:</h3>
        <a href="?o=ticket&v=update&id=<?php echo $model['id']; ?>" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <br>
        
      <span class="c-lightgrey"><?php echo $model['_due_date']; ?></span>
      <div class="clear"></div>
      <br>
    </div>
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Category:</h3>
        <a href="?o=ticket&v=update&id=<?php echo $model['id']; ?>" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <br>
        
      <span class="c-lightgrey"><?php echo $category['name']; ?></span>
      <div class="clear"></div>
      <br>
    </div>
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Labels:</h3>
      <?php if (hasPermission($admin,array(33))): ?>
        <a href="#" data-toggle="modal" data-target="#editlabels" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <?php endif ?>
      <br>
      <div class="lbl-container">
        <?php if(!empty($tags['table'])): ?>
          <?php echo $tags['table']; ?>
        <?php else: ?>
          <span class="c-lightgrey cnone">None</span>
        <?php endif; ?>
      </div>
      <div class="clear"></div>
      <br>
    </div>
    
    <!-- side item -->
    <div class="side-item pt-sm posrel">
      <h3 class="sm m-none">Assigned to:</h3>
      <?php if (hasPermission($admin,array(33))): ?>
        <a href="#" data-toggle="modal" data-target="#editassignee" class="c-ccc posabs edit-mdl"><em>edit</em></a>
      <?php endif ?>
      <br>
      <div class="asignee-container">
        <?php if (!empty($assignee['view'])): ?>
          <?php echo $assignee['view']; ?>
        <?php else: ?>
          <span class="c-lightgrey anone">No assignee</span>
        <?php endif; ?>
      </div>
      
      <div class="clear"></div>
      <br>
    </div>

  </aside>


