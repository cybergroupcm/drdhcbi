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
                'href' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
                'rel' => 'stylesheet',
                'type' => 'text/css'
      );
      echo link_tag($link);

      #Ionicons 2.0.0
      $link = array(
                'href' => 'http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css',
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
      ?>
    </head>
    <body class="skin-blue">
      <div class="wrapper">
