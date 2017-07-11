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
                            <?php
                            $dd1 = $complain_type;
                            $dd1[''] = 'กรุณาเลือก';
                            ksort($dd1);
                            echo form_dropdown([
                                'name' => 'complain_type_id',
                                'id' => 'complain_type_id',
                                'class' => 'form-control'
                            ], $dd1, @$key_in_data['complain_type_id']);
                            ?>
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
                            <input type="text" name="complain_name" id="complain_name" class="form-control" value="<?php echo @$key_in_data['complain_name']; ?>">
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
                            <?php
                            $dd2 = $channel;
                            $dd2[''] = 'กรุณาเลือก';
                            ksort($dd2);
                            echo form_dropdown([
                                'name' => 'channel_id',
                                'id' => 'channel_id',
                                'class' => 'form-control'
                            ], $dd2, @$key_in_data['channel_id']);
                            ?>
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
                            <?php
                            $dd3 = $subject;
                            $dd3[''] = 'กรุณาเลือก';
                            ksort($dd3);
                            echo form_dropdown([
                                'name' => 'subject_id',
                                'id' => 'subject_id',
                                'class' => 'form-control'
                            ], $dd3, @$key_in_data['subject_id']);
                            ?>
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
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="radio" id="user_complain_1" onclick="changeUserComplain()"
                                       name="user_complain_type_id" <?php echo @$key_in_data['user_complain_type_id']=='1'?'checked':''; ?> value="1">
                                <label for="complainter1">&nbsp;ไม่ประสงค์ออกนาม</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="radio" id="user_complain_2" onclick="changeUserComplain()"
                                       name="user_complain_type_id" <?php echo @$key_in_data['user_complain_type_id']=='2'?'checked':''; ?> value="2">
                                <label for="complainter2">&nbsp;บันทึก/เลือกผู้ร้องทุกข์</label>
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
                                    <input type="text" name="id_card" id="id_card" value="<?php echo @$key_in_data['id_card']; ?>" class="form-control">
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
            </div>
            <div id="tab2" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <?php
                    if(@$key_in_data['complaint_type']!=''){
                        foreach(@$key_in_data['complaint_type'] as $key => $value){
                            $complaint_type_id = $value['complain_type_id'];
                        }
                    }
                    $i = 1;
                    foreach ($complain_type as $key => $value) {
                        if (!empty($key)) {
                            if (($i % 2) != 0) {
                                $class = 'col-md-4 col-md-offset-1';
                            } else {
                                $class = 'col-md-7';
                            } ?>
                            <div class="<?php echo $class; ?>">
                                <div class="form-group">
                                    <input type="radio" class="complaint_type" name="complaint_type[]" id="complaint_type_<?php echo $key; ?>"
                                           value="<?php echo $key; ?>" <?php echo @$complaint_type_id==$key?'checked':'' ?>>
                                    <label for="complaint_type_<?php echo $key; ?>">&nbsp;<?php echo $value; ?></label>
                                </div>
                            </div>
                            <?php $i++;
                        }
                    } ?>
                </div>
            </div>
            <div id="tab3" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <?php
                    $i = 1;
                    foreach ($accused_type as $key => $value) {
                        if (!empty($key)) {
                            if (($i % 3) == 1) {
                                $class = 'col-md-3 col-md-offset-1';
                            } else if (($i % 3) == 2) {
                                $class = 'col-md-3';
                            } else {
                                $class = 'col-md-5';
                            } ?>
                            <div class="<?php echo $class; ?>">
                                <div class="form-group">
                                    <input type="radio" class="accused_type" id="accused_type_id_<?php echo $key; ?>" name="accused_type_id"
                                           value="<?php echo $key; ?>" <?php echo @$key_in_data['accused_type_id']==$key?'checked':'' ?>>
                                    <label for="accused_type_id_<?php echo $key; ?>">&nbsp;<?php echo $value; ?></label>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    } ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-5 right">
                                    ชื่อผู้ถูกร้องเรียน :
                                </label>
                                <label class="col-sm-7">
                                    <input type="text" name="accused_name" id="accused_name" class="form-control"
                                           value="<?php echo @$key_in_data['accused_name']; ?>">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab4" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
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
                                        <input readonly type="text" name="scene_date" id="scene_date"
                                               class="form-control pull-right datepicker" 
                                               value="<?php echo @$key_in_data['scene_date']!='0000-00-00' && @$key_in_data['scene_date']!=''?date('d/m/Y',  strtotime(@$key_in_data['scene_date'])):''; ?>">
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
                                    <input type="text" name="place_scene" id="place_scene" value="<?php echo @$key_in_data['place_scene']; ?>" class="form-control"/>
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
                                    <?php
                                    $province_arr = $province_list;
                                    $province_arr[''] = 'กรุณาเลือก';
                                    ksort($province_arr);
                                    echo form_dropdown([
                                        'id' => 'province_id',
                                        'class' => 'form-control',
                                        'onchange'=>"get_district(this.value,'')"
                                    ], $province_arr, @$key_in_data['address_id']!=''?  substr(@$key_in_data['address_id'],0,3)."00000":'20000000');
                                    ?>
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
                                    <span id="district_span">
                                        <?php
                                        $district_arr = $district_list;
                                        $district_arr[''] = 'กรุณาเลือก';
                                        ksort($district_arr);
                                        echo form_dropdown([
                                            'id' => 'district_id',
                                            'class' => 'form-control',
                                            'onchange'=>"get_subdistrict(this.value,'')"
                                        ], $district_arr, substr(@$key_in_data['address_id'],0,4)."0000");
                                        ?>
                                    </span>
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
                                    <span id="subdistrict_span">
                                        <?php
                                        $subdistrict_arr = @$subdistrict_list;
                                        $subdistrict_arr[''] = 'กรุณาเลือก';
                                        ksort($subdistrict_arr);
                                        echo form_dropdown([
                                            'name' => 'address_id',
                                            'id' => 'address_id',
                                            'class' => 'form-control'
                                        ], $subdistrict_arr, @$key_in_data['address_id']);
                                        ?>
                                    </span>  
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
                                    <textarea class="form-control" name="complaint_detail" id="complaint_detail"
                                              cols="20" rows="5"><?php echo @$key_in_data['complaint_detail']; ?></textarea>
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
                                    <input type="text" class="form-control" readonly id="txt_lat" name="latitude"
                                           value="<?php echo @$key_in_data['latitude']; ?>">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-3">
                                    ลองติจูด
                                </label>
                                <label class="col-sm-5">
                                    <input type="text" class="form-control" readonly id="txt_lon" name="longitude"
                                           value="<?php echo @$key_in_data['longitude']; ?>">
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
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <?php
                    if(@$key_in_data['wish']!=''){
                        foreach(@$key_in_data['wish'] as $key => $value){
                            $wish_id = $value['wish_id'];
                        }
                    }
                    $i = 1;
                    foreach ($wish as $key => $value) {
                        ?>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                    
                                    if($i == 1){
                                        $label = "ความประสงค์ :";
                                        $class = "required";
                                    }
                                    else{
                                        $label = '';
                                        $class = '';
                                    }
                                    ?>
                                    <label class="col-sm-5 right <?php echo $class;?>"><?php echo $label;?></label>
                                    <span class="col-sm-7">
                                        <input type="checkbox" class="desire" id="wish_<?php echo $key ?>" name="wish[]"
                                               value="<?php echo $key; ?>" <?php echo @$wish_id==$key?'checked':''; ?> >
                                        <label for="wish_<?php echo $key ?>">&nbsp;<?php echo $value; ?></label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-5 right">
                                    ความประสงค์เพิ่มเติม :
                                </label>
                                <label class="col-sm-7">
                                    <textarea class="form-control" cols="100" rows="5" id="wish_detail"
                                              name="wish_detail"><?php echo @$key_in_data['wish_detail']; ?></textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab6" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-sm-5 right">
                                    แนบไฟล์เอกสารหลักฐาน :
                                </label>
                                <label class="col-sm-7">
                                    <!--input type="file" multiple id="myFile" name="attach_file[]" onchange="checkFile()"
                                           accept=".jpg, .png, .pdf"-->
                                    <input type="button" id="add_file" class="btn btn-primary" value="เพิ่มไฟล์" onclick="add_new_file()">
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
                            <span class="col-sm-10">
                                <i id="checkFile">
                                    <?php
                                    $fileCount = 0;
                                    if(array_key_exists('attach_file',$key_in_data)){
                                        if(!is_null($key_in_data['attach_file'])){
                                            foreach ($key_in_data['attach_file'] as $file){
                                                $fileCount++;
                                                echo '<span id="show_file_'.$fileCount.'">name: '.$file['file_name'].'<br><input type="button" class="btn btn-sm btn-primary" value="แสดง" onclick="window.open(\''.base_url($file['file_system_name']).'\', \'_blank\');" >&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-sm btn-danger" value="ลบ" onclick="ajax_delete(\''.$file['file_id'].'\',\''.$fileCount.'\');" type="button"><hr></span>';
                                            }
                                        }
                                    }
                                    ?>
                                </i>
                                <input type="hidden" id="file_count" value="<?php echo $fileCount;?>">
                            </span>
                        </div>
                    </div>
                    <div id="file_add_space">
                    </div>
                </div>
            </div>
            <?php
            echo form_close();
            ?>
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
<div id="base_url" class="<?php echo base_url(); ?>"></div>
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