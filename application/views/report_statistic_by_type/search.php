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
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ปีที่ร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                            $list_year_arr = @$list_year;
                                            $list_year_arr[''] = '--ไม่ระบุ--';
                                            ksort($list_year_arr);
                                            echo form_dropdown([
                                                'id' => 'year',
                                                'class' => 'form-control',
                                            ], $list_year_arr, $_GET['year']);
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ประเภทเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $complain_type_arr = @$complain_type;
                                        $complain_type_arr[''] = '--ไม่ระบุ--';
                                        ksort($complain_type_arr);
                                        echo form_dropdown([
                                            'id' => 'complain_type_id',
                                            'class' => 'form-control',
                                        ], $complain_type_arr, $_GET['complain_type_id']);
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ภาค :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $area_part_arr = @$area_part_list;
                                        $area_part_arr[''] = '--ไม่ระบุ--';
                                        ksort($area_part_arr);
                                        echo form_dropdown([
                                            'id' => 'partid',
                                            'class' => 'form-control',
                                        ], $area_part_arr, $_GET['partid']);
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        จังหวัด :
                                    </label>
                                    <label class="col-sm-7">
                                        <?php
                                        $province_arr = @$province_list;
                                        $province_arr[''] = '--ไม่ระบุ--';
                                        ksort($province_arr);
                                        echo form_dropdown([
                                            'id' => 'province_id',
                                            'class' => 'form-control',
                                            'onchange'=>"get_district(this.value,'')"
                                        ], $province_arr, $_GET['province_id']);
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        อำเภอ :
                                    </label>
                                    <label class="col-sm-7">
                                        <span id="district_span">
                                        <?php
                                        $district_arr = @$district_list;
                                        $district_arr[''] = '--ไม่ระบุ--';
                                        ksort($district_arr);
                                        echo form_dropdown([
                                            'id' => 'district_id',
                                            'class' => 'form-control',
                                            'onchange'=>"get_subdistrict(this.value,'')"
                                        ], $district_arr, $_GET['district_id']);
                                        ?>
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        ตำบล :
                                    </label>
                                    <label class="col-sm-7">
                                        <span id="subdistrict_span">
                                            <?php
                                            $subdistrict_arr = @$subdistrict_list;
                                            $subdistrict_arr[''] = '--ไม่ระบุ--';
                                            ksort($subdistrict_arr);
                                            echo form_dropdown([
                                                'name' => 'address_id',
                                                'id' => 'address_id',
                                                'class' => 'form-control'
                                            ], $subdistrict_arr, $_GET['address_id']);
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
                    <button type="button" name="btSearchType" id="btSearchType" class="btn btn-primary">ค้นหาข้อมูล</button>
                    <button type="button" name="btClearType" id="btClearType" class="btn btn-default" data-dismiss="modal">ล้างค่า</button>
                </div>
            </div>
        </div>
    </div>
</div>
