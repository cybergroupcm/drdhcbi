<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <title><?php echo $title;?></title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <?php
      #Bootstrap 3.3.2
      $link = array(
                'href' => 'template/bootstrap/css/bootstrap.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #FontAwesome 4.3.0
      $link = array(
                'href' => 'template/bootstrap/font-awesome/font-awesome.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #Ionicons 2.0.0
      $link = array(
                'href' => 'template/ionicons/ionicons.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #Theme style
      $link = array(
                'href' => 'template/dist/css/AdminLTE.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #AdminLTE Skins. Choose a skin from the css/skins  folder instead of downloading all of them to reduce the load
      $link = array(
                'href' => 'template/dist/css/skins/_all-skins.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #iCheck
      $link = array(
                'href' => 'template/plugins/iCheck/flat/blue.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #Morris chart
      $link = array(
                'href' => 'template/plugins/morris/morris.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #jvectormap
      $link = array(
                'href' => 'template/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #Date Picker
      $link = array(
                'href' => 'template/plugins/datepicker/datepicker3.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #Daterange picker
      $link = array(
                'href' => 'template/plugins/daterangepicker/daterangepicker-bs3.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #bootstrap wysihtml5 - text editor
      $link = array(
                'href' => 'template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);
      
      #Sweet Alert
      ?>
      <?php
      #jQuery 2.1.3
      $link = array(
                'src' => 'template/plugins/jQuery/jQuery-2.1.3.min.js',
                'language' => 'javascript',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      $link = array(
                'src' => 'assets/js/js.cookie.js',
                'language' => 'javascript',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #jQuery UI 1.11.2
      $link = array(
                'src' => 'template/plugins/jqueryUI/jquery-ui.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #Bootstrap 3.3.2 JS
      $link = array(
                'src' => 'template/bootstrap/js/bootstrap.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #Morris.js charts
      $link = array(
                'src' => 'template/plugins/raphael/raphael-min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);
      $link = array(
                'src' => 'template/plugins/morris/morris.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #Sparkline
      $link = array(
                'src' => 'template/plugins/sparkline/jquery.sparkline.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #jvectormap
      $link = array(
                'src' => 'template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);
      $link = array(
                'src' => 'template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #jQuery Knob Chart
      $link = array(
                'src' => 'template/plugins/knob/jquery.knob.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #daterangepicker
      $link = array(
                'src' => 'template/plugins/daterangepicker/daterangepicker.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #datepicker th
      $link = array(
          'src' => 'template/plugins/datepicker/bootstrap-datepicker-custom.js',
          'type' => 'text/javascript'
      );
      echo script_tag($link);

      $link = array(
          'src' => 'template/plugins/datepicker/locales/bootstrap-datepicker.th.js',
          'type' => 'text/javascript'
      );
      echo script_tag($link);

      #Bootstrap WYSIHTML5
      $link = array(
                'src' => 'template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #iCheck
      $link = array(
                'src' => 'template/plugins/iCheck/icheck.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #iCheck
      $link = array(
                'src' => 'template/plugins/iCheck/icheck.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #Slimscroll
      $link = array(
                'src' => 'template/plugins/slimScroll/jquery.slimscroll.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #FastClick
      $link = array(
                'src' => 'template/plugins/fastclick/fastclick.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #AdminLTE App
      $link = array(
                'src' => 'template/dist/js/app.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);
      
      #Sweet Alert App
      $link = array(
          'href' => 'template/plugins/bootstrap-sweetalert/css/sweetalert.css',
          'rel' => 'stylesheet',
          'type' => 'text/css'
      );
      echo link_tag($link);

      $link = array(
          'src' => 'template/plugins/bootstrap-sweetalert/js/sweetalert.js',
          'type' => 'text/javascript'
      );
      echo script_tag($link);

      $link = array(
                'src' => 'template/plugins/bootstrap-sweetalert/js/sweetalert.min.js',
                'type' => 'text/javascript'
      );
      echo script_tag($link);

      #bootstrap-select
      $link = array(
          'src' => 'template/plugins/bootstrap-select/js/bootstrap-select.js',
          'type' => 'text/javascript'
      );
      echo script_tag($link);

      $link = array(
          'src' => 'template/plugins/bootstrap-select/js/bootstrap-select.min.js',
          'type' => 'text/javascript'
      );
      echo script_tag($link);

      $link = array(
          'href' => 'template/plugins/bootstrap-select/css/bootstrap-select.css',
          'rel' => 'stylesheet',
          'type' => 'text/css'
      );
      echo link_tag($link);

      $link = array(
          'href' => 'template/plugins/bootstrap-select/css/bootstrap-select.min.css',
          'rel' => 'stylesheet',
          'type' => 'text/css'
      );
      echo link_tag($link);
      
      $link = array(
                  'src' => 'assets/jquery/jquery.blockUI.js',
                  'type' => 'text/javascript'
        );
        echo script_tag($link);
      ?>
    </head>
    <body class="<?php echo $body_class;?>">
      <div class="wrapper">
