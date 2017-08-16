<?php
$link = array(
    'href' => '/assets/css/key_in.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
echo form_open_multipart('',array('id' => 'keyInForm'));
$month_arr = array('1'=>'มกราคม','2'=>'กุมภาพันธ์','3'=>'มีนาคม','4'=>'เมษายน','5'=>'พฤษภาคม','6'=>'มิถุนายน','7'=>'กรกฎาคม','8'=>'สิงหาคม','9'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
if(@$_GET['debug']=='on'){
    //echo"<pre>";print_r(@$key_in_data);echo"</pre>";
    echo"<pre>";print_r(@$user_detail);echo"</pre>";
}
?>
    <input type="hidden" id="action" value="<?php echo (@$id!='')?'edit':'add'; ?>">
    <input type="hidden" id="keyin_id" name="keyin_id" value="<?php echo (@$id!='')?$id:''; ?>">
    <?php
        if(@$key_in_data['step']!='' && $key_in_data['step']>'4'){
            $step = @$key_in_data['step'];
        }else{
            $step = '4';
        }
    ?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <input type="hidden" id="step_now" name="step_now" value="5">
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="col-xs-12 text-right">
            <a onclick="validateForm('key_in_step5_pdf','')"><i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 3em;" title="สั่งพิมพ์"></i></a>
            <br>
            <br>
        </div>
        <div class="row">
            <div class="col-md-12 title">
                <div class="form-group" style="text-align: center;">
                    แบบรายงานรับ – ส่งต่อ (Service Link)
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 title">
                <div class="form-group" style="text-align: center;">
                    ร้องเรียน/ร้องทุกข์ของศูนย์ดำรงธรรมจังหวัดชลบุรี
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    $complain_date_arr = explode(' ',@$key_in_data['complain_date']);
                    $date_arr = explode('-',@$complain_date_arr[0]);
                    $day = $date_arr[2];
                    $month = $date_arr[1];
                    $year_th = $date_arr[0]+543;
                    ?>
                    1. วันที่ <?php echo sprintf("%01d",$day); ?> เดือน <?php echo $month_arr[sprintf("%01d",$month)]; ?> พ.ศ. <?php echo $year_th; ?> เวลา <?php echo $complain_date_arr[1]; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    2. สถานที่เกิดเหตุ
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <div class="form-group">
                    2.1 <?php echo $subdistrict_list[@$key_in_data['address_id']]; ?> <?php echo $district_list[substr(@$key_in_data['address_id'],0,4)."0000"]; ?> <?php echo $province_list[substr(@$key_in_data['address_id'],0,3)."00000"]; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <div class="form-group">
                    2.2 บริเวณ <?php echo @$key_in_data['place_scene']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    3. รายละเอียดที่แจ้ง
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea class="form-control" name="conclude_complaint" cols="70" rows="6"><?php echo @$key_in_data['conclude_complaint']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    4. ได้แจ้งให้หน่วยงานที่รับผิดชอบทราบและดำเนินการแล้วหรือยัง
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <div class="form-group">
                    (    ) 4.1 แจ้งแล้ว		(    ) 4.2 ยังไม่ได้แจ้ง		(    ) 4.3 ให้คำปรึกษา
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    5. ชื่อ – สกุล ผู้แจ้งเหตุ <?php
                    $full_accused_name = @$key_in_data['title_name'][0]['prename'].@$key_in_data['first_name'].'  '.@$key_in_data['last_name'];
                    echo (@$key_in_data['user_complain_type_id']=='1')?'':$full_accused_name." ".$user_detail['address_id'];
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    ที่อยู่ <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['address']; ?>
                    <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$ccaa_all[@$user_detail['address_id']]; ?>
                    <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$ccaa_all[@substr($user_detail['address_id'],0,4).'0000']; ?>
                    <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':$province_list[@substr($user_detail['address_id'],0,3).'00000']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    โทรศัพท์ <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['phone']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    โทรศัพท์เคลื่อนที่ <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$key_in_data['phone_number']; ?> E – mail <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['email']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    E – mail <?php echo (@$key_in_data['user_complain_type_id']=='1')?'':@$user_detail['email']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    เรียน   นายอำเภอสัตหีบ
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    -	เพื่อโปรดรับทราบและพิจารณาแก้ไขปัญหาความเดือดร้อนที่ร้องเรียน/ร้องทุกข์ดังกล่าวข้างต้น                ผลเป็นประการใดกรุณารายงานผู้ว่าราชการจังหวัดชลบุรี ภายใน 15 วันนับแต่วันที่ได้รับแจ้ง ด้วยจักขอบคุณยิ่ง
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="row footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-5">
                        <input type="button" class="btn btn-bitbucket" value="หน้าก่อนหน้า" onclick="validateForm('key_in_step4','back')">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="กลับหน้าหลัก" onclick="validateForm('dashboard','')">
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/key_in.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>