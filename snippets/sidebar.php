<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <div class="usr-big" style="background:<?php echo $admin['color']; ?>;"><?php echo userInitial($admin['display_name']); ?></div>
        </div>
        <div class="pull-left info">
          <p><?php echo $admin['display_name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $admin['position']; ?></a>
          
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">


        <?php if (hasPermission($admin,array(20,204,209,210,100,70,219,228,229,240,219,220))): ?>
          <li class="header">MAIN NAVIGATION</li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(20))): ?>
        <li class="<?php echo ($o=='client' ? 'active' : ''); ?> ">
          <a href="?o=client&v=admin">
            <i class="fa fa-users"></i> <span>Clients</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(204))): ?>
        <li class="
          <?php echo ($o=='agreement' && $v!='board' ? 'active' : ''); ?> 
        ">
          <a href="?o=agreement&v=admin">
            <i class="fa fa-bank"></i> <span>Agreements</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(209,210))): ?>
        <li class="
          <?php echo ($o=='ticket' && $v!='board' ? 'active' : ''); ?> 
        ">
          <a href="?o=ticket&v=admin&status=0">
            <i class="fa fa-book"></i> <span>Tasks</span>
            <!-- <span class="pull-right-container">
                <small class="label pull-right bg-red" style="font-weight: normal;font-size: 12px;margin-top: -2px;"><?php echo ($admin['open_tasks']['count'] != 0 ? $admin['open_tasks']['count'] : ''); ?></small>
              </span> -->
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(100))): ?>
        <li class="
          <?php echo ($o=='category' ? 'active' : ''); ?> 
        ">
          <a href="?o=category&v=admin&status=0">
            <i class="fa fa-folder"></i> <span>Task Categories</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(70))): ?>
        <li class="
          <?php echo ($o=='label' ? 'active' : ''); ?> 
        ">
          <a href="?o=label&v=admin">
            <i class="fa fa-tags"></i> <span>Task Labels</span>
          </a>
        </li>
        <?php endif ?>

        

        <?php if (hasPermission($admin,array(219))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='request_backtrack' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=request_backtrack">
            <i class="fa fa-flag-o"></i> <span>Request Backtrack</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(228))): ?>
        <li class="<?php echo ($o=='file' && $v=='admin' ? 'active' : ''); ?> ">
          <a href="?o=file&v=admin">
            <i class="fa fa-sticky-note-o"></i> <span>Legal Templates</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(229))): ?>
        <li class="<?php echo ($o=='site' && $v=='slf_blog' ? 'active' : ''); ?> ">
          <a href="?o=site&v=slf_blog">
            <i class="fa fa-newspaper-o"></i> <span>SLF Blog</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(240))): ?>
        <li class="<?php echo ($o=='calendar' && $v=='admin' ? 'active' : ''); ?> ">
          <a href="?o=calendar&v=admin">
            <i class="fa fa-calendar-check-o"></i> <span>Calendar</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(219))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='request_backtrack' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=request_backtrack">
            <i class="fa fa-flag-o"></i> <span>Request Backtrack</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(220))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='manage_backtrack' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=manage_backtrack">
            <i class="fa fa-flag"></i> <span>Backtrack Requests</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-red" style="font-weight: normal;font-size: 12px;margin-top: -2px;"><?php echo ($admin['contributions_count']['pending'] != 0 ? $admin['contributions_count']['pending'] : ''); ?></small>
              </span>
          </a>
        </li>
        <?php endif ?>

        
        <?php if (hasPermission($admin,array(401,402))): ?>
          <li class="header">CRM</li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(401))): ?>
        <li class="<?php echo ($o=='crm_contact'? 'active' : ''); ?> ">
          <a href="?o=crm_contact&v=admin">
            <i class="fa fa-male"></i> <span>CRM Contacts</span>
          </a>
        </li> 
        <?php endif ?>

        <?php if (hasPermission($admin,array(430))): ?>
        <li class="<?php echo ($o=='crm_company'? 'active' : ''); ?> ">
          <a href="?o=crm_company&v=admin">
            <i class="fa fa-building-o"></i> <span>CRM Companies</span>
          </a>
        </li> 
        <?php endif ?>

        <?php if (hasPermission($admin,array(401))): ?>
        <li class="<?php echo ($o=='crm_label' ? 'active' : ''); ?> ">
          <a href="?o=crm_label&v=admin">
            <i class="fa fa-bookmark-o"></i> <span>CRM Labels</span>
          </a>
        </li> 
        <?php endif ?>
        
        <?php if (hasPermission($admin,array(222,223,217,218,48,203,10))): ?>
          <li class="header">REPORTS</li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(222))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='admin' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=admin">
            <i class="fa fa-tasks"></i> <span>Manage Contributions</span>
          </a>
        </li> 
        <?php endif ?>

        <?php if (hasPermission($admin,array(223))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='running' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=running&running=1">
            <i class="fa fa-clock-o"></i> <span>Running Contributions</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red" style="font-weight: normal;font-size: 12px;margin-top: -2px;"><?php echo ($admin['contributions_count']['running'] != 0 ? $admin['contributions_count']['running'] : ''); ?></small>
            </span>
          </a>
        </li> 
        <?php endif ?>

        <?php if (hasPermission($admin,array(217))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='mycontributions' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=mycontributions">
            <i class="fa fa-briefcase"></i> <span>Contributions (Own)</span>
          </a>
        </li> 
        <?php endif ?>

        <?php if (hasPermission($admin,array(218))): ?>
        <li class="<?php echo ($o=='contribution' && $v=='mycontributions' ? 'active' : ''); ?> ">
          <a href="?o=contribution&v=mycontributions">
            <i class="fa fa-briefcase"></i> <span>Contributions (All Users)</span>
          </a>
        </li> 
        <?php endif ?>

        <?php if (hasPermission($admin,array(48))): ?>
        <li class="<?php echo ($o=='user' && $v=='billable' ? 'active' : ''); ?> ">
          <a href="?o=user&v=billable">
            <i class="fa fa-file-text"></i> <span>Billable Report</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(203))): ?>
        <li class="<?php echo ($o=='user' && $v=='billable_own' ? 'active' : ''); ?> ">
          <a href="?o=user&v=billable_own">
            <i class="fa fa-file-text"></i> <span>Billable Report (Own)</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (hasPermission($admin,array(10))): ?>
        <li class="<?php echo ($o=='user' && $v!='profile'  && $v!='billable' ? 'active' : ''); ?> ">
          <a href="?o=user&v=admin">
            <i class="fa fa-users"></i> <span>Users</span>
          </a>
        </li>
        <?php endif ?>

        <li class="header">SYSTEM</li>


        <li class="<?php echo ($o=='user' && $v=='profile' ? 'active' : ''); ?> ">
          <a href="?o=user&v=profile">
            <i class="fa fa-user"></i> <span>My Profile</span>
          </a>
        </li>
        <?php if (hasPermission($admin,array(300))): ?>
        <li>
          <a href="?o=site&v=signage">
            <i class="fa fa-object-group"></i> <span>Signage</span>
          </a>
        </li>
        <?php endif ?>
        <li>
          <a href="login-processor.php?v=admin-logout">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>