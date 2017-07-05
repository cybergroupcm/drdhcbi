<div class="example-modal">
    <div class="modal fade" id="received" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">บันทึกรับเรื่องร้องทุกข์</h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url('complaint/dashboard')?>" name="form_save_received" id="form_save_received">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        เลขที่เรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7" id="text_complain_no"></label>
                                    <input type="hidden" id="action"  value="<?php echo @$data['action'];?>"/>
                                    <input type="hidden" name="complain_no" id="complain_no" value="">
                                    <input type="hidden" name="keyin_id" id="keyin_id" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        เรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7" id="text_complain_name"></label>
                                    <input type="hidden" name="complain_name" id="complain_name" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ผู้ส่งเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7" id="text_recipient"></label>
                                    <input type="hidden" name="recipient" id="recipient" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        วันที่ส่งเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7" id="text_doc_receive_date"></label>
                                    <input type="hidden" name="doc_receive_date" id="doc_receive_date" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        วันที่ร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="receive_date" id="receive_date" class="form-control pull-right datepicker" />
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
                                    <label class="col-sm-5 text-right"></label>
                                    <label class="col-sm-7 text-left">
                                        <input type="checkbox" id="receive_status" name="receive_status" value="1"> รับเรื่องร้องทุกข์
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" name="btSaveReceived" id="btSaveReceived" class="btn btn-primary">บันทึกรับเรื่องร้องทุกข์</button>
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
$link = array(
    'src' => 'assets/js/complaint_received.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>