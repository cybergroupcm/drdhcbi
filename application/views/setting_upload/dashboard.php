<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
'src' => 'assets/js/setting_upload.js',
'type' => 'text/javascript'
);
echo script_tag($link);

$link = array(
    'href' => 'assets/css/dataTables.bootstrap.min.css',
    'rel' => 'stylesheet',
    'type' => 'text/css'
);
echo link_tag($link);
$link = array(
    'src' => 'assets/js/jquery.dataTables.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/dataTables.bootstrap.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
<style>
    .btn-info {
        background-color: #4db6ac;
        border-color: #4db6ac;
    }
    .btn-info.hover{background-color:#4db6ac}
</style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">ตั้งค่าข้อมูลอัพโหลดเอกสาร</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12 text-right" style="margin-bottom: 5px;padding-right: 0px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-5 right required">
                                                ขนาดไฟล์เอกสาร :
                                            </label>
                                            <label class="col-sm-3">
                                                <input type="hidden" name="setting_id" id="setting_id" value="<?php echo $data['setting_id'] ?>">
                                                <input type="number" name="upload_size" id="upload_size" class="form-control" value="<?php echo $data['upload_size'] ?>">
                                            </label>
                                            <label class="col-sm-1">
                                                MB
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
                                                ประเภทไฟล์เอกสาร :
                                            </label>
                                            <label class="col-sm-6">
                                                <input type="text" name="upload_type" id="upload_type" class="form-control" value="<?php echo $data['upload_type'] ?>">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 right required">
                                            </label>
                                            <label class="col-sm-6" style="text-align:left;">
                                                รูปแบบของการตั้งค่า เช่น .pdf, .jpd, .png หรือ * หากไม่ต้องการจำกัดประเภทไฟล์
                                            </label>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-5 right">
                                            </label>
                                            <label class="col-sm-6" style="text-align:left;">
                                                <input type="button" id="btn_save" class="btn btn-info" onclick="save_setting()" value="บันทึก">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div id="base_url" class="<?php echo base_url();?>"></div>
