  <?php
  $link = array(
      'src' => 'assets/js/complaint_view_detail.js',
      'type' => 'text/javascript'
  );
  echo script_tag($link);
  $this->load->view('complaint/received');
  $this->load->view('complaint/send');
  $this->load->view('complaint/save_result');
  $this->load->view('complaint/show_send');
  $this->load->view('complaint/show_result');
  ?>
  <style>
      .edit.dropdown-menu {
          min-width: 80px !important;
          left: 50%;
          right: auto;
          text-align: center;
          transform: translate(-50%, 0);
          background-color: rgba(255, 255, 255, 0.9);
      }

      .a, .edit.dropdown-menu {
          width: 30px;
          margin-top: -5px;
          font-size: 1em;
          cursor: pointer;
      }

      td.open {
          cursor: pointer;
      }
  </style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">
                            <div class="col-xs-12 text-left">
                                <?php
                                $type_user = '';
                                echo '<i class="fa fa-reply" style="cursor: pointer;font-size: 2em;color:#3c8dbc;" onclick="bt_back(\''.@$type_user.'\');" title="กลับหน้าหลัก"></i>';
                                ?>
                            </div>
                        </h4>
                    </div>
                    <div class="box-body">
                        <?php $this->load->view('complaint/step_of_view_detail'); ?>
                        <div class="col-xs-6 text-left">
                            <?php
                            if (@$key_in_data['current_status_id'] == '1') {
                                echo '<i class="fa fa-inbox" style="cursor: pointer;font-size: 3em;color:#3c8dbc;padding-right: 4px;" onclick="Accept(\'' . @$key_in_data['keyin_id'] . '\',\'2\');" title="รับเรื่อง"></i>';
                                echo '<i class="fa fa-close" style="cursor: pointer;font-size: 3em;color:#3c8dbc;" onclick="Accept(\'' . @$key_in_data['keyin_id'] . '\',\'6\');" title="ไม่รับเรื่อง"></i>';
                            }elseif (@$key_in_data['current_status_id'] == '2') {
                                ?>
                                <i class="fa fa-send open-send" style="cursor: pointer;font-size: 38px;color:#3c8dbc;padding-right: 4px;" data-toggle="modal" data-target="#send" data-id="<?php echo @$key_in_data['keyin_id']; ?>" title="ส่งต่อ"></i>
                                <?php
                            }elseif (in_array(@$key_in_data['current_status_id'],['3','4'])) {
                                echo '<i class="fa fa-gavel open-result" aria-hidden="true" style="cursor: pointer;font-size: 3em;color:#3c8dbc;padding-right: 4px;' . $displayFinish . '" data-toggle="modal" data-target="#save_result" data-id="' . @$key_in_data['keyin_id'] . '" title="บันทึกผล"></i>';
                            }else {
                                echo '';
                            }
                            ?>
<!--                            --><?php
//                            echo '<i class="fa fa-inbox" style="cursor: pointer;font-size: 3em;color:#3c8dbc;" onclick="Accept(\'' . @$key_in_data['keyin_id'] . '\',\'2\');" title="รับเรื่อง"></i>';
//                            echo '<i class="fa fa-close" style="cursor: pointer;font-size: 3em;color:#3c8dbc;" onclick="Accept(\'' . @$key_in_data['keyin_id'] . '\',\'6\');" title="ไม่รับเรื่อง"></i>';
//                            ?>
<!--                            <i class="fa fa-send open-send" style="cursor: pointer;font-size: 3em;color:#3c8dbc;" data-toggle="modal" data-target="#send" data-id="--><?php //echo @$key_in_data['keyin_id']; ?><!--" title="ส่งต่อ"></i>-->
<!--                            --><?php
//                            echo '<i class="fa fa-gavel open-result" aria-hidden="true" style="cursor: pointer;font-size: 3em;color:#3c8dbc;' . $displayFinish . '" data-toggle="modal" data-target="#save_result" data-id="' . @$key_in_data['keyin_id'] . '" title="บันทึกผล"></i>';
//                            ?>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>
                                      <?php
//                                      if (@$key_in_data['current_status_id'] == '1') {
//                                          ?>
<!---->
<!--                                        --><?php
//                                        echo '<i class="fa fa-inbox" style="cursor: pointer;font-size: 3em;color:#3c8dbc;padding-right: 4px;" onclick="Accept(\'' . @$key_in_data['keyin_id'] . '\',\'2\');" title="รับเรื่อง"></i>';
//                                        echo '<i class="fa fa-close" style="cursor: pointer;font-size: 3em;color:#3c8dbc;" onclick="Accept(\'' . @$key_in_data['keyin_id'] . '\',\'6\');" title="ไม่รับเรื่อง"></i>';
//                                        ?>
<!--                                          </span>-->
<!--                                          --><?php
//                                          //echo '<i class="fa fa-inbox open-received" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;' . $displayReceive . '" data-toggle="modal" data-target="#received" data-id="' . @$val['keyin_id'] . '"></i>';
//                                      }elseif (@$key_in_data['current_status_id'] == '2') {
//                                          ?>
<!--                                            <i class="fa fa-send open-send" style="cursor: pointer;font-size: 38px;color:#3c8dbc;padding-right: 4px;" data-toggle="modal" data-target="#send" data-id="--><?php //echo @$key_in_data['keyin_id']; ?><!--" title="ส่งต่อ"></i>-->
<!--                                          --><?php
////                                          echo '<i class="fa  fa-send open-send" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;' . $displaySend . '" data-toggle="modal" data-target="#send" data-id="' . @$val['keyin_id'] . '"></i>';
//                                      }elseif (in_array(@$key_in_data['current_status_id'],['3','4'])) {
//                                          echo '<i class="fa fa-gavel open-result" aria-hidden="true" style="cursor: pointer;font-size: 3em;color:#3c8dbc;padding-right: 4px;' . $displayFinish . '" data-toggle="modal" data-target="#save_result" data-id="' . @$key_in_data['keyin_id'] . '" title="บันทึกผล"></i>';
//                                      }else {
//                                          echo '';
//                                      }
                                      ?>
                                            </span>
                           <a href="<?php echo base_url('complaint/pdf_detail/' . @$key_in_data['keyin_id'])?>" target="_blank"><i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 3em;" title="สั่งพิมพ์"></i>
                                <?php //echo img(array('src' => 'assets/images/print.png', 'title' => 'สั่งพิมพ์', 'width' => '48px', 'style' => 'cursor:pointer')); ?>
                            </a>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        เลขที่เรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['complain_no'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        วันที่ร้องทุกข์ :

                                        <span style="font-weight: normal;">
                                            <?php
                                                $complain_date =($key_in_data['complain_date'] !='' && $key_in_data['complain_date'] !='0000-00-00')?date_thai($key_in_data['complain_date'], true):'';
                                                echo $complain_date;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        ผู้รับแจ้ง :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['recipient'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        วันที่หนังสือส่งเข้า :
                                        <span style="font-weight: normal;">
                                            <?php
                                                $doc_receive_date=($key_in_data['doc_receive_date'] !='' && $key_in_data['doc_receive_date'] !='0000-00-00')?date_thai($key_in_data['doc_receive_date'], true):'ไม่ระบุ';
                                                echo $doc_receive_date;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        เลขที่หนังสือส่งเข้า :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['doc_receive_no'] != '')?@$key_in_data['doc_receive_no']:'ไม่ระบุ';?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        วันที่หนังสือส่งออก :
                                        <span style="font-weight: normal;">
                                            <?php
                                            $doc_send_date=($key_in_data['doc_send_date'] !='' && $key_in_data['doc_send_date'] !='0000-00-00')?date_thai($key_in_data['doc_send_date'], true):'ไม่ระบุ';
                                            echo $doc_send_date;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        เลขที่หนังสือส่งออก :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['doc_send_no'] != '')?@$key_in_data['doc_send_no']:'ไม่ระบุ';?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        ผู้บันทึก :
                                        <span style="font-weight: normal;"><?php echo $create_user_detail['prename_th'].$create_user_detail['first_name']." ".$create_user_detail['last_name']; ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12 text-center">
                                        เรืองร้องทุกข์/ร้องรียน
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ประเภทเรื่องร้องทุกข์ : <span style="font-weight: normal;"><?php
                                            foreach(@$get_complain_type as $key => $value){
                                                echo @$complain_type[$value]." ";
                                            }
                                            ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หัวข้อเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['complain_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ช่องทางร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['channel'][0]['channel_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ลักษณะลักษณะเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['subject'][0]['subject_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        รายละเอียดเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['complaint_detail'] !='')?$key_in_data['complaint_detail']:'ไม่ระบุ';?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
<!-- //////////////////////////////////////////////////////////////////////////////////-->
                    <?php if($create_user_detail_authen['currentGroups'][0]['name'] == 'members' && ($current_user_login_data['currentGroups'][0]['name'] == 'admin' || $current_user_login_data['currentGroups'][0]['name'] == 'officer')){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        ผู้ร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'ไม่ประสงค์ออกนาม':''?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เลขบัตรประจำตัวประชาชน :
                                        <span style="font-weight: normal;"><?php echo @$create_user_detail_authen['user']['idcard']; ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ชื่อผู้ร้องทุกข์ :
                                        <span style="font-weight: normal;">
                                            <?php echo @$create_user_detail_authen['user']['prename_th'].@$create_user_detail_authen['user']['first_name']." ".@$create_user_detail_authen['user']['last_name']; ?>
                                        </span>
                                    </label>
                                    <!--label class="col-sm-8">
                                        อายุ :
                                        <span style="font-weight: normal;"></span>
                                    </label-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ที่อยู่ปัจจุบันที่สามารถติดต่อได้ :
                                        <span style="font-weight: normal;"><?php echo $create_user_detail['address']; ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ตำบล/แขวง :
                                        <span style="font-weight: normal;"><?php echo $subdistrict_list[@$create_user_detail['address_id']]; ?></span>
                                    </label>
                                    <label class="col-sm-8">
                                        อำเภอ/เขต :
                                        <span style="font-weight: normal;"><?php echo $district_list[@substr($create_user_detail['address_id'],0,4).'0000']?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        จังหวัด :
                                        <span style="font-weight: normal;"><?php echo $province_list[@substr($create_user_detail['address_id'],0,3).'00000']?></span>
                                    </label>
                                    <!--label class="col-sm-8">
                                        รหัสไปรษณีย์ :
                                        <span style="font-weight: normal;"></span>
                                    </label-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        เบอร์โทรศัพท์ :
                                        <span style="font-weight: normal;"><?php echo @$create_user_detail['phone']; ?></span>
                                    </label>
                                    <label class="col-sm-8">
                                        เบอร์โทรศัพท์มือถือ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['phone_number'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        ผู้ร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'ไม่ประสงค์ออกนาม':''?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เลขบัตรประจำตัวประชาชน :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['id_card'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ชื่อผู้ร้องทุกข์ :
                                        <span style="font-weight: normal;">
                                            <?php
                                            $full_accused_name = @$key_in_data['title_name'][0]['prename'].@$key_in_data['first_name'].'  '.@$key_in_data['last_name'];
                                            echo (@$key_in_data['user_complain_type_id']=='1')?'':$full_accused_name;
                                            ?>
                                        </span>
                                    </label>
                                    <!--label class="col-sm-8">
                                        อายุ :
                                        <span style="font-weight: normal;"></span>
                                    </label-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ที่อยู่ปัจจุบันที่สามารถติดต่อได้ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['address']; ?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ตำบล/แขวง :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$subdistrict_list[@$user_detail['address_id']]?></span>
                                    </label>
                                    <label class="col-sm-8">
                                        อำเภอ/เขต :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$district_list[@substr($user_detail['address_id'],0,4).'0000']?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        จังหวัด :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$province_list[@substr($user_detail['address_id'],0,3).'00000']?></span>
                                    </label>
                                    <!--label class="col-sm-8">
                                        รหัสไปรษณีย์ :
                                        <span style="font-weight: normal;"></span>
                                    </label-->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        เบอร์โทรศัพท์ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['phone']; ?></span>
                                    </label>
                                    <label class="col-sm-8">
                                        เบอร์โทรศัพท์มือถือ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['phone_number'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
 <!-- //////////////////////////////////////////////////////////////////////////////////-->
                        <!--div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เบอร์โทรสาร :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div-->
                        <!--div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ประเภทเรื่องร้องทุกข์หลัก :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ประเภทเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div-->
                        <!--div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        สาเหตุเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        ผู้ถูกร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['accused_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หน่วยงาน
                                        <span style="font-weight: normal;">
                                            <?php
                                            foreach(@$get_accused_type as $key => $value){
                                                echo @$accused_type_all[$value]." ";
                                            }
                                            ?>
                                        </span>
                                    </label>
                                </div>
                                <!--table id="example1" class="table table-bordered table-striped dataTable">
                                    <tr>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table-->
                            </div>
                        </div>
                        <!--div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หน่วยงานที่เกี่ยวข้อง :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        เนื้อหาสาระ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        วันเดือนปีที่เกิดเหตุ (ถ้ามี) :
                                        <span style="font-weight: normal;">
                                        <?php
                                            $doc_scene_date=($key_in_data['scene_date'] !='' && $key_in_data['scene_date'] !='0000-00-00')?date_thai($key_in_data['scene_date'], true):'ไม่ระบุ';
                                            echo $doc_scene_date;
                                        ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        สถานที่เกิดเหตุ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['place_scene'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        จังหวัด :
                                        <span style="font-weight: normal;">
                                            <?php
                                                $province_id = substr(@$key_in_data['address_id'], 0, 2).'000000';
                                                echo $province_list[$province_id];
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <!-- Map -->
                                    <!-- Content map -->
                                    <style type="text/css">
                                      .mapTitle{
                                            z-index:1;
                                            position:absolute;
                                            text-align:center;
                                            top:40px;
                                            right:50px;
                                            color:#000000;
                                            width:250px;
                                            padding:3px;
                                            margin:0px;
                                            font-size:12px;
                                            /*border:#999 1px solid;*/
                                            border-radius: 5px;
                                            background-color:#FFFFFF;
                                            -webkit-box-shadow: 5px 5px 10px #888888;
                                      }

                                    </style>
                                    <div class="row equal">
                                      <div class="col-lg-12 col-xs-12 ">
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

                                            var latlng = new google.maps.LatLng(<?php echo (isset($key_in_data['latitude']))?$key_in_data['latitude']:'0';?>,<?php echo (isset($key_in_data['longitude']))?$key_in_data['longitude']:'0';?>);
                                            var icon = '<?php echo base_url().'assets/images/'.$icon?>';
                                          console.log(latlng);
                                            var marker = new google.maps.Marker({position: latlng, icon:icon, title:'<?php echo (isset($key_in_data['complain_no']))?$key_in_data['complain_no']:'-';?>', map: map});
                                            google.maps.event.addListener(marker, "click", function() {
                                              if (infowindow) infowindow.close();
                                              infowindow = new google.maps.InfoWindow({content: ''});
                                              infowindow.open(map, marker);
                                            });
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
                                              แผนที่สถานที่เกิดเหตุ ( พิกัด: <?php echo (isset($key_in_data['latitude']))?$key_in_data['latitude'].','.$key_in_data['longitude']:'-';?> )
                                              </div>
                                          </div>
                                          <div id="map" style="height:420px; width:100%;" ></div>
                                          <?php
                                          foreach ($area_data as $area) {
                                          ?>
                                             <input name="map_<?php echo $area['area_id'];?>" type="checkbox" style="display:none" checked="checked" value="<?php echo base_url();?>main/get_xml_map/<?php echo $area['area_id'];?>" id="map_<?php echo $area['area_id'];?>" >
                                          <?php
                                          }
                                          ?>
                                          <table cellspacing="2" cellpadding="2" class="mapTitle">
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
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เหตุการณ์พฤติการณ์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['complaint_detail'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ควมประสงค์ในการดำเนินการ :
                                        <span style="font-weight: normal;">
                                        <br>
                                            <?php
                                            if($key_in_data['wish']) {
                                                foreach ($key_in_data['wish'] AS $key => $val) {
                                                    echo @$val['wish_name'] . '<br>';
                                                }
                                            }
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หลักฐานประกอบเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;">
                                         <br>
                                            <?php
                                            if($key_in_data['attach_file']) {
                                                foreach ($key_in_data['attach_file'] AS $key => $val) {
                                                    $runfile = $key + 1;
                                                    echo $runfile . '. ' . '<a href="' . base_url(@$val['file_system_name']) . '" target="_blank">' . $val['file_name'] . '</a><br>';
                                                }
                                            }
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        สถานะดำเนินการเรื่องร้องทุกข์
                                    </label>
                                </div>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped dataTable">
                            <tr>
                                <th width="5%" class="text-center">ลำดับ</th>
                                <th width="20%" class="text-center">สถานภาพการดำเนินการ</th>
                                <th width="12%" class="text-center">วันที่ดำเนินการ</th>
                                <th width="25%" class="text-center">รายละเอียด</th>
                                <!--th width="12%" class="text-center">จำนวนเงินชดเชย</th-->
                                <th width="18%" class="text-center">ผู้รับผิดชอบ</th>
                                <th width="12%" class="text-center">เพิ่มเติม</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $runno = 0;
                            foreach($current_status AS $key => $value) {
                                if($key <= @$key_in_data['current_status_id'] ) {
                                    $runno++;
                                    $event_date = '';
                                    $detail = '';
                                    $update_user = @$update_user_detail['prename_th'].@$update_user_detail['first_name']." ".@$update_user_detail['last_name'];
                                    if($key == '1'){
                                        $event_date = $key_in_data['complain_date']!='0000-00-00'?$key_in_data['complain_date']:'';
                                    }else if($key == '2'){
                                        $event_date = $key_in_data['receive_date']!='0000-00-00'?$key_in_data['receive_date']:'';
                                    }else if($key == '3'){
                                        $event_date = $key_in_data['send_org_date']!='0000-00-00'?$key_in_data['send_org_date']:'';
                                        $update_user = $send_org_text;
                                    }else if($key == '4'){
                                        $event_date = $result['result']['result_date']!='0000-00-00'?$result['result']['result_date']:'';
                                        $detail = $result['result']['result_detail'];
                                        $update_user = $result_user_detail['prename_th'].$result_user_detail['first_name']." ".$result_user_detail['last_name'];
                                    }

                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $runno; ?></td>
                                        <td><?php echo $value; ?></td>
                                        <td class="text-center"><?php echo $event_date!=''?date_thai($event_date,true):''; ?></td>
                                        <td><?php echo $detail; ?></td>
                                        <!--td class="text-right">&nbsp;</td-->
                                        <td><?php echo $update_user; ?></td>
                                        <td align="center">
                                            <?php if($key=='3' || $key == '4'){
                                                if($key=='3'){
                                                    $modal_name = 'show_send';
                                                    $class="open_show_send";
                                                }else{
                                                    $modal_name = 'show_result';
                                                    $class="open_show_result";
                                                }
                                                ?>
                                                <a class="<?php echo $class; ?>" data-toggle="modal" data-target="#<?php echo $modal_name; ?>" data-id="<?php echo @$key_in_data['keyin_id']; ?>" style="cursor:pointer;">รายละเอียดเพิ่มเติม</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div id="base_url" class="<?php echo base_url();?>"></div>
<div id="return_to" class="view_detail/<?php echo @$key_in_data['keyin_id']; ?>"></div>