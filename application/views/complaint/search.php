<div class="example-modal">
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ค้นหาข้อมูล</h4>
                </div>
                <form class="form-horizontal" method="GET" action="<?php base_url("complaint/dashboard");?>" name="form_search" id="form_search">
                <div class="modal-body" style="margin-left: -30px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        เลขที่เรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <input type="text" name="complain_no" class="form-control" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5  text-right">
                                        ชื่อผู้ร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <input type="text" name="petitioner" class="form-control">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5  text-right">
                                        เรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <input type="text" name="complaint_detail" class="form-control" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5  text-right">
                                        ประเภทเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $i = 0;
                                        foreach($complain_type as $key => $value){ ?>
                                        <span id="complain_type_space_<?php echo $i; ?>">
                        <?php
                        $i++;
                        $complain_type_list = $complain_type[$key];
                        $complain_type_list[''] = 'กรุณาเลือก';
                        ksort($complain_type_list);
                        echo form_dropdown([
                            'id' => 'complain_type_'.$i,
                            'class' => 'form-control',
                            'has_child'=>'complain_type_space_'.$i,
                            'onchange' => 'get_complain_type_child(this)'
                        ], $complain_type_list, $get_complain_type[$key]);
                        }
                        ?>
                                            <span id="complain_type_space_<?php echo $i; ?>">

                        </span>
                                            <?php
                                            foreach($complain_type as $key => $value){
                                                echo"</span>";
                                            }
                                            ?>
                                            <input type="hidden" name="complain_type_id" id="complain_type_id" value="<?php echo @$key_in_data['complain_type_id']; ?>">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5  text-right">
                                        ช่องทางร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $dd2 = $channel;
                                        $dd2[''] = 'กรุณาเลือก';
                                        ksort($dd2);
                                        echo form_dropdown([
                                            'name' => 'channel_id',
                                            'id' => 'channel_id',
                                            'class' => 'form-control'
                                        ], $dd2, @$key_in_data['channel_id']);
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
                                    <label class="col-sm-5  text-right">
                                        ลักษณะเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $dd3 = $subject;
                                        $dd3[''] = 'กรุณาเลือก';
                                        ksort($dd3);
                                        echo form_dropdown([
                                            'name' => 'subject_id',
                                            'id' => 'subject_id',
                                            'class' => 'form-control'
                                        ], $dd3, @$key_in_data['subject_id']);
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
                                    <label class="col-sm-5  text-right">
                                        สถานะรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $dd4 = $current_status;
                                        $dd4[''] = 'กรุณาเลือก';
                                        ksort($dd4);
                                        echo form_dropdown([
                                            'name' => 'current_status',
                                            'id' => 'current_status',
                                            'class' => 'form-control'
                                        ], $dd4, @$key_in_data['current_status']);
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
                                    <label class="col-sm-5  text-right">
                                        จังหวัด :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $province_arr = $province_list;
                                        $province_arr[''] = 'กรุณาเลือก';
                                        ksort($province_arr);
                                        echo form_dropdown([
                                            'name' => 'province_id',
                                            'id' => 'province_id',
                                            'class' => 'form-control',
                                            'onchange'=>"get_district(this.value,'')"
                                        ], $province_arr, '');
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
                                    <label class="col-sm-5  text-right">
                                        อำเภอ :
                                    </label>
                                    <label class="col-sm-7">
                                    <span id="district_span">
                                        <?php
                                        $district_arr = $district_list;
                                        $district_arr[''] = 'กรุณาเลือก';
                                        ksort($district_arr);
                                        echo form_dropdown([
                                            'name' => 'district_id',
                                            'id' => 'district_id',
                                            'class' => 'form-control',
                                            'onchange'=>"get_subdistrict(this.value,'')"
                                        ], $district_arr, '');
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
                                    <label class="col-sm-5  text-right">
                                        ตำบล :
                                    </label>
                                    <label class="col-sm-7">
                                    <span id="subdistrict_span">
                                        <?php
                                        $subdistrict_arr = @$subdistrict_list;
                                        $subdistrict_arr[''] = 'กรุณาเลือก';
                                        ksort($subdistrict_arr);
                                        echo form_dropdown([
                                            'name' => 'address_id',
                                            'id' => 'address_id',
                                            'class' => 'form-control'
                                        ], $subdistrict_arr, '');
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
                                        วันที่ร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" id="complaint_date_start" name="complaint_date_start" class="form-control pull-right datepicker" />
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
                                            <input type="text" id="complaint_date_end" name="complaint_date_end" class="form-control pull-right datepicker" />
                                        </div>
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
