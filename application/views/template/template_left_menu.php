<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
                <?php
                  foreach($main_menu as $key => $value){
                    $sub_menu_data = @$sub_menu[$value['app_id']];
                    ?>
                    <li class="">
                      <a href="<?php echo  $value['app_url']!=''?site_url($value['app_url']):'#'; ?>">
                        <?php
                          if($value['app_image'] != ''){
                            echo $value['app_image'];
                          }
                        ?>
                        <span><?php echo $value['app_name'] ?></span>
                        <?php
                          if(!empty($sub_menu_data)){
                            ?>
                            <i class="fa fa-angle-left pull-right"></i>
                            <?php
                          }
                        ?>
                      </a>

                    <?php

                    if(!empty($sub_menu_data)){
                      ?>
                      <ul class="treeview-menu">
                      <?php
                      foreach($sub_menu_data as $key_sub => $value_sub){
                        ?>
                        <li>
                          <a href="<?php echo  $value_sub['app_url']!=''?site_url($value_sub['app_url']):''; ?>">
                            <?php
                            if($value_sub['app_image'] != ''){
                              echo $value_sub['app_image'];
                            }
                            ?>
                            <span><?php echo $value_sub['app_name'] ?></span>
                          </a>
                        </li>
                        <?php
                      }
                      ?>
                      </ul>
                      <?php
                    }
                    ?>
                    </li>
                    <?php
                  }
                ?>
          </ul>

        </section>
        <!-- /.sidebar -->
      </aside>
    <div class="content-wrapper">
