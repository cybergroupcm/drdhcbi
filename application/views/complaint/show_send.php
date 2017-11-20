<div class="example-modal">
    <div class="modal fade" id="show_send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ส่งต่อเรื่องร้องทุกข์</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        กำหนดวันที่ส่งกลับ :
                                    </label>
                                    <label class="col-sm-7">
                                        <span id="reply_date_show"></span>
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
                                        กำหนดหน่วยงานส่งต่อเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7 text-left">
                                        <span id='send_org_show'></span>
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
                                        วันที่ส่งต่อเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <span id="send_org_date_show"></span>
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
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
