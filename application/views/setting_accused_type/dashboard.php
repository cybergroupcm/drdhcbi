<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
'src' => 'assets/js/setting_accused_type.js',
'type' => 'text/javascript'
);
echo script_tag($link);

$link = array(
    'href' => 'assets/css/dataTables.bootstrap.min.css',
    'rel' => 'stylesheet',
    'type' => 'text/css'
);
echo link_tag($link);
$link = array(
    'src' => 'assets/js/jquery.dataTables.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/dataTables.bootstrap.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
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
                        <h3 class="box-title">ตั้งค่าข้อมูลประเภทผู้ถูกร้องเรียน</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12 text-right" style="margin-bottom: 5px;padding-right: 0px;">
                            <?php
                            @$param_add = "?type=".$_GET['type']."&parent_id=".$_GET['parent_id'];
                            @$param_back = "?type=".$_GET['type']."&parent_id=".$data_parent['parent_id'];
                            ?>
                            <button class="btn btn-info" title="เพิ่ม" id="bt_add_data" onclick="window.location.href='<?php echo base_url('setting_accused_type/add'.$param_add)?>';"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                            <?php  if(@$_GET['type'] == 'parent'){?>
                                <button class="btn btn-info" title="ย้อนกลับ" id="bt_add_data" onclick="window.location.href='<?php echo base_url('setting_accused_type/dashboard'.$param_back)?>';"><i class="fa fa-reply"></i> ย้อนกลับ</button>
                            <?php }else{?>
                                <button class="btn btn-info" title="ย้อนกลับ" id="bt_add_data" onclick="window.location.href='<?php echo base_url('setting_system')?>';"><i class="fa fa-reply"></i> ย้อนกลับ</button>
                            <?php } ?>
                        </div>
                        <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th width="20%" class="text-center">รหัสประเภทผู้ถูกร้องเรียน</th>
                                    <th class="text-center">ประเภทผู้ถูกร้องเรียน</th>
                                    <th width="15%" class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //echo @$data_parent['parent_id'].'<hr>';
                            if(!@$data['message']) {
                                $start_row = 1;
                                foreach($data AS $val) {
                                    $link_data = 'onclick="window.location.href=\'' . base_url('setting_accused_type/dashboard?type=parent&parent_id=' . @$val['accused_type_id']) . '\'"';
                                    $link_data .= 'style="cursor: pointer;"';
                                    ?>
                                    <tr>
                                        <td class="text-center" <?php echo @$link_data; ?>><?php echo $start_row++; ?></td>
                                        <td class="text-center" <?php echo @$link_data; ?>><?php echo $val['accused_type_id'];?></td>
                                        <td <?php echo @$link_data; ?>><?php echo $val['accused_type'];?></td>
                                        <td class="text-center">
                                            <span onclick="window.location.href='<?php echo base_url('setting_accused_type/add/'.$val['accused_type_id'].$param_add)?>';">
                                                <i class="fa fa-pencil" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;" title="แก้ไข"></i>
                                            </span>
                                            <span class="bt_delete" id="<?php echo $val['accused_type_id'];?>" onclick="bt_delete(<?php echo $val['accused_type_id'];?>)">
                                                <i class="fa fa-trash" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;" title="ลบ"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div id="base_url" class="<?php echo base_url();?>"></div>
