<div class="content-wrapper">
<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php echo img(array('src'=>'template/dist/img/user2-160x160.jpg', 'alt'=> 'User Image','class'=>'img-circle')); ?>
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>ระบบบันทึกข้อมูลเรื่องร้องทุกข์</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo site_url('complaint/dashboard');?>"><i class="fa fa-circle-o"></i> บันทึกข้อมูลเรื่องร้องทุกข์</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> ระบบสืบค้น</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>รายงานสำหรับผู้บริหาร </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('report/report_all_complaint');?>"><i class="fa fa-circle-o"></i> รายงานรวมเรื่องร้องทุกข์</a></li>
                <li><a href="<?php echo site_url('report/report_by_channel');?>"><i class="fa fa-circle-o"></i> รายงานจำนวนเรื่องร้องทุกข์ตามช่องทางการร้องทุกข์/ตามหน่วยงาน</a></li>
                <li><a href="<?php echo site_url('report/report_by_type');?>"><i class="fa fa-circle-o"></i> รายงานจำนวนเรื่องร้องทุกข์ตามประเภทเรื่อง</a></li>

                <li><a href="<?php echo site_url('report/report_by_complainer');?>"><i class="fa fa-circle-o"></i> รายงานรายละอียดผู้ร้องเรียน/ร้องทุกข์</a></li>
                <li><a href="<?php echo site_url('report/report_by_complainant');?>"><i class="fa fa-circle-o"></i> รายงานรายละอียดผู้ถูกร้องเรียน/ร้องทุกข์</a></li>
                <li><a href="<?php echo site_url('report/report_statistic_by_type');?>"><i class="fa fa-circle-o"></i> รายงานสถิติเรื่องร้องเรียนร้องทุกข์(ประเภทเรื่อง)</a></li>
                <li><a href="<?php echo site_url('report/report_statistic_by_status');?>"><i class="fa fa-circle-o"></i> รายงานภาพรวมสถิติเรื่องร้องทุกข์(สถานะ)</a></li>
                <li><a href="<?php echo site_url('report/report_statistic_compare');?>"><i class="fa fa-circle-o"></i> รายงานภาพรวมสถิติเปรียบเทียบเรื่องร้องทุกข์</a></li>


              </ul>
            </li>
            <li class="header text-uppercase"><?php echo 'User Manager'; ?></li>
            <li class="">
              <a href="<?php echo site_url('admin/dashboard'); ?>">
                <i class="fa fa-user"></i> <span>บริหารจัดการผู้ใช้งาน</span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo site_url('setting_system'); ?>">
                <i class="fa fa-user"></i> <span>ตั้งค่าข้อมูลพื้นฐานระบบ</span>
              </a>
            </li>
          </ul>

        </section>
        <!-- /.sidebar -->
      </aside>
