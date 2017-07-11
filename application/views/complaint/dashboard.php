<?php
$link = array(
    'src' => 'assets/js/complaint_dashboard.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$this->load->view('complaint/search');
$this->load->view('complaint/filter');
$this->load->view('complaint/received');
$this->load->view('complaint/send');
$this->load->view('complaint/save_result');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> บันทึกข้อมูลเรื่องร้องทุกข์</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <?php
                        echo img(array('src' => 'assets/images/filter.png', 'title' => 'กรองข้อมูล', 'width' => '48px', 'style' => 'cursor:pointer', 'data-toggle' => 'modal', 'data-target' => '#filter'));
                        echo img(array('src' => 'assets/images/search.png', 'title' => 'ค้นหาข้อมูล', 'width' => '48px', 'style' => 'cursor:pointer', 'data-toggle' => 'modal', 'data-target' => '#search'));
                        echo img(array('src' => 'assets/images/save.png', 'title' => 'บันทึกเรื่องร้องทุกข์', 'width' => '48px', 'style' => 'cursor:pointer', 'id' => 'bt_add'));
                        echo img(array('src' => 'assets/images/print.png', 'title' => 'สั่งพิมพ์', 'width' => '48px', 'style' => 'cursor:pointer'));
                        ?>
                    </div>
                    <?php
                    /*echo '<pre>';
                    print_r($data);
                    echo '</pre>';*/
                    ?>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">ลำดับ</th>
                            <th width="10%" class="text-center">เลขที่<br>เรื่องร้องทุกข์</th>
                            <th width="12%" class="text-center">วันที่ร้องเรียน</th>
                            <th width="20%" class="text-center">หัวข้อเรื่องร้องทุกข์</th>
                            <th width="15%" class="text-center">ผู้ร้องทุกข์</th>
                            <th width="10%" class="text-center">สถานะภาพ<br>เรื่องร้องทุกข์</th>
                            <th width="18%" class="text-center">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if( $action_mode['edit'] == 1 ){ $displayEdit = ''; }else{ $displayEdit = ' display:none; '; }
                        if( $action_mode['delete'] == 1 ){ $displayDelete = ''; }else{ $displayDelete = ' display:none; '; }
                        if( $action_mode['receive'] == 1 ){ $displayReceive = ''; }else{ $displayReceive = ' display:none; '; }
                        if( $action_mode['send'] == 1 ){ $displaySend = ''; }else{ $displaySend = ' display:none; '; }
                        if( $action_mode['finish'] == 1 ){ $displayFinish = ''; }else{ $displayFinish = ' display:none; '; }
                        if (count($data) > 0) {
                            foreach ($data AS $val) {
                                if($val['user_complain_type_id']== '2'){
                                    $user_complain = @$val['prename']['prename'].$val['first_name'].'   '.$val['last_name'];
                                }else{
                                    $user_complain = 'ไม่ประสงค์ออกนาม';
                                }
                                $complain_date =($val['complain_date'] !='' && $val['complain_date'] !='0000-00-00')?date_thai($val['complain_date'], true):'';
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $start_row++; ?></td>
                                    <td><?php echo $val['complain_no']; ?></td>
                                    <td class="text-center"><?php echo $complain_date; ?></td>
                                    <td><?php echo $val['complaint_detail']; ?></td>
                                    <td><?php echo $user_complain; ?></td>
                                    <td><?php echo @$val['current_status'][0]['current_status_name'];?></td>
                                    <td class="text-center">
                                        <?php
                                        if($val['current_status_id'] == '1') {
                                        ?>
                                        <span onclick="window.location.href='<?php echo base_url('complaint/key_in/' . $val['keyin_id']) ?>';">
                                            <?php echo img(array('src' => 'assets/images/edit.png', 'title' => 'แก้ไข', 'width' => '36px', 'style' => 'cursor:pointer;'.$displayEdit)); ?>
                                        </span>
                                        <span class="bt_delete" id="<?php echo $val['keyin_id']; ?>"
                                              onclick="bt_delete(<?php echo $val['keyin_id']; ?>)">
                                        <?php echo img(array('src' => 'assets/images/bin.png', 'title' => 'ลบ', 'width' => '36px', 'style' => 'cursor:pointer;'.$displayDelete)); ?>
                                        </span>
                                        <?php
                                        }else{
                                            echo img(array('src' => 'assets/images/edit_mono.png', 'title' => 'แก้ไข', 'width' => '36px', 'style' => 'cursor:pointer;'.$displayEdit));
                                            echo img(array('src' => 'assets/images/bin_mono.png', 'title' => 'ลบ', 'width' => '36px', 'style' => 'cursor:pointer;'.$displayDelete));
                                        }
                                        ?>
                                        <span onclick="window.location.href='<?php echo base_url('complaint/view_detail/' . $val['keyin_id']) ?>';">
                                            <?php echo img(array('src' => 'assets/images/edit-article.png', 'title' => 'ดูรายละเอียด', 'width' => '36px', 'style' => 'cursor:pointer')); ?>
                                        </span>
                                      <?php
                                        if($val['current_status_id'] == '1') {
                                            echo img(array('src' => 'assets/images/circle-save.png', 'title' => 'รับเรื่อง', 'width' => '36px', 'style' => 'cursor:pointer;'.$displayReceive, 'data-toggle' => 'modal', 'data-target' => '#received', 'id' => $val['keyin_id']));
                                        }elseif($val['current_status_id'] == '2') {
                                            echo img(array('src' => 'assets/images/send.png', 'title' => 'ส่งเรื่องต่อ', 'width' => '36px', 'style' => 'cursor:pointer;'.$displaySend, 'data-toggle' => 'modal', 'data-target' => '#send', 'id' => $val['keyin_id']));
                                        }else{
                                            echo img(array('src' => 'assets/images/save_result.png', 'title' => 'บันทึกผลการดำเนินการ', 'width' => '36px', 'style' => 'cursor:pointer;'.$displayFinish, 'data-toggle' => 'modal', 'data-target' => '#save_result', 'id' => $val['keyin_id']));
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {
                            echo '<td colspan="7" class="text-center">ไม่พบข้อมูล</td>';

                        }
                        ?>
                        </tbody>
                    </table>
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url(); ?>"></div>
