<?php 
$link = array(
                'href' => '/assets/css/key_in.css',
                'type' => 'text/css',
                'rel' => 'stylesheet'
       );
       echo link_tag($link);
?>
<div class="row frame">
    <div class="row title">
        <div class="col-md-12">
            <div class="form-group">สมัครสมาชิก</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-3 right required">
                    ชื่อผู้ใช้งาน : 
                </label>
                <label class="col-sm-3">
                    <input type="text" id="username" class="form-control letter_and_number" onkeypress="check_first_letters(this, event)" maxlength='10' />
                </label>
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
                    <input type="password" id="password" class="form-control no_symbol" maxlength='10' />
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
                    <input type="text" id="email" onblur='return validateEmail(this)' class="form-control" />
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
                    <input type="text" id="email2" onblur="confirm_input('email','email2','email_confirm_text')" class="form-control" />
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
                    <input type="text" id="idcard" class="form-control numbers" maxlength='13' />
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
                    <select id='prename_th' class='form-control'>
                        <option value=''>--กรุณาระบุ--</option>
                    </select>
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
                    <input type="text" id="name_th" class="form-control" />
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
                    <input type="text" id="surname_th" class="form-control" />
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
                    <select id='prename_en' class='form-control'>
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
                    <input type="text" id="name_en" class="form-control" />
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
                    <input type="text" id="surname_en" class="form-control" />
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
                    <input type="radio" class='gentle' id="gentle1" value="M" /> ชาย 
                    <input type="radio" class='gentle' id="gentle2" value="F" /> หญิง 
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
                    <input type="text" id="section" class="form-control" />
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
                    <input type="text" id="position" class="form-control" />
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
                    <input type="text" id="address" class="form-control" />
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
                    <select class="form-control" id="province">
                        <option value="">--กรุณาเลือก--</option>
                    </select>
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
                    <select class="form-control" id="district">
                        <option value="">--กรุณาเลือก--</option>
                    </select>
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
                    <select class="form-control" id="sub_district">
                        <option value="">--กรุณาเลือก--</option>
                    </select>
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
                    <input type="text" id="phone_number" class="form-control numbers" />
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
                    <input type="button" class="btn btn-bitbucket" value="สมัครสมาชิก" onclick="validateForm()">
                </label>
                <label class="col-sm-5">
                    <input type="button" class="btn btn-default" value="ยกเลิก">
                </label>
            </div>
        </div>
    </div>
</div>
<?php 
$link = array(
                'src' => 'assets/js/register.js',
                'type' => 'text/javascript'
       );
       echo script_tag($link);
?>