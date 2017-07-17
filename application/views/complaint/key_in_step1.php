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
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">บันทึกเรื่องร้องทุกข์/ร้องเรียน</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            วันที่ร้องทุกข์ :
                        </label>
                        <label class="col-sm-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input readonly type="text" name="complain_date" id="complain_date"
                                       class="form-control pull-right datepicker" value="<?php echo @$key_in_data['complain_date']!=''?date('d/m/Y',  strtotime(@$key_in_data['complain_date'])):''; ?>">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            ผู้รับแจ้ง :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="recipient" id="recipient" class="form-control" value="<?php echo @$key_in_data['recipient']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            วันที่หนังสือส่งเข้า :
                        </label>
                        <label class="col-sm-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input readonly type="text" name="doc_receive_date" id="doc_receive_date"
                                       class="form-control pull-right datepicker" value="<?php echo @$key_in_data['doc_receive_date']!='0000-00-00' && @$key_in_data['doc_receive_date']!= ''?date('d/m/Y',  strtotime(@$key_in_data['doc_receive_date'])):''; ?>">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            เลขที่หนังสือส่งเข้า :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="doc_receive_no" id="doc_receive_no" class="form-control" value="<?php echo @$key_in_data['doc_receive_no']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            วันที่หนังสือส่งออก :
                        </label>
                        <label class="col-sm-7">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input readonly type="text" name="doc_send_date" id="doc_send_date"
                                       class="form-control pull-right datepicker" value="<?php echo @$key_in_data['doc_send_date']!='0000-00-00' && @$key_in_data['doc_send_date']!= ''?date('d/m/Y',  strtotime(@$key_in_data['doc_send_date'])):''; ?>">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            เลขที่หนังสือส่งออก :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="doc_send_no" id="doc_send_no" class="form-control" value="<?php echo @$key_in_data['doc_send_no']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ผู้บันทึก :
                        </label>
                        <label class="col-sm-7">
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
                        <label class="col-sm-5 right">
                            ผู้ร้องทุกข์ :
                        </label>
                        <label class="col-sm-7">
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
                        <label class="col-sm-5 right required">
                            รหัสประจำตัวประชาชน :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="id_card" id="id_card" maxlength='13' value="<?php echo @$key_in_data['id_card']; ?>" class="form-control numbers">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            คำนำหน้าชื่อ :
                        </label>
                        <label class="col-sm-7">
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
                        <label class="col-sm-5 right required">
                            ชื่อ :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="first_name" id="first_name" class='form-control' value="<?php echo @$key_in_data['first_name']; ?>">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            นามสกุล :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="last_name" id="last_name" class='form-control' value="<?php echo @$key_in_data['last_name']; ?>">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            โทรศัพท์เคลื่อนที่ : <br>(ที่สามารถติดต่อได้)
                        </label>
                        <label class="col-sm-7">
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