<div class="example-modal">
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ค้นหาข้อมูล</h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="" name="form_search" id="form_search">
                <div class="modal-body" style="margin-left: -30px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        วันที่ร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" id="complaint_date_start" class="form-control pull-right datepickerstart" />
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="col-sm-1 text-right">
                                        ถึง
                                    </label>
                                    <label class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" id="complaint_date_end" class="form-control pull-right datepickerend" />
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ประเภทเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <select class="form-control">
                                            <option value=''>--ไม่ระบุ--</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ช่องทางร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <select class="form-control">
                                            <option value=''>--ไม่ระบุ--</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ภาค :
                                    </label>
                                    <label class="col-sm-7">
                                        <select class="form-control">
                                            <option value=''>--ไม่ระบุ--</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        จังหวัด :
                                    </label>
                                    <label class="col-sm-7">
                                        <select class="form-control">
                                            <option value=''>--ไม่ระบุ--</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        อำเภอ :
                                    </label>
                                    <label class="col-sm-7">
                                        <select class="form-control">
                                            <option value=''>--ไม่ระบุ--</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ตำบล :
                                    </label>
                                    <label class="col-sm-7">
                                        <select class="form-control">
                                            <option value=''>--ไม่ระบุ--</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" name="btSearch" id="btSearch" class="btn btn-primary">ค้นหาข้อมูล</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ล้างค่า</button>
                </div>
            </div>
        </div>
    </div>
</div>
