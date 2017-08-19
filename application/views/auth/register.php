<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<form id="frm_user">
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>ศูนย์ดำรงธรรม</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">สมัครสมาชิก</p>
            <form action="../../index.html" method="post">
                <input type="hidden" name="action_to" id="action_to" value="auth"/>
                <input type="hidden" name="id" id="id" value="" />
                <div class="form-group has-feedback">
                    <?php
                    echo form_dropdown([
                        'name' => 'id_type',
                        'id' => 'id_type',
                        'class' => 'form-control',
                        'style'=>'padding: 0px 8px;'
                    ], array(
                            1 => 'บัตรประจำตัวประชาชน/Identity card',
                            2 => 'หนังสือเดินทาง/passport')
                        , '');
                    ?>
                </div>
                <span class="text-danger">*</span>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control numbers" name="idcard" id="idcard" maxlength='13'
                           placeholder="รหัสประจำตัวประชาชน"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback show_input">
                    <?php
                    $prename = $title_name;
                    $prename[''] = 'กรุณาเลือกคำนำหน้าชื่อ (ภาษาไทย)';
                    ksort($prename);
                    echo form_dropdown([
                        'name' => 'prename_th',
                        'id' => 'prename_th',
                        'class' => 'form-control',
                        'style'=>'padding: 0px 8px;'
                    ], $prename, '');
                    ?>
                    <!--                <input type="text" class="form-control" id="prename_th" name="prename_th" placeholder="คำนำหน้าชื่อ (ภาษาไทย)"/>-->
                    <!--<span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                </div>
                <span class="text-danger show_input">*</span>
                <div class="form-group has-feedback show_input">
                    <input type="text" class="form-control" id="name_th" name="first_name"
                           placeholder="ชื่อ (ภาษาไทย)"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <span class="text-danger show_input">*</span>
                <div class="form-group has-feedback show_input">
                    <input type="text" class="form-control" id="surname_th" name="last_name"
                           placeholder="นามสกุล (ภาษาไทย)"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <!--<input type="text" class="form-control" id="prename_en" name="prename_en"
                           placeholder="คำนำหน้าชื่อ (ภาษาอังกฤษ)"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>-->
                    <?php
                    $prename_en = $title_name_en;
                    $prename_en[''] = 'กรุณาเลือกคำนำหน้าชื่อ (ภาษาอังกฤษ)';
                    ksort($prename_en);
                    echo form_dropdown([
                        'name' => 'prename_en',
                        'id' => 'prename_en',
                        'class' => 'form-control',
                        'style'=>'padding: 0px 8px;'
                    ], $prename_en, '');
                    ?>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="name_en" name="first_name_en"
                           placeholder="ชื่อ (ภาษาอังกฤษ)"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="surname_en" name="last_name_en"
                           placeholder="นามสกุล (ภาษาอังกฤษ)"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="address" id="address"
                           placeholder="ที่อยู่ติดต่อกลับ"/>
                    <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback show_input">
                    <?php
                    $province_arr = $province_list;
                    $province_arr[''] = 'กรุณาเลือกจังหวัด';
                    ksort($province_arr);
                    echo form_dropdown([
                        'name' => 'province_id',
                        'id' => 'province_id',
                        'class' => 'form-control',
                        'style'=>'padding: 0px 8px;',
                        'onchange'=>"get_district(this.value,'')"
                    ], $province_arr, @$data['user']['address_id']!=''?  substr(@$data['user']['address_id'],0,3)."00000":'20000000');
                    ?>
               </div>
                <div class="form-group has-feedback show_input">
                    <span id="district_span">
                        <?php
                        $district_arr = $district_list;
                        $district_arr[''] = 'กรุณาเลือกอำเภอ';
                        ksort($district_arr);
                        echo form_dropdown([
                            'name' => 'district_id',
                            'id' => 'district_id',
                            'class' => 'form-control',
                            'style'=>'padding: 0px 8px;',
                            'onchange'=>"get_subdistrict(this.value,'')"
                        ], $district_arr, substr(@$data['user']['address_id'],0,4)."0000");
                        ?>
                    </span>
                </div>
                <div class="form-group has-feedback show_input">
                    <span id="subdistrict_span">
                        <?php
                        $subdistrict_arr = @$subdistrict_list;
                        $subdistrict_arr[''] = 'กรุณาเลือกตำบล';
                        ksort($subdistrict_arr);
                        echo form_dropdown([
                            'name' => 'address_id',
                            'id' => 'address_id',
                            'class' => 'form-control',
                            'style'=>'padding: 0px 8px;',
                        ], $subdistrict_arr, @$data['user']['address_id']);
                        ?>
                    </span>
                </div>
                <!--<div class="form-group has-feedback">
                    <input type="text" class="form-control" name="company" id="section"
                           placeholder="หน่วยงาน/แผนก ที่สังกัด"/>
                    <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
                </div>-->
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" onblur='return validateEmail(this)' name="email" id="email"
                           placeholder="อีเมล์"/>
                    <input type="hidden" name="email2" id="email2" value="none"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <span class="text-danger">*</span>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control numbers" id="phone_number" name="phone"
                           placeholder="เบอร์โทรศัพท์"/>
                    <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
                </div>
                <span class="text-danger">*</span>
                <div class="form-group has-feedback">
                    <input type="text" name="username" id="username" class="form-control letter_and_number"
                           onblur="check_username(this.value)" onkeypress="check_first_letters(this, event)"
                           maxlength='10' placeholder="ชื่อผู้ใช้"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <span class="text-danger">*</span>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="รหัสผ่าน"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <span class="text-danger">*</span>
                <div class="form-group has-feedback">
                    <input type="password" id="password2"
                           onblur="confirm_input('password','password2','password_confirm_text')" class="form-control"
                           placeholder="ยืนยันรหัสผ่าน"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row center">

                    <div >
                        <button type="button" class="btn btn-primary btn-block btn-flat col-xs-4" onclick="validateForm('add')">
                            ลงทะเบียน
                        </button>
                    </div><!-- /.col -->
                </div>
            </form>

            <?php if ($auth_social_network == TRUE): ?>
                <!--<div class="social-auth-links text-center">
                <p>- <?php /*echo lang('auth_or'); */ ?> -</p>
                <?php /*echo anchor('#', '<i class="fa fa-facebook"></i>' . lang('auth_sign_facebook'), array('class' => 'btn btn-block btn-social btn-facebook btn-flat')); */ ?>
                <?php /*echo anchor('#', '<i class="fa fa-google-plus"></i>' . lang('auth_sign_google'), array('class' => 'btn btn-block btn-social btn-google btn-flat')); */ ?>
            </div>-->
            <?php endif; ?>
            <?php echo anchor('auth/login', 'กลับสู่หน้าเข้าสู่ระบบ'); ?>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->
</form>
<script>
    var base_url = '<?php echo base_url() ?>';
</script>
