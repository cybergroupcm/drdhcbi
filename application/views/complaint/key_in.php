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
                        <input type="text" id="complaint_date" class="form-control pull-right datepicker" />
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
                    <input type="text" id="employer" class="form-control" />
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
                        <input type="text" id="book_in_date" class="form-control pull-right datepicker" />
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
                    <input type="text" class="form-control" />
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
                        <input type="text" id="book_in_date" class="form-control pull-right datepicker" />
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
                    <input type="text" class="form-control" />
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
    <div class="row title">
        <div class="col-md-12">
            <div class="form-group">บันทึกเนื้อหาเรื่องร้องทุกข์/ร้องเรียน</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-sm-5 right required">
                    ประเภทเรื่อง : 
                </label>
                <label class="col-sm-7">
                    <select class="form-control" id="complaint_type">
                        <option value="">ร้องเรียน/ร้องทุกข์</option>
                    </select>
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
                    หัวข้อเรื่อง : 
                </label>
                <label class="col-sm-7">
                    <input type="text" id="complaint_title" class="form-control" />
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
                    ช่องทางรับเรื่อง : 
                </label>
                <label class="col-sm-7">
                    <select class="form-control" id="complaint_way">
                        <option value="">ศูนย์ดำรงธรรมส่วนกลาง</option>
                    </select>
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
                        ลักษณะเรื่อง : 
                    </label>
                    <label class="col-sm-7">
                        <select class="form-control" id="complaint_aspect">
                            <option value="">ทั่วไป</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab1">ผู้ร้องทุกข์</a></li>
        <li><a data-toggle="tab" href="#tab2">ประเภทเรื่องร้องทุกข์หลัก</a></li>
        <li><a data-toggle="tab" href="#tab3">หน่วยงานหรือผู้ถูกร้องเรียนร้องทุกข์</a></li>
        <li><a data-toggle="tab" href="#tab4">เนื้อหาสาระ</a></li>
        <li><a data-toggle="tab" href="#tab5">ความประสงค์ในการดำเนินการ</a></li>
        <li><a data-toggle="tab" href="#tab6">หลักฐานประกอบเรื่องร้องทุกข์</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab1" class="tab-pane fade in active">
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="radio" id="complainter1" onclick="change_complainter()" name="complainter" value="1"> ไม่ประสงค์ออกนาม
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="radio" id="complainter2" onclick="change_complainter()" name="complainter" value="2"> บันทึก/เลือกผู้ร้องทุกข์
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="complainter_detail" style="display: none;">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right required">
                                รหัสประจำตัวประชาชน : 
                            </label>
                            <label class="col-sm-7">
                                <input type="text" id="complainter_idcard" class="form-control">
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
                                <select id='complainter_prename' class='form-control'>
                                    <option value=''>--กรุณาระบุ--</option>
                                </select>
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
                                <select id='complainter_name' class='form-control'>
                                    <option value=''>--กรุณาระบุ--</option>
                                </select>
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
                                <select id='complainter_surname' class='form-control'>
                                    <option value=''>--กรุณาระบุ--</option>
                                </select>
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
                                <select id='complainter_phone' class='form-control'>
                                    <option value=''>--กรุณาระบุ--</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab2" class="tab-pane fade">
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <?php 
            $i=1;
            foreach($complaint_type as $key => $value){ ?>
                <?php if(($i%2)!=0){ ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                <?php } ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="radio" name="complaint_type" class="complaint_type" value="<?php echo $key; ?>"> <?php echo $value; ?>
                            </div>
                        </div>
                <?php if(($i%2)==0){ ?>
                    </div>
                <?php } ?>
            <?php $i++; } ?>
        </div>
        <div id="tab3" class="tab-pane fade">
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <div class="row">
                    <div class="col-md-1"></div>
                <?php foreach($complainant as $key => $value){ ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="radio" name="complainant" class="complainant" value="<?php echo $key; ?>"> <?php echo $value; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="tab4" class="tab-pane fade">
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right">
                                วันเดือนปีที่เกิดเหตุ(ถ้ามี) : 
                            </label>
                            <label class="col-sm-7">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="date_happen" class="form-control pull-right datepicker" />
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
                                สถานที่เกิดเหตุ : 
                            </label>
                            <label class="col-sm-7">
                                <input type="text" id="place_happen"  class="form-control" />
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
                                จังหวัด : 
                            </label>
                            <label class="col-sm-7">
                                <select class="form-control" id="province">
                                    <option value="">--กรุณาเลือก--</option>
                                </select>
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
                                อำเภอ : 
                            </label>
                            <label class="col-sm-7">
                                <select class="form-control" id="district">
                                    <option value="">--กรุณาเลือก--</option>
                                </select>
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
                                ตำบล : 
                            </label>
                            <label class="col-sm-7">
                                <select class="form-control" id="sub_district">
                                    <option value="">--กรุณาเลือก--</option>
                                </select>
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
                                รายละเอียดการร้องเรียน/ร้องทุกข์ : 
                            </label>
                            <label class="col-sm-7">
                                <textarea class="form-control" id="case_event" cols="20" rows="5"></textarea>
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
                                จุดเกิดเหตุ : 
                            </label>
                            <label class="col-sm-2">
                                ละติจูด
                            </label>
                            <label class="col-sm-5">
                                <input type="text" class="form-control" readonly="true" id="txt_lat">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3">
                                ลองติจูด
                            </label>
                            <label class="col-sm-5">
                                <input type="text" class="form-control" readonly="true" id="txt_lon">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div id="map_canvas" style="width:100%; height:300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab5" class="tab-pane fade">
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right required">
                                ความประสงค์ : 
                            </label>
                            <span class="col-sm-7">
                                <input type="checkbox" class="desire" > ขอความช่วยเหลือ
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right"></label>
                            <span class="col-sm-7">
                                <input type="checkbox" class="desire" > ขอความเป็นธรรม
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right"></label>
                            <span class="col-sm-7">
                                <input type="checkbox" class="desire" > ขอตรวจสอบข้อเท็จจริง
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right">
                                ความประสงค์เพิ่มเติม : 
                            </label>
                            <label class="col-sm-7">
                                <textarea class="form-control" cols="20" rows="5"></textarea>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab6" class="tab-pane fade">
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-5 right">
                                แนบไฟล์เอกสารหลักฐาน : 
                            </label>
                            <label class="col-sm-7">
                                <input type="file" multiple id="myFile" onchange="checkFile()" accept=".jpg, .png, .pdf">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <span class="col-sm-12 right" style="color:red;">
                                อณุญาตให้แนบไฟล์นามสกุล .jpg, .png, .pdf ขนาดไม่เกิน 1 MB 
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-2 right"></label>
                        <span class="col-sm-10"><p id="checkFile"></p></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row footer">
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
</div>
<?php 
$link = array(
                ' src' => 'http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=AIzaSyACSdMKi4OrvylAegEJXXR3--RnLUYUBtw',
                ' type' => 'text/javascript'
       );
       echo script_tag($link);
$link = array(
                'src' => 'assets/js/map.js',
                'type' => 'text/javascript'
       );
       echo script_tag($link);
$link = array(
                'src' => 'assets/js/key_in.js',
                'type' => 'text/javascript'
       );
       echo script_tag($link);
?>