<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<form id="frm_user" >
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>ศูนย์ดำรงธรรม</b><br> จังหวัดชลบุรี</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">สมัครสมาชิก</p>
        <form action="../../index.html" method="post">
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="idcard" id="idcard" placeholder="รหัสประจำตัวประชาชน"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <?php
                $prename = $title_name;
                $prename[''] = 'กรุณาเลือกคำนำหน้าชื่อ';
                ksort($prename);
                echo form_dropdown([
                    'name' => 'prename_th',
                    'id' => 'prename_th',
                    'class' => 'form-control'
                ], $prename, '');
                ?>
<!--                <input type="text" class="form-control" id="prename_th" name="prename_th" placeholder="คำนำหน้าชื่อ (ภาษาไทย)"/>-->
                <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="name_th" name="first_name" placeholder="ชื่อ (ภาษาไทย)"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="surname_th" name="last_name" placeholder="นามสกุล (ภาษาไทย)"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="prename_en" name="prename_en" placeholder="คำนำหน้าชื่อ (ภาษาอังกฤษ)"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="name_en" name="first_name_en" placeholder="ชื่อ (ภาษาอังกฤษ)"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="surname_en" name="last_name_en" placeholder="นามสกุล (ภาษาอังกฤษ)"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="company" id="section" placeholder="หน่วยงาน/แผนก ที่สังกัด"/>
                <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="email" id="email" placeholder="อีเมลล์"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" id="phone_number" name="phone" placeholder="เบอร์โทรศัพท์"/>
                <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="text" name="username" id="username" class="form-control" placeholder="ชื่อผู้ใช้"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control" placeholder="รหัสผ่าน"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <span class="text-danger">*</span>
            <div class="form-group has-feedback">
                <input type="password" id="password2" onblur="confirm_input('password','password2','password_confirm_text')" class="form-control" placeholder="ยืนยันรหัสผ่าน"/>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <!--<div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>-->
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-block btn-flat" onclick="validateForm('add')">Register</button>
                </div><!-- /.col -->
            </div>
        </form>

        <?php if ($auth_social_network == TRUE): ?>
            <!--<div class="social-auth-links text-center">
                <p>- <?php /*echo lang('auth_or'); */?> -</p>
                <?php /*echo anchor('#', '<i class="fa fa-facebook"></i>' . lang('auth_sign_facebook'), array('class' => 'btn btn-block btn-social btn-facebook btn-flat')); */?>
                <?php /*echo anchor('#', '<i class="fa fa-google-plus"></i>' . lang('auth_sign_google'), array('class' => 'btn btn-block btn-social btn-google btn-flat')); */?>
            </div>-->
        <?php endif; ?>
        <?php echo anchor('auth/login', 'I already have a membership'); ?>
    </div><!-- /.form-box -->
</div><!-- /.register-box -->
</form>
<script>
    var base_url = '<?php echo base_url() ?>';
</script>
