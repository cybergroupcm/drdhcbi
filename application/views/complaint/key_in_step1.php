<?php
$link = array(
    'href' => '/assets/css/key_in.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
echo form_open_multipart('',array('id' => 'keyInForm'));
    if(@$_GET['debug']=='on'){
        echo"<pre>";print_r(@$key_in_data);echo"</pre>";
        echo"<pre>";print_r(@$district_list);echo"</pre>";
    }
  if(@$_GET['debug']=='token_info'){
    if($members_keyin){
      echo "members_keyin";
    }else{
      echo "No members_keyin";
    }
  }

$dateNow = date('d/m/Y H:i:s',strtotime('+543 years'));
?>
<input type="hidden" id="action" value="<?php echo (@$id!='')?'edit':'add'; ?>">
<input type="hidden" id="keyin_id" name="keyin_id" value="<?php echo (@$id!='')?$id:''; ?>">
<?php
if(@$key_in_data['step']!='' && $key_in_data['step']>'1'){
    $step = @$key_in_data['step'];
}else{
    $step = '1';
}
?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <input type="hidden" id="step_now" name="step_now" value="1">
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">บันทึกเรื่องร้องทุกข์/ร้องเรียน</div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            วันที่ร้องทุกข์/Date of complaint :
                        </label>
                        <label class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php
                                    if(@$key_in_data['complain_date']!=''&&@$key_in_data['complain_date']!='0000-00-00 00:00:00') {
                                        $arrComplainDate = explode(' ',$key_in_data['complain_date']);
                                        $complainDate = explode('-',$arrComplainDate[0]);
                                        $complainTime = $arrComplainDate[1];
                                        $complainDateTime = $complainDate[2].'/'.$complainDate[1].'/'.($complainDate[0]+543).' '.$complainTime;
                                    }else{
                                        $complainDateTime = $dateNow;
                                    }
                                ?>
                                <input type="text" name="complain_date" id="complain_date"
                                       class="form-control pull-right datetimepicker" value="<?php echo $complainDateTime; ?>">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            ผู้รับแจ้ง/Complaint recipient :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="recipient" id="recipient" class="form-control" value="<?php echo @$key_in_data['recipient']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            วันที่หนังสือส่งเข้า/Date of import book :
                        </label>
                        <label class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php
                                if(@$key_in_data['doc_receive_date']!=''&&@$key_in_data['doc_receive_date']!='0000-00-00 00:00:00') {
                                    $arrDocReceiveDate = explode(' ',$key_in_data['doc_receive_date']);
                                    $docReceiveDate = explode('-',$arrDocReceiveDate[0]);
                                    $docReceiveTime = $arrDocReceiveDate[1];
                                    $docReceiveDateTime = $docReceiveDate[2].'/'.$docReceiveDate[1].'/'.($docReceiveDate[0]+543).' '.$docReceiveTime;
                                }else{
                                    $docReceiveDateTime = $dateNow;
                                }
                                ?>
                                <input type="text" name="doc_receive_date" id="doc_receive_date"
                                       class="form-control pull-right datetimepicker" value="<?php echo $docReceiveDateTime ?>">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            เลขที่หนังสือส่งเข้า/Number of import book :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="doc_receive_no" id="doc_receive_no" class="form-control" value="<?php echo @$key_in_data['doc_receive_no']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            วันที่หนังสือส่งออก/Date of export book :
                        </label>
                        <label class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php
                                if(@$key_in_data['doc_send_date']!=''&&@$key_in_data['doc_send_date']!='0000-00-00 00:00:00') {
                                    $arrDocSendDate = explode(' ',$key_in_data['doc_send_date']);
                                    $docSendDate = explode('-',$arrDocSendDate[0]);
                                    $docSendTime = $arrDocSendDate[1];
                                    $docSendDateTime = $docSendDate[2].'/'.$docSendDate[1].'/'.($docSendDate[0]+543).' '.$docSendTime;
                                }else{
                                    $docSendDateTime = $dateNow;
                                }
                                ?>
                                <input type="text" name="doc_send_date" id="doc_send_date"
                                       class="form-control pull-right datetimepicker" value="<?php echo $docSendDateTime; ?>">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            เลขที่หนังสือส่งออก/Number of export book :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="doc_send_no" id="doc_send_no" class="form-control" value="<?php echo @$key_in_data['doc_send_no']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            หน่วยงานที่มาของเรื่อง/Complaint department :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="origin_of_subject" id="origin_of_subject" class="form-control" value="<?php echo @$key_in_data['origin_of_subject']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row chack_keyin_member">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            ผู้บันทึก/Recorder :
                        </label>
                        <label class="col-sm-6">
                            เจ้าหน้าที่รับผิดชอบเรื่องร้องเรียนจังหวัด ชลบุรี
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            ผู้ร้องทุกข์/Complainant :
                        </label>
                        <label class="col-sm-6">
                            <div>
                                <input type="radio" id="user_complain_1" onclick="changeUserComplain()"
                                       name="user_complain_type_id" <?php echo @$key_in_data['user_complain_type_id']=='1'?'checked':''; ?> value="1">
                                <label for="complainter1">&nbsp;ไม่ประสงค์ออกนาม</label>
                            </div>
                            <div>
                                <input type="radio" id="user_complain_2" onclick="changeUserComplain()"
                                       name="user_complain_type_id" <?php echo @$key_in_data['user_complain_type_id']=='2'?'checked':''; ?> value="2">
                                <label for="complainter2">&nbsp;บันทึก/เลือกผู้ร้องทุกข์</label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="user_complain_detail" style="display: none;">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            รหัสประจำตัวประชาชน/Citizen ID :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="id_card" id="id_card" maxlength='13' value="<?php echo @$key_in_data['id_card']; ?>" class="form-control numbers">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            คำนำหน้าชื่อ/Prename :
                        </label>
                        <label class="col-sm-6">
                            <?php
                            $dd4 = $title_name;
                            $dd4[''] = 'กรุณาเลือก';
                            ksort($dd4);
                            echo form_dropdown([
                                'name' => 'pn_id',
                                'id' => 'pn_id',
                                'class' => 'form-control'
                            ], $dd4, @$key_in_data['pn_id']);
                            ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            ชื่อ/First name :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="first_name" id="first_name" class='form-control' value="<?php echo @$key_in_data['first_name']; ?>">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            นามสกุล/Last name :
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="last_name" id="last_name" class='form-control' value="<?php echo @$key_in_data['last_name']; ?>">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right required">
                            โทรศัพท์เคลื่อนที่/Mobile number : <br>(ที่สามารถติดต่อได้)
                        </label>
                        <label class="col-sm-6">
                            <input type="text" name="phone_number" id="phone_number" class='form-control'
                                   value="<?php echo @$key_in_data['phone_number']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo form_close();
        ?>
        <div class="row footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-5">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="หน้าถัดไป" onclick="validateForm('key_in_step2','')">
                    </label>
                </div>
            </div>
        </div>
    </div>
<div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
if($members_keyin == true){
  $link = array(
      'href' => '/assets/css/key_in_member.css',
      'type' => 'text/css',
      'rel' => 'stylesheet'
  );
  echo link_tag($link);
}else{
  $link = array(
      'href' => '/assets/css/key_in_no_member.css',
      'type' => 'text/css',
      'rel' => 'stylesheet'
  );
  echo link_tag($link);
}
?>
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'href' => 'template/plugins/datepicker/bootstrap-datetimepicker.min.css',
    'rel' => 'stylesheet',
    'type' => 'text/css'
);
echo link_tag($link);
$link = array(
    'src' => 'template/plugins/datepicker/moment-with-locales.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'template/plugins/datepicker/bootstrap-datetimepicker.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/key_in.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
