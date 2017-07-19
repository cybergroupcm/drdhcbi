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
<input type="hidden" id="action_to" value="key_in_step4">
<?php
if(@$key_in_data['step']!='' && $key_in_data['step']>'1'){
    $step = @$key_in_data['step'];
}else{
    $step = '3';
}
?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <input type="hidden" id="step_now" name="step_now" value="3">
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
<?php
echo form_close();
?>
        <div class="row footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-5">
                        <input type="button" class="btn btn-bitbucket" value="หน้าก่อนหน้า" onclick="validateForm('key_in_step2','back')">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="หน้าถัดไป" onclick="validateForm('key_in_step4','')">
                    </label>
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
$link = array(
    'src' => 'assets/js/step.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>