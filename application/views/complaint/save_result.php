<div class="example-modal">
    <div class="modal fade" id="save_result" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">บันทึกผลการดำเนินการเรื่องร้องทุกข์</h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url('complaint/dashboard')?>" name="form_save_result" id="form_save_result" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ผลการดำเนินการ :
                                    </label>
                                    <div class="col-sm-7">
                                        <textarea name="result_detail" id="result_detail" class="form-control" rows="3"></textarea>
                                        <input type="hidden" name="complain_no_result" id="complain_no_result" value="">
                                        <input type="hidden" name="keyin_id_result" id="keyin_id_result" value="">
                                        <input type="hidden" name="result_id" id="result_id" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        วันที่ดำเนินการ/ยุติ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="result_date" id="result_date" class="form-control pull-right key_date" />
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
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
                            <div class="col-md-10">
                                <div class="form-group">
                            <span class="col-sm-12 right" style="color:red;">
                                อนุญาตให้แนบไฟล์นามสกุล .jpg, .png, .pdf ขนาดไม่เกิน 1 MB
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
                            <div id="file_add_space">

                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right"></label>
                                    <label class="col-sm-7 text-left">
                                        <input type="checkbox" id="save_result_status" name="save_result_status" value="1"> บันทึกผลการดำเนินการ
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" name="btOpenSend" class="btn btn-warning btOpenSend open-send" data-toggle="modal" data-target="#send" data-id="">ยกเลิกส่งต่อเรื่องร้องทุกข์</button>
                    <button type="button" name="btSaveResult" id="btSaveResult" class="btn btn-primary">บันทึกผลการดำเนินการ</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/complaint_save_result.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>