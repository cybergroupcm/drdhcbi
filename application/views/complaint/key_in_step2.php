<?php
$link = array(
    'href' => '/assets/css/key_in.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
$link = array(
    'href' => '/assets/css/step.css',
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
<input type="hidden" id="action_to" value="key_in_step3">
<?php
if(@$key_in_data['step']!='' && $key_in_data['step']>'2'){
    $step = @$key_in_data['step'];
}else{
    $step = '2';
}
$dateNow = date('d/m/Y H:i:s',strtotime('+543 years'));
?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <input type="hidden" id="step_now" name="step_now" value="2">
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">เนื้อหาเรื่องร้องทุกข์ร้องเรียน</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            วันเดือนปีที่เกิดเหตุ(ถ้ามี)/Date of scene :
                        </label>
                        <label class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php
                                if(@$key_in_data['scene_date']!=''&&@$key_in_data['scene_date']!='0000-00-00 00:00:00') {
                                    $arrSceneDate = explode(' ',$key_in_data['scene_date']);
                                    $sceneDate = explode('-',$arrSceneDate[0]);
                                    $sceneTime = $arrSceneDate[1];
                                    $sceneDateTime = $sceneDate[2].'/'.$sceneDate[1].'/'.($sceneDate[0]+543).' '.$sceneTime;
                                }else{
                                    $sceneDateTime = $dateNow;
                                }
                                ?>
                                <input type="text" name="scene_date" id="scene_date"
                                       class="form-control pull-right datetimepicker"
                                       value="<?php echo $sceneDateTime; ?>">
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
                        <label class="col-sm-6 right required">
                            สถานที่เกิดเหตุ/Scene Place :
                        </label>
                        <label class="col-sm-6">
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
                        <label class="col-sm-6 right required">
                            จังหวัด/Province :
                        </label>
                        <label class="col-sm-6">
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
                        <label class="col-sm-6 right required">
                            อำเภอ/District :
                        </label>
                        <label class="col-sm-6">
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
                        <label class="col-sm-6 right required">
                            ตำบล/Parish :
                        </label>
                        <label class="col-sm-6">
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
                        <label class="col-sm-6 right required">
                            รายละเอียดการร้องเรียน/ร้องทุกข์/Complaint details :
                        </label>
                        <label class="col-sm-6">
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
                        <label class="col-sm-6 right required">
                            จุดเกิดเหตุ/Scene location :
                        </label>
                        <label class="col-sm-2">
                            ละติจูด/ latitute
                        </label>
                        <label class="col-sm-4">
                            <input type="text" class="form-control" readonly id="txt_lat" name="latitude"
                                   value="<?php echo @$key_in_data['latitude']; ?>">
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3">
                            ลองติจูด/ longtitute
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
                    <input id="pac-input" class="controls form-control" type="text" placeholder="ค้นหาพื้นที่...">
                    <div id="map_canvas" style="width:100%; height:300px;"></div>
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
                        <input type="button" class="btn btn-bitbucket" value="หน้าก่อนหน้า" onclick="validateForm('key_in_step1','back')">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="หน้าถัดไป" onclick="validateForm('key_in_step3','')">
                    </label>
                </div>
            </div>
        </div>
    </div>
<div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
$link = array(
    'src' => 'assets/js/map.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    ' src' => 'https://maps.googleapis.com/maps/api/js?key=AIzaSyACSdMKi4OrvylAegEJXXR3--RnLUYUBtw&libraries=places',
    ' type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'href' => '/assets/css/key_in_map.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
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
$link = array(
    'src' => 'assets/js/step.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
