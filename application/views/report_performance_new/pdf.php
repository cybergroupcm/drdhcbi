<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="text-align: center;">แบบรายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด  (เรื่องใหม่)</h3>
                </div>
                <div class="col-xs-12" style="text-align: center;">
                    จังหวัดชลบุรี ประจำเดือนกรกฎาคม 2560
                </div>
                <div class="box-body">

                    <table  style="width: 100%;border-collapse: collapse;font-size: 13px;">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;" rowspan="2">ที่</th>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;" colspan="<?php echo count(@$complaint_type);?>">ผลการดำเนินการในเดือนที่รายงาน</th>
                            <th class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;" rowspan="2">รวมทั้งสิ้น</th>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;" colspan="<?php echo count(@$complaint_type);?>">ผลการดำเนินการสะสม</th>
                            <th class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;" rowspan="2">รวมทั้งสิ้น</th>
                        </tr>
                        <tr>
                            <?php
                            $int_type = 0;
                            foreach($complaint_type AS $type_name){
                                $int_type++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;">'.$int_type.'.'.$type_name.'</th>';
                            }
                            ?>
                            <?php
                            $int_type = 0;
                            foreach($complaint_type AS $type_name){
                                $int_type++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;">'.$int_type.'.'.$type_name.'</th>';
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="vertical-align: middle;border: 1px solid black;">2</td>
                            <td style="vertical-align: middle;border: 1px solid black;" colspan="<?php echo (count(@$complaint_type)*2)+3;?>">เรื่องร้องเรียนที่ได้รับดำเนินการในปีงบประมาณ พ.ศ.๒๕๖๐  และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.๒๕๖๐</td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                            <td style="vertical-align: middle;border: 1px solid black;"> - เรื่องรับเข้าใหม่ปีงบฯ ๖๐ ดังนี้</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;">&nbsp;</td>';
                            }
                            ?>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;">&nbsp;</td>';
                            }
                            ?>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                            <td style="vertical-align: middle;border: 1px solid black;">ค้างเดือนก่อนหน้า</td>
                            <?php
                            $sum_outstanding_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_outstanding_month += $outstanding_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($outstanding_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;"><?php echo number_format($sum_outstanding_month);?></td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;">&nbsp;</td>';
                            }
                            ?>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                            <td style="vertical-align: middle;border: 1px solid black;">   เรื่องเข้าเดือนกรกฎาคม 2560</td>
                            <?php
                            $sum_incoming_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_incoming_month += $incoming_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($incoming_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;"><?php echo number_format($sum_incoming_month);?></td>
                            <?php
                            $sum_incoming_cumulative_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_incoming_cumulative_month += $incoming_cumulative_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($incoming_cumulative_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;"><?php echo number_format($sum_incoming_cumulative_month);?></td>
                          </tr>
                          <tr>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                            <td style="vertical-align: middle;border: 1px solid black;">   ยุติได้ในเดือนกรกฎาคม 2560</td>
                            <?php
                            $sum_terminate_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_terminate_month += $terminate_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($terminate_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;"><?php echo number_format($sum_terminate_month);?></td>
                            <?php
                            $sum_terminate_cumulative_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_terminate_cumulative_month += $terminate_cumulative_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($terminate_cumulative_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;"><?php echo number_format($sum_terminate_cumulative_month);?></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td style="vertical-align: middle;border: 1px solid black;"></td>
                            <td style="vertical-align: middle;border: 1px solid black;"> - คงเหลือ</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                $total = ($outstanding_month[$type_id]+$incoming_month[$type_id])-$terminate_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($total).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">
                              <?php
                              $total_terminate = ($sum_outstanding_month+$sum_incoming_month)-$sum_terminate_month;
                              echo number_format($total_terminate);
                              ?>
                            </td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                $total_cumulative = $incoming_cumulative_month[$type_id]-$terminate_cumulative_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">'.number_format($total_cumulative).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;border: 1px solid black;text-align: center;">
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
