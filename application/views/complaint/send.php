<div class="example-modal">
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label class="col-sm-5 text-right">
                                        กำหนดหน่วยงานส่งต่อเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7 text-left">
                                        <input type="radio" id="" name=""> หน่วยงานภายในสังกัดกระทรวงมหาดไทย
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
                                        <select class="form-control">
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
                                        <input type="radio" id="" name=""> หน่วยงานอื่นที่เกี่ยวข้อง
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
                                        <input type="text" id="complaint_date" class="form-control pull-right datepicker" />
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary">บันทึกส่งต่อเรื่องร้องทุกข์</button>
                </div>
            </div>
        </div>
    </div>
</div>
