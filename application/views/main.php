
      <!-- Right side column. Contains the navbar and content of the page -->
        <!-- Content Header (Page header) -->
        <style>
            -webkit-media (min-width: 768px) {
                .row.equal {
                    display: flex;
                    flex-wrap: wrap;
                }
            }
            .box{
                -webkit-box-shadow: 5px 5px 10px #888888;
            }
            .small-box{
                -webkit-box-shadow: 5px 5px 10px #888888;
            }
        </style>
        <!-- Content map -->
        <style type="text/css">
        	.mapTitle{
        				z-index:1;
            		position:absolute;
            		text-align:center;
            		top:40px;
            		left:315px;
                color:#000000;
            		width:150px;
            		padding:3px;
            		margin:0px;
            		font-size:12px;
            		/*border:#999 1px solid;*/
                border-radius: 5px;
            		background-color:#FFFFFF;
                -webkit-box-shadow: 5px 5px 10px #888888;
        	}
            .mapTitleIcon{
                  z-index:1;
                  position:absolute;
                  text-align:center;
                  top:175px;
                  left:315px;
                  color:#000000;
                  width:150px;
                  padding:3px;
                  margin:0px;
                  font-size:12px;
                  /*border:#999 1px solid;*/
                  border-radius: 5px;
                  background-color:#FFFFFF;
                  -webkit-box-shadow: 5px 5px 10px #888888;
            }
        </style>
        <section class="content-header">
          <h3>
            สรุปภาพรวมข้อมูลเรื่องร้องทุกข์
            <small>ศูนย์ดำรงธรรม จังหวัดชลบุรี 4.0</small>
          </h3>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-12 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h4><?php echo $sum_status_dashboard['sum_all'];?> <sup style="font-size: 18px">(รายการ)</sup></h4>
                  <p><h5>ข้อมูลเรื่องร้องทุกข์ทั้งหมด</h5></p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-paper-outline"></i>
                </div>
                <a href="complaint/dashboard?current_status=all" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h4><?php echo @$sum_status_dashboard['1'];?> <sup style="font-size: 18px">(รายการ)</sup></h4>
                  <p><h5>อยู่ระหว่างตรวจสอบ</h5></p>
                </div>
                <div class="icon">
                  <i class="ion ion-email-unread"></i>
                </div>
                <a href="complaint/dashboard?current_status=1" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4><?php echo @$sum_status_dashboard['2'];?> <sup style="font-size: 18px">(รายการ)</sup></h4>
                  <p><h5>รับเรื่อง</h5></p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-drafts"></i>
                </div>
                <a href="complaint/dashboard?current_status=2" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h4><?php echo @$sum_status_dashboard['3'];?> <sup style="font-size: 18px">(รายการ)</sup></h4>
                  <p><h5>ส่งต่อเรื่อง</h5></p>
                </div>
                <div class="icon">
                  <i class="ion ion-share"></i>
                </div>
                <a href="complaint/dashboard?current_status=3" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4><?php echo @$sum_status_dashboard['4'];?> <sup style="font-size: 18px">(รายการ)</sup></h4>
                  <p><h5>ยุติ/ดำเนินการแล้ว</h5></p>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark-circled"></i>
                </div>
                <a href="complaint/dashboard?current_status=other" class="small-box-footer">เพิ่มเติม <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Map -->
          <div class="row equal">
            <div class="col-lg-6 col-xs-6">
              <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACSdMKi4OrvylAegEJXXR3--RnLUYUBtw"></script>
              <?php
              $link = array('src' => 'assets/js/util.js', 'language' => 'javascript', 'type' => 'text/javascript');
              echo script_tag($link);
              $link = array('src' => 'assets/js/util_control.js', 'language' => 'javascript', 'type' => 'text/javascript');
              echo script_tag($link);
              $link = array('src' => 'assets/js/markerclusterer.js', 'language' => 'javascript','type' => 'text/javascript');
              echo script_tag($link);
              $link = array('src' => 'assets/js/main_map.js', 'language' => 'javascript','type' => 'text/javascript');
              echo script_tag($link);
              ?>
              <script type="text/javascript">
              var map;
              var markerClusterer = null;
              var all_markers = [];
              var all_polygons = [];
              var all_polygonMap = [];
              var xml = [];
                function initialize() {
                  var myLatlng = new google.maps.LatLng(13.0934384,101.4286521);
                  var myOptions = {
                    zoom: 9,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  map = new google.maps.Map(document.getElementById("map"), myOptions);
                  <?php
                  foreach ($area_data as $area) {
                  ?>
                  addlayerXML(document.getElementById('map_<?php echo $area['area_id'];?>'));
                  <?php
                  }
                  ?>
                  <?php
                  foreach ($current_status_data as $status_data) {
                    if($status_data['status_id'] != '5'){
                    ?>
                    addlayerXML(document.getElementById('map_<?php echo $status_data['status_id'];?>'));
                    <?php
                    }
                  }
                  ?>
                }
              /*
              ========== On Load Map ===========
              */
              google.maps.event.addDomListener(window, 'load', initialize);
              </script>
              <div class="box box-primary" >
                <div style="margin:0px;background-color: #2A5D9C;color:#ffffff;font-size:16px;" >
                    <div style="padding-left: 5px;padding-top: 2px;padding-bottom:2px;">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    ข้อมูลเรื่องร้องทุกข์ทั้งหมดจำแนกรายพื้นที่
                    </div>
                </div>
                <div id="map" style="height:420px; width:100%;" ></div>
                <?php
                foreach ($area_data as $area) {
                ?>
                   <input name="map_<?php echo $area['area_id'];?>" type="checkbox" style="display:none" checked="checked" value="main/get_xml_map/<?php echo $area['area_id'];?>" id="map_<?php echo $area['area_id'];?>" >
                <?php
                }
                ?>
                <table cellspacing="2" cellpadding="2" class="mapTitle">
                    <tr>
                        <td  style="background-color:#0493C6;padding:5px; color:#FFF;border-radius: 5px 5px 0px 0px;" align="center" colspan="2"><b>สถานะเรื่องร้องทุกข์</b></td>
                   </tr>
                   <?php
                   foreach ($current_status_data as $status_data) {
                       //แสดงสถานะที่ไม่ใช่ยกเลิก
                       if($status_data['status_id'] != '5'){
                   ?>
                       <tr>
                          <td width="30" align="center">
                          <input name="map_<?php echo $status_data['status_id'];?>" type="checkbox" checked="checked" onClick="addlayerXML(this);" value="main/get_xml_map_status/<?php echo $status_data['status_id'];?>/<?php echo $user_id;?>" id="map_<?php echo $status_data['status_id'];?>" >
                        </td>
                            <td align="left"><?php echo $status_data['status_name'];?></td>
                        </tr>
                   <?php
                        }
                   }
                   ?>
                   <tr>
                       <td   align="center" colspan="2">&nbsp;</td>
                  </tr>
                </table>
                <table cellspacing="2" cellpadding="2" class="mapTitleIcon">
                    <tr>
                        <td  style="background-color:#0493C6;padding:5px; color:#FFF;border-radius: 5px 5px 0px 0px;" align="center" colspan="2"><b>สัญลักษณ์ประเภทเรื่อง</b></td>
                   </tr>
                   <?php
                   foreach ($complain_type_list_icon as $type_list_icon) {
                   ?>
                       <tr>
                          <td width="30" align="center">
                          <img src="<?php echo base_url().'assets/images/'.$type_list_icon['icon_pin'];?>" width="18px"/>
                        </td>
                            <td align="left"><?php echo $type_list_icon['complain_type_name'];?></td>
                        </tr>
                        <tr>
                            <td  align="center" colspan="2" style="border-bottom:1px solid #EEE;"></td>
                       </tr>
                   <?php
                   }
                   ?>
                   <tr>
                       <td   align="center" colspan="2">&nbsp;</td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="col-md-6">
              <!-- DONUT CHART -->
              <div class="box box-primary">
                <div style="margin:0px;background-color: #2A5D9C;color:#ffffff;font-size:16px;" >
                    <div style="padding-left: 5px;padding-top: 2px;padding-bottom:2px;">
                      <i class="fa fa-bar-chart-o"></i>
                      จำนวนผู้ร้องทุกข์แยกตามประเภท
                    </div>
                </div>
                <?php
                $link = array(
                    'src' => 'assets/js/Chart.bundle.js',
                    'type' => 'text/javascript'
                );
                    echo script_tag($link);
                $link = array(
                    'src' => 'assets/js/Chart.analytics.js',
                    'type' => 'text/javascript'
                );
                echo script_tag($link);
                $link = array(
                    'src' => 'assets/js/Chart.utils.js',
                    'type' => 'text/javascript'
                );
                echo script_tag($link);
                ?>
                  <center>
                      <div class="chart">
                          <canvas id="barChart" style="height:420px"></canvas>
                      </div>
                  </center>
              </div><!-- /.box -->
              <script>
                  var randomScalingFactor = function() {
                      return Math.round(Math.random() * 100);
                  };
                  <?php
                  function substr_utf8( $str, $start_p , $len_p){
                      return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s','$1' , $str );
                  }
                  foreach($sum_type as $key => $value ){
                      $arr_complain_type[] = array('complain_type' => $value['complain_type_name']);
                      $arr_complain_type_id[] = array('complain_type_id' => $key);
                      if($value['complain_type_name'] == 'ไม่มีข้อมูล'){
                        $arr_complain_type_shrot[] = $value['complain_type_name'];
                      }else{
                        $arr_complain_type_shrot[] = substr_utf8($value['complain_type_name'],0,9).'...';
                      }
                  }
                  ?>
                  var  arr_complain_type = '<?php echo json_encode($arr_complain_type);?>';
                  var  arr_complain_type_id = '<?php echo json_encode($arr_complain_type_id);?>';
                  var  complain_type = JSON.parse(arr_complain_type);
                  var config = {
                      type: 'bar',
                      data: {
                          datasets: [{
                              data: [
                                  <?php
                                      foreach($sum_type as $key => $value ){
                                        echo $value['sum_complain'].',';
                                      }
                                  ?>
                              ],
                              backgroundColor: [
                                  <?php
                                  foreach($sum_type as $key => $value ){
                                      echo "'".$value['color']."',";
                                  }
                                  ?>
                              ],
                              label: '# ร้อยละ '
                          }],
                          labels: [
                              <?php
                              foreach($arr_complain_type_shrot as $key => $complain_type_name ){
                                  echo "'".$complain_type_name."',";
                              }
                              ?>
                          ]
                      },
                      options: {
                          responsive: true,
                          label:{display: false},
                          legend: {
                              display: false,
                          },
                          title: {
                              display: true,
                              text: ''
                          },
                          animation: {
                              animateScale: true,
                              animateRotate: true
                          },
                          tooltips: {
                            callbacks: {
                                title: function(tooltipItems, data) {
                                    // Pick first xLabel for now
                                    var title = '';
                                    if (tooltipItems.length > 0) {
                                       title = complain_type[tooltipItems[0].index].complain_type;
                                    }
                                    return title;
                                },
                                label: function(tooltipItem, data) {
                                    var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + tooltipItem.yLabel;
                                }
                            }
                          },
                          onClick:function (evt, item) {
                              var json_arr_complain_type_id = JSON.parse(arr_complain_type_id);
                              var index = item[0]._index;
                              var complain_type_id = json_arr_complain_type_id[index].complain_type_id;
                              console.log(json_arr_complain_type_id[index].complain_type_id);
                              linkTo(complain_type_id);
                          }
                      }
                  };
                  window.onload = function() {
                      var ctx = document.getElementById("barChart").getContext("2d");
                      window.myDoughnut = new Chart(ctx,config);
                  };
                  function linkTo(complain_typer_id){
//                      var d = new Date();
//                      var yyyy = parseInt(d.getFullYear())+543;
//                      var date_now = d.getDay()+'/'+d.getMonth()+'/'+yyyy;
                      window.location.href = encodeURI("http://damrongdham.chonburi.go.th/sysdamrongdham/complaint/dashboard?complaint_parent="+complain_typer_id+"&complaint_date_start=<?php echo date('d').'/'.date('m').'/'.(date('Y')+543);?>");
                  }
              </script>
          </div>
          </div>
          <!-- ./Map -->
          <!-- Main content -->
          </section>
