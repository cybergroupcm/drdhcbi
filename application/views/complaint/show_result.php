<div class="example-modal">
    <div class="modal fade" id="show_result" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">บันทึกผลการดำเนินการเรื่องร้องทุกข์</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ผลการดำเนินการ :
                                    </label>
                                    <div class="col-sm-7">
                                        <span id="result_detail_show"></span>
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
                                            <span id="result_date_show" ></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        แนบไฟล์เอกสารหลักฐาน :
                                    </label>
                                    <div class="col-sm-7">
                                        <span><p id="checkFile_show"></p></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
echo script_tag($link);;
?>