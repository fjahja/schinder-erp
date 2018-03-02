
<?php if ($admin['running_contributions']['count'] != 0): ?>
  <div class="hidden-print toast-wrapper <?php echo (isset($_GET['toast']) ? '' : 'closed'); ?>">
    <div class="toast-header c-white c-pointer">
      <p class="pl-sm">You have <span class="c-yellow"><?php echo $admin['running_contributions']['count']; ?></span> contributions running</p>
      <i class="glyphicon glyphicon-resize-full toast-lbl"></i>
      <i class="glyphicon glyphicon-resize-small toast-lbl"></i>
    </div>
    <div class="toast-body p-sm">
      <table class="table running-cont">
        <tbody>
          <?php echo $admin['running_contributions']['view']; ?>
        </tbody>
      </table>
    </div>
    <div class="toast-footer pl-sm">
      <a href="?<?php echo removeUrl($currentUrl,'alert') . '&toast=1'; ?>" class="c-white"><i class="glyphicon glyphicon-refresh"></i> Refresh</a>
    </div>
  </div>
<?php endif ?>
<!-- Contributions modal & toast -->





<header class="main-header"  id="top">
    <!-- Logo -->
    <a href="?" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SLF</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Schinder</b>ERP</span>
      
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">

      


      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="posrel" style="padding-top: 13px;">
              <div class="usr-header" style="background:<?php echo $admin['color']; ?>;"><?php echo userInitial($admin['display_name']); ?></div>
              <span class="hidden-xs"><?php echo $admin['display_name']; ?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>