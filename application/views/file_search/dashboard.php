<?php
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
<div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
$link = array(
    'src' => 'assets/js/file_search_dashboard.js',
    'type' => 'text/javascript'
);
echo script_tag($link);

$this->load->view('file_search/search');
?>
<style>
    .edit.dropdown-menu {
        min-width: 80px !important;
        left: 50%;
        right: auto;
        text-align: center;
        transform: translate(-50%, 0);
        background-color: rgba(255, 255, 255, 0.9);
    }

    .a, .edit.dropdown-menu {
        width: 30px;
        margin-top: -5px;
        font-size: 1em;
        cursor: pointer;
    }

    td.open {
        cursor: pointer;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> ค้นหาเอกสาร</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <span><?php echo $txtDetail; ?></span>
                        </div>
                        <div class="col-md-5 text-right" style="margin-bottom: 5px;padding-right:0;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#search">
                                <i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;ค้นหาขั้นสูง
                            </button>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">ลำดับ</th>
                            <th width="10%" class="text-center">เลขที่</th>
                            <th width="13%" class="text-center">รายการเอกสาร</th>
                            <th width="12%" class="text-center">วันที่ร้องเรียน</th>
                            <th width="20%" class="text-center">ประเภทเรื่อง</th>
                            <th width="15%" class="text-center">สถานที่เกิดเหตุ</th>
                            <th width="10%" class="text-center">ผู้ร้องทุกข์</th>
                            <th width="18%" class="text-center">สถานะ</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($data) > 0) {
                            foreach ($data AS $val) {
                                if(count(@$val['attach_file'])==0){continue;}
                                if (@$val['user_complain_type_id'] == '2') {
                                    $user_complain = @$val['prename']['prename'] . $val['first_name'] . '   ' . $val['last_name'];
                                } else {
                                    $user_complain = 'ไม่ประสงค์ออกนาม';
                                }
                                $complain_date = (@$val['complain_date'] != '' && @$val['complain_date'] != '0000-00-00') ? date_thai(@$val['complain_date'], true) : '';
                                ?>
                                <tr>
                                    <td class="text-center open"><?php echo $start_row++; ?></td>
                                    <td class="open"><?php echo @$val['complain_no']; ?></td>
                                    <td class="open text-right"><?php
                                        if(count(@$val['attach_file'])=='0'){
                                            echo count(@$val['attach_file']);
                                        }else{ ?>
                                            <a data-toggle="modal" data-target="#show_file" onclick="getFileData('<?php echo $val['keyin_id']; ?>')"><?php echo count(@$val['attach_file']); ?></a>
                                        <?php } ?></td>
                                    <td class="text-center open"><?php echo $complain_date; ?></td>
                                    <td class="open"><?php foreach($val['complain_type'] as $key => $value){
                                            echo $complain_type_all[$value];
                                        }?></td>
                                    <td class="open"></td>
                                    <td class="open"><?php echo $user_complain; ?></td>
                                    <td class="open text-center">
                                        <?php
                                        if (@$val['current_status'][0]['current_status_id'] == '1') {
                                            $bg = '#dd4b39';
                                        } elseif (@$val['current_status'][0]['current_status_id'] == '2') {
                                            $bg = '#f39c12';
                                        } elseif (@$val['current_status'][0]['current_status_id'] == '3') {
                                            $bg = '#0073b7';
                                        } elseif (@$val['current_status'][0]['current_status_id'] == '4') {
                                            $bg = '#00a65a';
                                        } else {
                                            $bg = '#848484';
                                        }
                                        echo '<span class="label" style="background:' . $bg . ';">' . @$val['current_status'][0]['current_status_name'] . '</span>'
                                        ?>
                                    </td>

                                </tr>
                                <?php
                            }
                        } else {
                            echo '<td colspan="7" class="text-center">ไม่พบข้อมูล</td>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="example-modal">
    <div class="modal fade" id="show_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">รายการเอกสารแนบ</h4>
                </div>
                <div id="show_file_space" class="modal-body" style="margin-left: -30px;">

                </div>
                <div class="modal-footer" style="text-align: center;">
                </div>
            </div>
        </div>
    </div>
</div>
