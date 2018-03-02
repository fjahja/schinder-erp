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
        <? if ($directory['file_count'] != 0): ?>
          <small><? echo $directory['file_count']; ?> files found</small>
        <? endif ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="?o=ticket&v=admin">Home</a></li>
        <li><a href="?o=file&v=admin"><?php echo $page['title']; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">

          <?php require('snippets/alerts.php'); ?>

          <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> Notice:</h4>
            Please kindly visit and share these blog posts in your respective LinkedIn, Twitter, Facebook and other social media.
          </div>

          <div class="box">
            <div class="box-header pb-xs pt-sm with-border">

                <div class="form-group inline-block">
                    <select class="form-control" onchange="location = this.value;">
                      <option <?php echo ($_GET['lang'] == 'eng' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'lang'); ?>&lang=eng">English</option>
                      <option <?php echo ($_GET['lang'] == 'chn' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'lang'); ?>&lang=chn">中文</option>
                      <option <?php echo ($_GET['lang'] == 'ind' ? 'selected' : ''); ?> value="?<?php echo removeUrl($currentUrl,'lang'); ?>&lang=ind">Bahasa</option>
                    </select>
                </div>

                <div class="pull-right">

                  <a href="http://schinderlawfirm.com/?p=blog&l=eng" class="btn btn-primary" target="_blank">Visit public blog page</a>

                </div>

            </div>
            <!-- /.box-header -->
          </div>
          <!-- /.box -->

          

          <style type="text/css">
            .slf-blog-item {
              background:white;
              margin-bottom: 50px;
              position: relative;
            }
            .slf-blog-item .blog-thumb {
              height: 250px;
              background-size: cover;
              position: relative;
              z-index: 5;
            }
            .slf-blog-item .blog-date {
              position: absolute;
              z-index: 50;
              background: #00BCD4;
              padding: 12px 15px;
              text-align: center;
              color: white;
            }
            .slf-blog-item .blog-date .dtm {
              font-size: 30px;
              line-height: 28px;
              font-weight: bold;
              display: block;
            }
            .slf-blog-item .blog-date .dtt {
              font-size: 18px;
              display: block;
            }
            .slf-blog-item .blog-date .dty {
              opacity: 0.5;
              line-height: 25px;
              display: block;
            }
            .slf-blog-item .blog-desc {
              padding:15px;
              padding-bottom:25px;
            }
          </style>


          <? echo $blog['view']; ?>


        </div>
      </div>

    </section>
  </div>





