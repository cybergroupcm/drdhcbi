<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php
$link = array(
                'href' => '/assets/css/key_in.css',
                'type' => 'text/css',
                'rel' => 'stylesheet'
       );
       echo link_tag($link);
       //echo"<pre>";print_r($data);echo"</pre>";
?>
    <section class="content-header">
        <?php echo @$pagetitle; ?>
        <?php echo @$breadcrumb; ?>
    </section>

    <section class="content">
        <div class="box">
    <form id="frm_user" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo @$id; ?>" />
        <input type="hidden" name="action_to" id="action_to" value="admin/users" />
        <div class="row frame">
            <!--div class="row title">
                <div class="col-md-12">
                    <div class="form-group"></div>
                </div>
            </div-->

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            ชื่อผู้ใช้งาน :
                        </label>
                        <label class="col-sm-3">
                            <?php
                            if(@$id!=''){
                                echo @$data['user']['username'];
                            }else{
                            ?>
                            <input type="text" name="username" id="username" class="form-control letter_and_number" onblur="check_username(this.value)" onkeypress="check_first_letters(this, event)" maxlength='10' />

                            <?php } ?>
                        </label>
                        <label id="username_confirm_text" style="color:red;"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3"></label>
                        <label class="col-sm-9" style='color:orange;'>
                            ต้องเริ่มต้นด้วย A-Z หรือ a-z ตามด้วยตัวอักษรหรือตัวเลข และไม่เกิน 10 ตัวอักษร
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            รหัสผ่าน :
                        </label>
                        <label class="col-sm-3">
                            <input type="password" name="password" id="password" class="form-control no_symbol" maxlength='10' />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3"></label>
                        <label class="col-sm-9" style='color:orange;'>
                            ต้องเป็นตัวอักษร A-Z หรือ a-z หรือตัวเลข และไม่เกิน 10 ตัวอักษร
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            ยืนยันรหัสผ่าน :
                        </label>
                        <label class="col-sm-3">
                            <input type="password" id="password2" onblur="confirm_input('password','password2','password_confirm_text')" id="password2" class="form-control" />
                        </label>
                        <label id="password_confirm_text" style="color:red;"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            อีเมล์ :
                        </label>
                        <label class="col-sm-3">
                            <input type="text" name="email" id="email"  onblur='return validateEmail(this)' class="form-control" value="<?php echo @$data['user']['email']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            ยืนยันอีเมล์ :
                        </label>
                        <label class="col-sm-3">
                            <input type="text" id="email2" onblur="confirm_input('email','email2','email_confirm_text')" class="form-control" value="<?php echo @$data['user']['email']?>" />
                        </label>
                        <label id="email_confirm_text" style="color:red;"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            รหัสประจำตัวประชาชน :
                        </label>
                        <label class="col-sm-3">
                            <input type="text" name="idcard" id="idcard" class="form-control numbers" maxlength='13' value="<?php echo @$data['user']['idcard']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            คำนำหน้าชื่อ :
                        </label>
                        <label class="col-sm-3">
                            <?php
                            @$prename = @$title_name;
                            @$prename[''] = 'กรุณาเลือกคำนำหน้าชื่อ';
                            ksort($prename);
                            echo form_dropdown([
                                'name' => 'prename_th_id',
                                'id' => 'prename_th_id',
                                'class' => 'form-control',
                                'onchange'=>"get_list_text('prename_th_id','prename_th')"
                            ], @$prename, @$data['user']['prename_th_id']);
                            ?>
                            <input type="hidden" name="prename_th" id="prename_th" value="<?php echo @$data['user']['prename_th']; ?>">
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            ชื่อ :
                        </label>
                        <label class="col-sm-3">
                            <input type="text" id="name_th" name="first_name" class="form-control" value="<?php echo @$data['user']['first_name']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            นามสกุล :
                        </label>
                        <label class="col-sm-3">
                            <input type="text" id="surname_th" name="last_name" class="form-control" value="<?php echo @$data['user']['last_name']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                            คำนำหน้าชื่อ :<br>(ภาษาอังกฤษ)
                        </label>
                        <label class="col-sm-3">
                            <select id="prename_en" name="prename_en" class="form-control">
                                <option value=''>--กรุณาระบุ--</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                            ชื่อ :<br>(ภาษาอังกฤษ)
                        </label>
                        <label class="col-sm-3">
                            <input type="text" id="name_en" name="first_name_en" class="form-control" value="<?php echo @$data['user']['first_name_en']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                            นามสกุล : <br>(ภาษาอังกฤษ)
                        </label>
                        <label class="col-sm-3">
                            <input type="text" id="surname_en" name="last_name_en" class="form-control" value="<?php echo @$data['user']['last_name_en']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            เพศ :
                        </label>
                        <label class="col-sm-3">
                            <input type="radio" name="gender" class='gender' id="gender1" value="M" <?php echo (@$data['user']['gender']=='M')?'checked':''; ?> /> ชาย
                            <input type="radio" name="gender" class='gender' id="gender2" value="F" <?php echo (@$data['user']['gender']=='F')?'checked':''; ?> /> หญิง
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            หน่วยงาน/แผนก ที่สังกัด :
                        </label>
                        <label class="col-sm-3">
                            <input type="text"  name="company" id="section" class="form-control" value="<?php echo @$data['user']['company']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                            ตำแหน่ง :
                        </label>
                        <label class="col-sm-3">
                            <input type="text"  name="position" id="position" class="form-control" value="<?php echo @$data['user']['position']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            ที่อยู่ :
                        </label>
                        <label class="col-sm-4">
                            <input type="text" id="address" name="address" class="form-control" value="<?php echo @$data['user']['address']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            จังหวัด :
                        </label>
                        <label class="col-sm-3">
                            <?php
                            @$province_arr = @$province_list;
                            @$province_arr[''] = 'กรุณาเลือก';
                            ksort($province_arr);
                            echo form_dropdown([
                                'name' => 'province_id',
                                'id' => 'province_id',
                                'class' => 'form-control',
                                'onchange'=>"get_district(this.value,'')"
                            ], @$province_arr, @$data['user']['address_id']!=''?  substr(@$data['user']['address_id'],0,3)."00000":'20000000');
                            ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            อำเภอ :
                        </label>
                        <label class="col-sm-3">
                            <span id="district_span">
                                <?php
                                @$district_arr = @$district_list;
                                @$district_arr[''] = 'กรุณาเลือก';
                                ksort($district_arr);
                                echo form_dropdown([
                                    'name' => 'district_id',
                                    'id' => 'district_id',
                                    'class' => 'form-control',
                                    'onchange'=>"get_subdistrict(this.value,'')"
                                ], @$district_arr, substr(@$data['user']['address_id'],0,4)."0000");
                                ?>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right required">
                            ตำบล :
                        </label>
                        <label class="col-sm-3">
                            <span id="subdistrict_span">
                                <?php
                                @$subdistrict_arr = @$subdistrict_list;
                                @$subdistrict_arr[''] = 'กรุณาเลือก';
                                ksort($subdistrict_arr);
                                echo form_dropdown([
                                    'name' => 'address_id',
                                    'id' => 'address_id',
                                    'class' => 'form-control'
                                ], @$subdistrict_arr, @$data['user']['address_id']);
                                ?>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                            หมายเลขโทรศัพท์ :
                        </label>
                        <label class="col-sm-4">
                            <input type="text" id="phone_number" name="phone" class="form-control numbers" value="<?php echo @$data['user']['phone']?>" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                            อัพโหลดรูปภาพ :
                        </label>
                        <label class="col-sm-4">
                            <input type="file" accept=".jpg, .png" id="register_photo" name="register_photo" class="form-control" onchange="readURL(this);"/>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 right">
                        </label>
                        <label class="col-sm-4">
                            <?php
                                if(@$data['user']['register_photo']!=''){
                                    @$register_photo = @$data['user']['register_photo'];
                                }else{
                                    @$register_photo = 'no_photo.jpg';
                                }
                            ?>
                            <img id="show_photo" width="150px" height="160px" src="<?php echo base_url('upload/register_photos/'.@$register_photo);?>" alt="your image" />
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
                            <input type="button" class="btn btn-bitbucket" value="บันทึก" onclick="validateForm()">
                        </label>
                        <label class="col-sm-5">
                            <input type="button" class="btn btn-default" value="ยกเลิก">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</section>
<script>
    var base_url = '<?php echo base_url() ?>';</script>
<?php

$link = array(
    'src' => 'assets/js/register.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
