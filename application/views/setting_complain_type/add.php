
<!--<form class="form-horizontal" role="form" method="POST" action="--><?php //echo base_url('setting_complain_type/dashboard')?><!--" name="form_add" id="form_add">-->
    <style>
        .btn-info {
            background-color: #4db6ac;
            border-color: #4db6ac;
        }
        .btn-info.hover{background-color:#4db6ac}
    </style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">เพิ่ม/แก้ไขข้อมูลประเภทเรื่องร้องทุกข์</h3>
                    </div>
                    <div class="box-body"  style="height: 400px;">
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="col-sm-5 text-right">
                                            รหัสประเภทเรื่องร้องทุกข์ :
                                        </label>
                                        <label class="col-sm-3">
                                            <input type="hidden" id="action"  value="<?php echo @$data['action'];?>"/>
                                            <input type="text" name="complain_type_id" id="complain_type_id" class="form-control" value="<?php echo @$data['complain_type_id'];?>" readonly="readonly" />
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
                                            ประเภทเรื่องร้องทุกข์ :
                                        </label>
                                        <label class="col-sm-7">
                                            <input type="text" name="complain_type_name" id="complain_type_name" class="form-control" value="<?php echo @$data['complain_type_name'];?>" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-info" title="เพิ่ม" id="bt_add"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                                <button class="btn btn-info" title="ยกเลิก" id="bt_cancel"  onclick="window.location.href='<?php echo base_url();?>setting_complain_type/dashboard'"><i class="fa fa-times"></i> ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="base_url" class="<?php echo base_url();?>"></div>
<!--</form>-->
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/setting_complain_type.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>