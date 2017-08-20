<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/setting_wish.js',
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
                        <h3 class="box-title">ตั้งค่าข้อมูลความประสงค์</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12 text-right" style="margin-bottom: 5px;padding-right: 0px;">
                            <button class="btn btn-info" title="เพิ่ม" id="bt_add_data" onclick="window.location.href='<?php echo base_url('setting_wish/add')?>';"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                            <button class="btn btn-info" title="ย้อนกลับ" id="bt_add_data" onclick="window.location.href='<?php echo base_url('setting_system')?>';"><i class="fa fa-reply"></i> ย้อนกลับ</button>
                        </div>
                        <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">ลำดับ</th>
                                    <th width="20%" class="text-center">รหัสความประสงค์</th>
                                    <th class="text-center">ความประสงค์</th>
                                    <th width="15%" class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!@$data['message']) {
                                $start_row = 1;
                                foreach($data AS $val) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $start_row++; ?></td>
                                        <td class="text-center"><?php echo $val['wish_id'];?></td>
                                        <td><?php echo $val['wish_name'];?></td>
                                        <td class="text-center">
                                            <span onclick="window.location.href='<?php echo base_url('setting_wish/add/'.$val['wish_id'])?>';">
                                                <i class="fa fa-pencil" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;" title="แก้ไข"></i>
                                            </span>
                                            <span class="bt_delete" id="<?php echo $val['wish_id'];?>" onclick="bt_delete(<?php echo $val['wish_id'];?>)">
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
