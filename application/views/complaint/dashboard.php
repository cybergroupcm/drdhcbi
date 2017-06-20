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
<div>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                            <button type="button" class="btn btn-default fa fa-bullhorn"> แจ้งเบาะแสการทำผิด</button>
                            <button type="button" class="btn btn-default fa fa-truck"> ยานพาหนะ</button>
                            <button type="button" class="btn btn-primary fa fa-filter" data-toggle="modal" data-target="#filter"> กรองข้อมูล</button>
                            <button type="button" class="btn btn-info fa fa-search" data-toggle="modal" data-target="#search"> ค้นหาข้อมูล</button>
                        </div>
                        <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                            <button type="button" class="btn btn-success fa fa-save " id="bt_add"  href="#"​​​​​> บันทึกเรื่องร้องทุกข์</button>
                            <button type="button" class="btn btn-success fa fa-print"> สั่งพิมพ์</button>
                        </div>
                        <table id="example1" class="table table-bordered table-striped table-hover"">
                            <tr>
                                <th width="5%" class="text-center">ลำดับ</th>
                                <th width="15%" class="text-center">เลขที่เรื่องร้องทุกข์</th>
                                <th width="30%" class="text-center">หัวข้อเรื่องร้องทุกข์</th>
                                <th width="20%" class="text-center">ผู้ร้องทุกข์</th>
                                <th width="15%" class="text-center">วันที่ร้องเรียน</th>
                                <th width="15%" class="text-center">จัดการ</th>
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
                                    <td><?php echo $val['req_title'];?></td>
                                    <td><?php echo $val['req_name'];?></td>
                                    <td><?php echo $val['req_date'];?></td>
                                    <td class="text-center">
                                        <?php
                                            echo img(array('src'=>'assets/images/edit.png', 'title'=> 'แก้ไข','width'=>'36px','style'=>'cursor:pointer'));
                                            echo img(array('src'=>'assets/images/edit-article.png', 'title'=> 'ดูรายละเอียด','width'=>'36px','style'=>'cursor:pointer'));
                                            echo img(array('src'=>'assets/images/circle-save.png', 'title'=> 'รับเรื่อง','width'=>'36px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#received'));
                                            echo img(array('src'=>'assets/images/send.png', 'title'=> 'ส่งเรื่องต่อ','width'=>'36px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#send'));
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>