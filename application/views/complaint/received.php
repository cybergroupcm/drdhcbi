<div class="example-modal">
    <div class="modal fade" id="received" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">บันทึกรับเรื่องร้องทุกข์</h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="" name="form_save_received" id="form_save_received">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        เลขที่เรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7" id="text_req_id"></label>
                                    <input type="hidden" name="req_id" id="req_id" value="">
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
                                    <label class="col-sm-7" id="text_req_title"></label>
                                    <input type="hidden" name="req_title" id="req_title" value="">
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
                                    <label class="col-sm-7" id="text_req_name"></label>
                                    <input type="hidden" name="req_name" id="req_name" value="">
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
                                    <label class="col-sm-7" id="text_send_date"></label>
                                    <input type="hidden" name="send_date" id="send_date" value="">
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
                                            <input type="text" id="complaint_date" class="form-control pull-right datepicker" />
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
                                        <input type="checkbox" id="" name=""> รับเรื่องร้องทุกข์
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
