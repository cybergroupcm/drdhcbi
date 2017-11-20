<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
            <div class="login-logo">
                <a href="#"><b>ลืมรหัสผ่าน</b></a>
            </div>

            <div class="login-box-body">
                <p class="login-box-msg">&nbsp;</p>
                <?php echo form_open_multipart('',array('id' => 'checkDataForm')); ?>
                    <div id="check_data">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="username" id="username" placeholder="ชื่อผู้ใช้">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="email" id="email" placeholder="อีเมล์">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control numbers" maxlength="13" name="idcard" id="idcard" placeholder="หมายเลขปัตรประชาชน หรือ หมายเลขหนังสือเดินทาง">
                            <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                            </div>
                            <div class="col-xs-4">
                                <input type="button" class="btn btn-primary btn-block btn-flat" onclick="checkData();" value="ตรวจสอบ">
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
                <?php echo form_open_multipart('',array('id' => 'repasswordForm')); ?>
                    <input type="hidden" name="id" id="id">
                    <div id="show_repassword" style="display:none;">
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" maxlength="10" name="repassword" id="repassword" placeholder="รหัสผ่านใหม่">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" maxlength="10" name="repassword2" id="repassword2" placeholder="ยืนยันรหัสผ่านใหม่">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                            </div>
                            <div class="col-xs-4">
                                <input type="button" class="btn btn-primary btn-block btn-flat" onclick="saveData();" value="บันทึก">
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>

            </div>
<div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
$link = array(
    'src' => 'assets/js/repassword.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
