<header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url('main'); ?>" class="logo"><?php echo img(array('src' => 'assets/images/logo.png','width'=>'200px'));?></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php
                  if($user_data['user']['register_photo']) {
                    if (@getimagesize(base_url('upload/register_photos/' . $user_data['user']['register_photo']))  !== false ) {
                      echo img(array('src' => 'upload/register_photos/' . $user_data['user']['register_photo'], 'alt' => 'User Image', 'class' => 'user-image'));
                    } else {
                      echo img(array('src' => 'assets/images/person_mono.jpg', 'alt' => 'User Image', 'class' => 'user-image'));
                    }
                  }else{
                    echo img(array('src' => 'assets/images/person_mono.jpg', 'alt' => 'User Image', 'class' => 'user-image'));
                  }
                  ?>
                  <span class="hidden-xs"><?php echo $user_data['user']['first_name'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <?php
                    if($user_data['user']['register_photo']) {
                      if (@getimagesize(base_url('upload/register_photos/' . $user_data['user']['register_photo']))  !== false ) {
                        echo img(array('src' => 'upload/register_photos/' . $user_data['user']['register_photo'], 'alt' => 'User Image', 'class' => 'img-circle'));
                      } else {
                        echo img(array('src' => 'assets/images/person_mono.jpg', 'alt' => 'User Image', 'class' => 'img-circle'));
                      }
                    }else{
                      echo img(array('src' => 'assets/images/person_mono.jpg', 'alt' => 'User Image', 'class' => 'img-circle'));
                    }
                    ?>
                      <p>
                      <?php echo $user_data['user']['first_name']." ".$user_data['user']['last_name'] ?>
                      <small><?php //echo $user_data['user']['position'] ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url('main/register'); ?>" class="btn btn-default btn-flat">ข้อมูลผู้ใช้งาน</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">ออกจากระบบ</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
