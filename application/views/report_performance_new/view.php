<?php
$link = array(
    'src' => 'template/plugins/flot/jquery.flot.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'template/plugins/flot/jquery.flot.resize.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'template/plugins/flot/jquery.flot.pie.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'template/plugins/flot/jquery.flot.categories.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/report.js',
    'type' => 'text/javascript'
);
echo script_tag($link);

$this->load->view('report_result_progress/search');

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">แบบรายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด  (เรื่องใหม่)</h3>
                </div>
                <div class="col-xs-12 text-left">
                    จังหวัดชลบุรี ประจำเดือนกรกฎาคม 2560
                </div>
                <div class="box-body">
                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <?php
                            $param_pdf = "?year=".$_GET['year']."&current_status_id=".$_GET['complain_type_id']."&partid=".$_GET['partid']."&province_id=".$_GET['province_id']."&district_id=".$_GET['district_id']."&address_id=".$_GET['address_id'];
                        ?>
                            <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล">
                                <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                            <a href="<?php echo base_url('report_performance_new/pdf'.$param_pdf); ?>" class="btn btn-default" role="button"  title="สั่งพิมพ์" target="_blank">
                                <i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                            <a href="<?php echo base_url('report_performance_new/excel'.$param_pdf); ?>" class="btn btn-default" role="button" title="ส่งออก Excel" target="_blank">
                                <i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ที่</th>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo count(@$complaint_type);?>">ผลการดำเนินการในเดือนที่รายงาน</th>
                            <th class="text-center" style="vertical-align: middle;width: 6%;" rowspan="2">รวมทั้งสิ้น</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo count(@$complaint_type);?>">ผลการดำเนินการสะสม</th>
                            <th class="text-center" style="vertical-align: middle;width: 6%;" rowspan="2">รวมทั้งสิ้น</th>
                        </tr>
                        <tr>
                            <?php
                            $int_type = 0;
                            foreach($complaint_type AS $type_name){
                                $int_type++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$int_type.'.'.$type_name.'</th>';
                            }
                            ?>
                            <?php
                            $int_type = 0;
                            foreach($complaint_type AS $type_name){
                                $int_type++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$int_type.'.'.$type_name.'</th>';
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>2</td>
                            <td colspan="<?php echo (count(@$complaint_type)*2)+3;?>">เรื่องร้องเรียนที่ได้รับดำเนินการในปีงบประมาณ พ.ศ.๒๕๖๐  และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.๒๕๖๐</td>
                          </tr>
                          <tr>
                            <td></td>
                            <td> - เรื่องรับเข้าใหม่ปีงบฯ ๖๐ ดังนี้</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">&nbsp;</td>';
                            }
                            ?>
                            <td></td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">&nbsp;</td>';
                            }
                            ?>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>ค้างเดือนก่อนหน้า</td>
                            <?php
                            $sum_outstanding_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_outstanding_month += $outstanding_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($outstanding_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_outstanding_month);?></td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">&nbsp;</td>';
                            }
                            ?>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>   เรื่องเข้าเดือนกรกฎาคม 2560</td>
                            <?php
                            $sum_incoming_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_incoming_month += $incoming_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($incoming_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_incoming_month);?></td>
                            <?php
                            $sum_incoming_cumulative_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_incoming_cumulative_month += $incoming_cumulative_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($incoming_cumulative_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_incoming_cumulative_month);?></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td>   ยุติได้ในเดือนกรกฎาคม 2560</td>
                            <?php
                            $sum_terminate_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_terminate_month += $terminate_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($terminate_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_terminate_month);?></td>
                            <?php
                            $sum_terminate_cumulative_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_terminate_cumulative_month += $terminate_cumulative_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($terminate_cumulative_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_terminate_cumulative_month);?></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td></td>
                            <td> - คงเหลือ</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                $total = ($outstanding_month[$type_id]+$incoming_month[$type_id])-$terminate_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($total).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;">
                              <?php
                              $total_terminate = ($sum_outstanding_month+$sum_incoming_month)-$sum_terminate_month;
                              echo number_format($total_terminate);
                              ?>
                            </td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                $total_cumulative = $incoming_cumulative_month[$type_id]-$terminate_cumulative_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($total_cumulative).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;">
                              <?php
                              $total_terminate = $sum_incoming_cumulative_month-$sum_terminate_cumulative_month;
                              echo number_format($total_terminate);
                              ?>
                            </td>
                          </tr>
                        </tfoot>
                    </table>
                    <?php //echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
