<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
                    <table border="0" style="width: 100%;">
                        <tr>
                            <td style="width: 50%;"></td>
                            <td style="width: 10%;"></td>
                            <td style="width: 40%;"></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo base_url().'assets/images/logo.png';?>" width="25%"/></td>
                            <td></td>
                            <td style="text-align: right;">
                                เลขที่เรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['complain_no'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                วันที่ร้องทุกข์ :
                                <span style="font-weight: normal;">
                                    <?php
                                    $complain_date =($key_in_data['complain_date'] !='' && $key_in_data['complain_date'] !='0000-00-00')?date_thai($key_in_data['complain_date'], true):'';
                                    echo $complain_date;
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                ผู้รับแจ้ง :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['recipient'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                วันที่หนังสือส่งเข้า :
                                <span style="font-weight: normal;">
                                    <?php
                                    $doc_receive_date=($key_in_data['doc_receive_date'] !='' && $key_in_data['doc_receive_date'] !='0000-00-00')?date_thai($key_in_data['doc_receive_date'], true):'ไม่ระบุ';
                                    echo $doc_receive_date;
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                เลขที่หนังสือส่งเข้า :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['doc_receive_no'] != '')?@$key_in_data['doc_receive_no']:'ไม่ระบุ';?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                วันที่หนังสือส่งออก :
                                <span style="font-weight: normal;">
                                    <?php
                                    $doc_send_date=($key_in_data['doc_send_date'] !='' && $key_in_data['doc_send_date'] !='0000-00-00')?date_thai($key_in_data['doc_send_date'], true):'ไม่ระบุ';
                                    echo $doc_send_date;
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                เลขที่หนังสือส่งออก :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['doc_send_no'] != '')?@$key_in_data['doc_send_no']:'ไม่ระบุ';?></span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;">
                                ผู้บันทึก :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'ประชาชน':$create_user_detail['prename_th'].$create_user_detail['first_name']." ".$create_user_detail['last_name']; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center;">
                                เรืองร้องทุกข์/ร้องรียน
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                ประเภทเรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"><?php
                                    foreach(@$get_complain_type as $key => $value){
                                        echo @$complain_type[$value]." ";
                                    }
                                    ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                หัวข้อเรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['complain_name'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                ช่องทางร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['channel'][0]['channel_name'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                ลักษณะลักษณะเรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['subject'][0]['subject_name'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                รายละเอียดเรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['complaint_detail'] !='')?$key_in_data['complaint_detail']:'ไม่ระบุ';?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <br>
                                ผู้ร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'ประชาชน':''?></span>
                            </td>
                        </tr>
                        <?php if((@$key_in_data['user_complain_type_id']!='1')){?>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                เลขบัตรประจำตัวประชาชน :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['id_card'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                ชื่อผู้ร้องทุกข์ :
                                <span style="font-weight: normal;">
                                    <?php
                                    $full_accused_name = @$key_in_data['title_name'][0]['prename'].@$key_in_data['first_name'].'  '.@$key_in_data['last_name'];
                                    echo (@$key_in_data['user_complain_type_id']=='1')?'':$full_accused_name;
                                    ?>
                                </span>
                            </td>
                            <td colspan="2" style="text-align: left;">
                                <!--อายุ :-->
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                ที่อยู่ปัจจุบันที่สามารถติดต่อได้ :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['address']; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                ตำบล/แขวง :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$subdistrict_list[@$user_detail['address_id']]?></span>
                            </td>
                            <td colspan="2" style="text-align: left;">
                                อำเภอ/เขต :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$district_list[@substr($user_detail['address_id'],0,4).'0000']?></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                จังหวัด :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$province_list[@substr($user_detail['address_id'],0,3).'00000']?></span>
                            </td>
                            <td colspan="2" style="text-align: left;">
                                <!--รหัสไปรษณีย์ :-->
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                เบอร์โทรศัพท์ :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['phone']; ?></span>
                            </td>
                            <td colspan="2" style="text-align: left;">
                                เบอร์โทรศัพท์มือถือ :
                                <span style="font-weight: normal;"><?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['phone_number'];?></span>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <!--เบอร์โทรสาร :-->
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr>
                        <!--tr>
                            <td colspan="3" style="text-align: left;">
                                ประเภทเรื่องร้องทุกข์หลัก :
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                ประเภทเรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                สาเหตุเรื่องร้องทุกข์ :
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr-->
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <br>
                                ผู้ถูกร้องทุกข์ :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['accused_name'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                หน่วยงาน
                                <span style="font-weight: normal;">
                                    <?php
                                    foreach(@$get_accused_type as $key => $value){
                                        echo @$accused_type_all[$value]." ";
                                    }

                                    if(@$accused_type_input['input_type'] == 'text') {
                                        echo ' ' . @$key_in_data['accused_type_name'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <!--table style="width: 100%;border-collapse: collapse;">
                                    <tr>
                                        <th style="text-align: center;border: 1px solid black;">กรม</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;">&nbsp;</td>
                                    </tr>
                                </table-->
                            </td>
                        </tr>
                        <!--tr>
                            <td colspan="3" style="text-align: left;">
                                หน่วยงานที่เกี่ยวข้อง :
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr-->
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <br>
                                เนื้อหาสาระ :
                                <span style="font-weight: normal;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                วันเดือนปีที่เกิดเหตุ (ถ้ามี) :
                                <span style="font-weight: normal;">
                                    <?php
                                        $doc_scene_date=($key_in_data['scene_date'] !='' && $key_in_data['scene_date'] !='0000-00-00')?date_thai($key_in_data['scene_date'], true):'ไม่ระบุ';
                                        echo $doc_scene_date;
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                สถานที่เกิดเหตุ :
                                <!--<span style="font-weight: normal;"><?php echo @$key_in_data['place_scene'];?></span>-->
                                <span style="font-weight: normal;">
                                <?php
                                $district_id = substr(@$key_in_data['address_id'], 0, 4).'0000';

                                $subdistrict_id = @$key_in_data['address_id'];
                                ?>
                                    ตำบล <?php echo $district_list[$district_id];?>
                                    อำเภอ <?php echo $subdistrict_list[$subdistrict_id];?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                จังหวัด :
                                <span style="font-weight: normal;">
                                    <?php
                                    $province_id = substr(@$key_in_data['address_id'], 0, 2).'000000';
                                    echo $province_list[$province_id];
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                เหตุการณ์พฤติการณ์ :
                                <span style="font-weight: normal;"><?php echo @$key_in_data['complaint_detail'];?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
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
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
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
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;">
                                <br>
                                สถานดำเนินการเรื่องร้องทุกข์
                            </td>
                        <tr>
                            <td colspan="3" style="text-align: center;">
                                <table style="width: 100%;border-collapse: collapse;">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align: center;border: 1px solid black;">ลำดับ</th>
                                        <th width="20%" style="text-align: center;border: 1px solid black;">สถานภาพการดำเนินการ</th>
                                        <th width="12%" style="text-align: center;border: 1px solid black;">วันที่ดำเนินการ</th>
                                        <th width="25%" style="text-align: center;border: 1px solid black;">รายละเอียด</th>
                                        <!--th width="12%" style="text-align: center;border: 1px solid black;">จำนวนเงินชดเชย</th-->
                                        <th width="18%" style="text-align: center;border: 1px solid black;">ผู้รับผิดชอบ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $runno = 0;
                                    foreach($current_status AS $key => $value) {
                                    //if($key <= @$key_in_data['current_status_id'] ) {
                                    //$runno++;
                                    $event_date = '';
                                    $detail = '';
                                    $update_user = $update_user_detail['prename_th'].$update_user_detail['first_name']." ".$update_user_detail['last_name'];
                                    if($key_in_data['current_status_id'] == '6'){
                                        if ($key == '1') {
                                            $event_date = $key_in_data['complain_date'] != '0000-00-00' ? $key_in_data['complain_date'] : '';
                                            $update_user = "เจ้าหน้าที่ศูนย์ดำรงค์ธรรม";
                                        } else if ($key == '6') {
                                            $event_date = $key_in_data['receive_date'] != '0000-00-00' ? $key_in_data['receive_date'] : '';
                                            if ($member_group == 'member') {
                                                $update_user = "เจ้าหน้าที่ศูนย์ดำรงค์ธรรม";
                                            } else {
                                                $update_user = @$update_user_detail['prename_th'] . @$update_user_detail['first_name'] . " " . @$update_user_detail['last_name'];
                                            }
                                        }
                                    }else {
                                        if ($key == '1') {
                                            $event_date = $key_in_data['complain_date'] != '0000-00-00' ? $key_in_data['complain_date'] : '';
                                            $update_user = "เจ้าหน้าที่ศูนย์ดำรงค์ธรรม";
                                        } else if ($key == '2') {
                                            $event_date = $key_in_data['receive_date'] != '0000-00-00' ? $key_in_data['receive_date'] : '';
                                            if ($member_group == 'member') {
                                                $update_user = "เจ้าหน้าที่ศูนย์ดำรงค์ธรรม";
                                            } else {
                                                $update_user = @$update_user_detail['prename_th'] . @$update_user_detail['first_name'] . " " . @$update_user_detail['last_name'];
                                            }
                                        } else if ($key == '3') {
                                            $event_date = $key_in_data['send_org_date'] != '0000-00-00' ? $key_in_data['send_org_date'] : '';
                                            $update_user = $send_org_text;
                                        } else if ($key == '4') {
                                            $event_date = $result['result']['result_date'] != '0000-00-00' ? $result['result']['result_date'] : '';
                                            $detail = $result['result']['result_detail'];
                                            if ($member_group == 'member') {
                                                $update_user = "เจ้าหน้าที่ศูนย์ดำรงค์ธรรม";
                                            } else {
                                                $update_user = $result_user_detail['prename_th'] . $result_user_detail['first_name'] . " " . $result_user_detail['last_name'];
                                            }
                                        } else if ($key == '5') {
                                            if ($key == $key_in_data['current_status_id']) {
                                                $event_date = $key_in_data['update_datetime'] != '0000-00-00' ? $key_in_data['update_datetime'] : '';
                                                $update_user = @$update_user_detail['prename_th'] . @$update_user_detail['first_name'] . " " . @$update_user_detail['last_name'];
                                            }
                                        }
                                    }
                                    if($event_date != '' && $event_date != '0000-00-00 00:00:00') {
                                    $runno++;
                                    ?>
                                    <tr>
                                        <td style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"><?php echo $runno; ?></td>
                                        <td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"><?php echo $value; ?></td>
                                        <td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"><?php echo $event_date != '' ? date_thai($event_date, true) : ''; ?></td>
                                        <td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"><?php echo $detail; ?></td>
                                        <!--td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;">&nbsp;</td-->
                                        <td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;"><?php echo $update_user; ?></td>
                                    </tr>
                                    </tbody>
                                    <?php
                                    }
                                    //}
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
