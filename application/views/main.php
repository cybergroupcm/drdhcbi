
      <!-- Right side column. Contains the navbar and content of the page -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            สรุปภาพรวมข้อมูลเรื่องร้องทุกข์
            <small>ศูนย์ดำรงธรรม จังหวัดชลบุรี</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-12 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $sum_status['sum_all'];?> <sup style="font-size: 20px">(รายการ)</sup></h3>
                  <p><h4>ข้อมูลเรื่องร้องทุกข์ทั้งหมด<h4></p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $sum_status['1'];?> <sup style="font-size: 20px">(รายการ)</sup></h3>
                  <p><h4>อยู่ระหว่างรับเรื่อง<h4></p>
                </div>
                <div class="icon">
                  <i class="ion ion-email-unread"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $sum_status['2'];?> <sup style="font-size: 20px">(รายการ)</sup></h3>
                  <p><h4>รับเรื่อง<h4></p>
                </div>
                <div class="icon">
                  <i class="ion ion-email"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $sum_status['3'];?> <sup style="font-size: 20px">(รายการ)</sup></h3>
                  <p><h4>ส่งต่อเรื่อง<h4></p>
                </div>
                <div class="icon">
                  <i class="ion ion-share"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $sum_status['4'];?> <sup style="font-size: 20px">(รายการ)</sup></h3>
                  <p><h4>บันทึกผลเรียบร้อย<h4></p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark-circled"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Map -->
          <div class="row">
            <div class="col-lg-6 col-xs-6">
              <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACSdMKi4OrvylAegEJXXR3--RnLUYUBtw"></script>
              <?php
              $link = array('src' => 'assets/js/util.js', 'language' => 'javascript', 'type' => 'text/javascript');
              echo script_tag($link);
              $link = array('src' => 'assets/js/util_control.js', 'language' => 'javascript', 'type' => 'text/javascript');
              echo script_tag($link);
              $link = array('src' => 'assets/js/main_map.js', 'language' => 'javascript','type' => 'text/javascript');
              echo script_tag($link);
              ?>
              <script type="text/javascript">
              var map;
              var all_markers = [];
              var all_polygons = [];
              var all_polygonMap = [];
              var xml = [];
                function initialize() {
                  var myLatlng = new google.maps.LatLng(13.0464384,101.1786521);
                  var myOptions = {
                    zoom: 9,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  map = new google.maps.Map(document.getElementById("map"), myOptions);
                  <?php
                  foreach ($area_data as $area_id) {
                  ?>
                  addlayerXML(document.getElementById('map_<?php echo $area_id;?>'));
                  <?php
                  }
                  ?>
                }
              /*
              ========== On Load Map ===========
              */
              google.maps.event.addDomListener(window, 'load', initialize);
              </script>
              <div class="box box-primary" >
                <div style="margin:0px;background-color: #2A5D9C;color:#ffffff;font-size:18px;" >
                    <div style="padding-left: 5px;padding-top: 2px;padding-bottom:2px;">
                    <?php
                    foreach ($area_data as $area_id) {
                    ?>
                      <input name="map_<?php echo $area_id;?>" type="checkbox" style="display:none;" checked="checked" value="main/get_xml_map/<?php echo $area_id;?>" id="map_<?php echo $area_id;?>" >
                    <?php
                    }
                    ?>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    ข้อมูลเรื่องร้องทุกข์ทั้งหมดจำแนกรายพื้นที่
                    </div>
                </div>
                <div id="map" style="height:420px;width:100%;" ></div>
              </div>
            </div>

            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="box box-primary">
                <div style="margin:0px;background-color: #2A5D9C;color:#ffffff;font-size:18px;" >
                    <div style="padding-left: 5px;padding-top: 2px;padding-bottom:2px;">
                      <i class="fa fa-bar-chart-o"></i>
                      เรื่องร้องทุกข์ 5 ประเภทที่มีผู้ร้องเรียนมากสุด
                    </div>
                </div>
                <?php
                $link = array(
                    'src' => 'template/plugins/flot/jquery.flot.min.js',
                    'type' => 'text/javascript'
                );
                    echo script_tag($link);
                $link = array(
                    'src' => 'template/plugins/flot/jquery.flot.resize.min.js',
                    'type' => 'text/javascript'
                );
                    echo script_tag($link);
                $link = array(
                    'src' => 'template/plugins/flot/jquery.flot.pie.min.js',
                    'type' => 'text/javascript'
                );
                    echo script_tag($link);
                $link = array(
                    'src' => 'template/plugins/flot/jquery.flot.categories.min.js',
                    'type' => 'text/javascript'
                );
                    echo script_tag($link);
                ?>
                <div class="box-body chart-responsive">
                  <div class="chart" id="donut-chart" style="height: 400px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <script>
              /*
                       * DONUT CHART
                       * -----------
                       */

                      var donutData = [
                      <?php
                        foreach ($sum_type as $data_type) {
                      ?>
                        { label: "<?php echo $data_type['complain_type_name'];?>",
                          data: <?php echo $data_type['sum_complain'];?>,
                          color: "<?php echo $data_type['color'];?>"
                        },
                      <?php } ?>
                      ];
                      $.plot("#donut-chart", donutData, {
                        series: {
                          pie: {
                            show: true,
                            radius: 1,
                            innerRadius: 0.5,
                            label: {
                              show: true,
                              radius: 2 / 3,
                              formatter: labelFormatter,
                              threshold: 0.1
                            }

                          }
                        },
                        legend: {
                          show: false
                        }
                      });
                      /*
                       * END DONUT CHART
                       */
                      /*
                     * Custom Label formatter
                     * ----------------------
                     */
                    function labelFormatter(label, series) {
                      return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                              + label
                              + "<br/>"
                              + Math.round(series.percent) + "%</div>";
                    }
              </script>
          </div>
          </div>
          <!-- ./Map -->
          <!-- Main content -->
          </section>
