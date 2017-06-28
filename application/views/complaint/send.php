<div class="example-modal">
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ส่งต่อเรื่องร้องทุกข์</h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url('complaint/dashboard')?>" name="form_save_send" id="form_save_send">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="hidden" id="action"  value="<?php echo @$data['action'];?>"/>
                                    <input type="hidden" name="complain_no_send" id="complain_no_send" value="">
                                    <input type="hidden" name="keyin_id_send" id="keyin_id_send" value="">
                                    <label class="col-sm-5 text-right">
                                        กำหนดวันที่ส่งกลับ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="reply_date" id="reply_date" class="form-control pull-right datepicker" />
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
                                    <label class="col-sm-5 text-right">
                                        กำหนดหน่วยงานส่งต่อเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7 text-left">
                                        <input type="radio" id="send_org_parent" name="send_org_parent" value="1"> หน่วยงานภายในสังกัดกระทรวงมหาดไทย
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
                                        <select class="form-control" name="send_org_id" id="send_org_id">
                                            <option>--กรุณาเลือก--</option>
                                            <?php
                                            foreach($data_department AS $key=> $val){
                                                echo "<option value='".$key."'>".$val."</option>";
                                            }
                                            ?>
                                        </select>
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
                                        <input type="radio" id="send_org_parent" name="send_org_parent" value="2"> หน่วยงานอื่นที่เกี่ยวข้อง
                                    </label>
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
                                    วันที่ส่งต่อเรื่องร้องทุกข์ :
                                </label>
                                <label class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="send_org_date" id="send_org_date" class="form-control pull-right datepicker" />
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" name="btSaveSend" id="btSaveSend" class="btn btn-primary">บันทึกส่งต่อเรื่องร้องทุกข์</button>
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
    'src' => 'assets/js/complaint_send.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>