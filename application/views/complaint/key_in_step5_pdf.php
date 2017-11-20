<?php $month_arr = array('1'=>'มกราคม','2'=>'กุมภาพันธ์','3'=>'มีนาคม','4'=>'เมษายน','5'=>'พฤษภาคม','6'=>'มิถุนายน','7'=>'กรกฎาคม','8'=>'สิงหาคม','9'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม'); ?>
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
                            <td colspan="2" style="padding-bottom:20px;">ที่ ชบ 0017.1 (ศดธ.)/<?php echo @$key_in_data['complain_no']; ?></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2" style="padding-bottom:10px;">แบบรายงานรับ – ส่งต่อ (Service Link)</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2" style="padding-bottom:10px;">ร้องเรียน/ร้องทุกข์ของศูนย์ดำรงธรรมจังหวัดชลบุรี</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                <?php
                                $complain_date_arr = explode(' ',@$key_in_data['complain_date']);
                                $date_arr = explode('-',@$complain_date_arr[0]);
                                $day = $date_arr[2];
                                $month = $date_arr[1];
                                $year_th = $date_arr[0]+543;
                                ?>
                                1. วันที่ <?php echo sprintf("%01d",$day); ?>
                                เดือน <?php echo $month_arr[sprintf("%01d",$month)]; ?>
                                พ.ศ. <?php echo $year_th; ?>
                                เวลา <?php echo $complain_date_arr[1]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                2. สถานที่เกิดเหตุ
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="padding-bottom:10px;">&nbsp;</td>
                            <td>
                                2.1 <?php echo $ccaa_all[@$key_in_data['address_id']]; ?> <?php echo $ccaa_all[substr(@$key_in_data['address_id'],0,4)."0000"]; ?> <?php echo $ccaa_all[substr(@$key_in_data['address_id'],0,3)."00000"]; ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="padding-bottom:10px;">&nbsp;</td>
                            <td>
                                2.2 บริเวณ <?php echo @$key_in_data['place_scene']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                3. รายละเอียดที่แจ้ง
                            </td>
                        </tr>
                        <tr>
                            <td width="5%" style="padding-bottom:10px;">&nbsp;</td>
                            <td>
                                <?php echo @$key_in_data['complaint_detail']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                4. ได้แจ้งให้หน่วยงานที่รับผิดชอบทราบและดำเนินการแล้วหรือยัง
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center" style="padding-bottom:10px;">
                                (&nbsp;&nbsp;&nbsp;) 4.1 แจ้งแล้ว&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                (&nbsp;&nbsp;&nbsp;) 4.2 ยังไม่ได้แจ้ง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                (&nbsp;&nbsp;&nbsp;) 4.3 ให้คำปรึกษา
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                5. ชื่อ – สกุล ผู้แจ้งเหตุ <?php
                                $full_accused_name = @$key_in_data['title_name'][0]['prename'].@$key_in_data['first_name'].'  '.@$key_in_data['last_name'];
                                echo (@$key_in_data['user_complain_type_id']=='1')?'':$full_accused_name." ".$user_detail['address_id'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                ที่อยู่ <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['address']; ?>
                                <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$ccaa_all[@$user_detail['address_id']]; ?>
                                <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$ccaa_all[@substr($user_detail['address_id'],0,4).'0000']; ?>
                                <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$ccaa_all[@substr($user_detail['address_id'],0,3).'00000']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                โทรศัพท์ <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['phone']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                โทรศัพท์เคลื่อนที่ <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['phone_number']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                E – mail <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                เรียน   นายอำเภอ<?php echo str_replace('อำเภอ','',$ccaa_all[substr(@$key_in_data['address_id'],0,4)."0000"]); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-bottom:10px;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- เพื่อโปรดรับทราบและพิจารณาแก้ไขปัญหาความเดือดร้อนที่ร้องเรียน/ร้องทุกข์ดังกล่าวข้างต้น                ผลเป็นประการใดกรุณารายงานผู้ว่าราชการจังหวัดชลบุรี ภายใน 15 วันนับแต่วันที่ได้รับแจ้ง ด้วยจักขอบคุณยิ่ง
                            </td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td width="33%"></td>
                            <td width="33%"></td>
                            <td width="33%" align="center" style="padding-bottom:10px;">(<?php for($i=0;$i<=40;$i++) echo "&nbsp;"; ?>)</td>
                        </tr>
                        <tr>
                            <td width="33%"></td>
                            <td width="33%"></td>
                            <td width="33%" align="center" style="padding-bottom:10px;">หัวหน้าสำนักงานจังหวัดชลบุรี</td>
                        </tr>
                        <tr>
                            <td width="33%"></td>
                            <td width="33%"></td>
                            <td width="33%" align="center">วันที่.........เดือน.................พ.ศ.………</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
