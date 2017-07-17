<div class="example-modal">
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ค้นหาข้อมูล</h4>
                </div>
                <form class="form-horizontal" role="form" method="GET" action="" name="form_search" id="form_search">
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
                                            <input type="text" name="complaint_date_start" id="complaint_date_start" class="form-control pull-right datepickerstart" />
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
                                            <input type="text" name="complaint_date_end" id="complaint_date_end" class="form-control pull-right datepickerend" />
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
                                        <?php
                                        $dd1 = $complaint_type;
                                        $dd1[''] = '--ไม่ระบ--ุ';
                                        ksort($dd1);
                                        echo form_dropdown([
                                            'name' => 'complain_type_id',
                                            'id' => 'complain_type_id',
                                            'class' => 'form-control'
                                        ], $dd1, '');
                                        ?>
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
                                        <?php
                                        $dd2 = $channel;
                                        $dd2[''] = '--ไม่ระบุ--';
                                        ksort($dd2);
                                        echo form_dropdown([
                                            'name' => 'channel_id',
                                            'id' => 'channel_id',
                                            'class' => 'form-control'
                                        ], $dd2, '');
                                        ?>
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
                                        <?php
                                        $province_arr = $province_list;
                                        $province_arr[''] = 'กรุณาเลือก';
                                        ksort($province_arr);
                                        echo form_dropdown([
                                            'id' => 'province_id',
                                            'name'=>'province_id',
                                            'class' => 'form-control',
                                            'onchange'=>"get_district(this.value,'')"
                                        ], $province_arr, @$province_id);
                                        ?>
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
                                        <span id="district_span">
                                            <?php
                                            $district_arr = @$district_list;
                                            $district_arr[''] = 'กรุณาเลือก';
                                            ksort($district_arr);
                                            echo form_dropdown([
                                                'id' => 'district_id',
                                                'name'=>'district_id',
                                                'class' => 'form-control',
                                                'onchange'=>"get_subdistrict(this.value,'')"
                                            ], $district_arr, @$district_id);
                                            ?>
                                        </span>
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
                                        <span id="subdistrict_span">
                                            <?php
                                            $subdistrict_arr = @$subdistrict_list;
                                            $subdistrict_arr[''] = 'กรุณาเลือก';
                                            ksort($subdistrict_arr);
                                            echo form_dropdown([
                                                'id' => 'subdistrict_id',
                                                'name' => 'subdistrict_id',
                                                'class' => 'form-control'
                                            ], $subdistrict_arr, @$subdistrict_id);
                                            ?>
                                        </span>
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
