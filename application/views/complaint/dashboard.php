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
                        echo img(array('src'=>'assets/images/filter.png', 'title'=> 'กรองข้อมูล','width'=>'48px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#filter'));
                        echo img(array('src'=>'assets/images/search.png', 'title'=> 'ค้นหาข้อมูล','width'=>'48px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#search'));
                        echo img(array('src'=>'assets/images/save.png', 'title'=> 'บันทึกเรื่องร้องทุกข์','width'=>'48px','style'=>'cursor:pointer','id'=>'bt_add'));
                        echo img(array('src'=>'assets/images/print.png', 'title'=> 'สั่งพิมพ์','width'=>'48px','style'=>'cursor:pointer'));
                        ?>
                    </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
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
                        $runno = 0;
                        foreach($arr_data AS $val) {
                            $runno++;
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $runno;?></td>
                                <td><?php echo $val['req_id'];?></td>
                                <td class="text-center"><?php echo date_thai($val['req_date'],true);?></td>
                                <td><?php echo $val['req_title'];?></td>
                                <td><?php echo $val['req_name'];?></td>
                                <td><?php //echo $val['req_status'];?></td>
                                <td class="text-center">
                                        <span onclick="window.location.href='<?php echo base_url('complaint/key_in/'.$val['req_id'])?>';">
                                            <?php echo img(array('src'=>'assets/images/edit.png', 'title'=> 'แก้ไข','width'=>'36px','style'=>'cursor:pointer'));?>
                                        </span>
                                        <span class="bt_delete" id="<?php echo $val['req_id'];?>" onclick="bt_delete(<?php echo $val['req_id'];?>)">
                                            <?php echo img(array('src'=>'assets/images/bin.png', 'title'=> 'ลบ','width'=>'36px','style'=>'cursor:pointer'));?>
                                        </span>
                                        <span onclick="window.location.href='<?php echo base_url('complaint/view_detail/'.$val['req_id'])?>';">
                                            <?php echo img(array('src'=>'assets/images/edit-article.png', 'title'=> 'ดูรายละเอียด','width'=>'36px','style'=>'cursor:pointer'));?>
                                        </span>
                                    <?php
                                    echo img(array('src'=>'assets/images/circle-save.png', 'title'=> 'รับเรื่อง','width'=>'36px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#received','id'=>$val['keyin_id']));
                                    echo img(array('src'=>'assets/images/send.png', 'title'=> 'ส่งเรื่องต่อ','width'=>'36px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#send','id'=>$val['keyin_id']));
                                    ?>
                                </td>
                            </tr>
                            <?php
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
<div id="base_url" class="<?php echo base_url();?>"></div>
