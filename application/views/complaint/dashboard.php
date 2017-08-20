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
$link = array(
    'src' => 'assets/js/complaint_dashboard.js',
    'type' => 'text/javascript'
);
echo script_tag($link);

$this->load->view('complaint/search');
//$this->load->view('complaint/filter');
$this->load->view('complaint/received');
$this->load->view('complaint/send');
$this->load->view('complaint/save_result');
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
                    <h3 class="box-title"> บันทึกข้อมูลเรื่องร้องทุกข์</h3>
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
                            <button type="button" class="btn btn-primary" id="bt_add">
                                <i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;เพิ่มเรื่องร้องทุกข์
                            </button>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">ลำดับ</th>
                            <th width="10%" class="text-center">เลขที่</th>
                            <th width="12%" class="text-center">วันที่ร้องเรียน</th>
                            <th width="20%" class="text-center">เรื่องร้องทุกข์</th>
                            <th width="15%" class="text-center">ผู้ร้องทุกข์</th>
                            <th width="10%" class="text-center">สถานะ</th>
                            <th width="18%" class="text-center">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($action_mode['edit'] == 1) {
                            $displayEdit = '';
                        } else {
                            $displayEdit = ' display:none; ';
                        }
                        if ($action_mode['delete'] == 1) {
                            $displayDelete = '';
                        } else {
                            $displayDelete = ' display:none; ';
                        }
                        if ($action_mode['receive'] == 1) {
                            $displayReceive = '';
                        } else {
                            $displayReceive = ' display:none; ';
                        }
                        if ($action_mode['send'] == 1) {
                            $displaySend = '';
                        } else {
                            $displaySend = ' display:none; ';
                        }
                        if ($action_mode['finish'] == 1) {
                            $displayFinish = '';
                        } else {
                            $displayFinish = ' display:none; ';
                        }
                        if (count($data) > 0) {
                            foreach ($data AS $val) {
                                if (@$val['user_complain_type_id'] == '2') {
                                    $user_complain = @$val['prename']['prename'] . $val['first_name'] . '   ' . $val['last_name'];
                                } else {
                                    $user_complain = 'ไม่ประสงค์ออกนาม';
                                }
                                $complain_date = (@$val['complain_date'] != '' && @$val['complain_date'] != '0000-00-00') ? date_thai(@$val['complain_date'], true) : '';
                                ?>
                                <tr id="<?php echo @$val['keyin_id']; ?>">
                                    <td class="text-center open"><?php echo $start_row++; ?></td>
                                    <td class="open"><?php echo @$val['complain_no']; ?></td>
                                    <td class="text-center open"><?php echo $complain_date; ?></td>
                                    <td class="open"><?php echo @$val['complaint_detail']; ?></td>
                                    <td class="open"><?php echo $user_complain; ?></td>
                                    <td class="open">
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
                                    <td class="text-center">
                                        <?php
                                        if (@$val['current_status_id'] == '5') {
                                            echo '-';
                                        } else {
                                            if($val['current_status_id'] != '4'){
                                        ?>
                                                <span class="dropdown">
                                            <span class="dropdown-toggle glyphicon glyphicon-cog" data-toggle="dropdown"
                                                  data-hover="dropdown"
                                                  style="cursor: pointer;font-size: 1.5em;"></span>
                                            <ul class="edit dropdown-menu" style="width: 50px !important;">
                                                <?php
                                                if (@$val['step'] == '') {
                                                    $step = '1';
                                                } else {
                                                    $step = @$val['step'];
                                                }
                                                if (@$val['current_status_id'] == '1') {
                                                    echo '<li><a href="' . base_url('complaint/key_in/key_in_step' . ($step + 1) . '/' . @$val['keyin_id']) . '">แก้ไข</a></li>';
                                                    echo '<li><a onclick="bt_delete(' . @$val['keyin_id'] . ');">ยกเลิก</a></li>';
                                                } else {
                                                    if (@$val['current_status_id'] == '1') {
                                                        echo '<li><a>แก้ไข</a></li>';
                                                    }
                                                    echo '<li><a onclick="bt_delete(' . @$val['keyin_id'] . ');">ยกเลิก</a></li>';
                                                }
                                                ?>
                                            </ul>
                                        </span>
                                        <?php } ?>
                                        <?php } ?>
                                        <span>
                                      <?php
                                      if (@$val['current_status_id'] == '1') {
                                          echo '<i class="fa fa-inbox open-received" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;' . $displayReceive . '" data-toggle="modal" data-target="#received" data-id="' . @$val['keyin_id'] . '"></i>';
                                      } elseif (@$val['current_status_id'] == '2') {
                                          echo '<i class="fa  fa-send open-send" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;' . $displaySend . '" data-toggle="modal" data-target="#send" data-id="' . @$val['keyin_id'] . '"></i>';
                                      } elseif (@$val['current_status_id'] == '3' || @$val['current_status_id'] == '4') {
                                          echo '<i class="fa fa-gavel open-result" aria-hidden="true" style="cursor: pointer;font-size: 1.5em;' . $displayFinish . '" data-toggle="modal" data-target="#save_result" data-id="' . @$val['keyin_id'] . '"></i>';
                                      } else {
                                          echo '';
                                      }
                                      ?>
                                            </span>
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
<div id="base_url" class="<?php echo base_url(); ?>"></div>
