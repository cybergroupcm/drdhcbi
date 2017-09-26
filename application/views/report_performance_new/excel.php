<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div style="text-align: left;font-size: 16pt;font-weight: bold;">
                    <span>
                        1. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (เรื่องใหม่)
                    </span>
                </div>
                <div class="box-body">
                    <?php
                    $yymm=$_GET['yy'].'-'.$_GET['mm'];
                    ?>
                    <table  style="width: 100%;border-collapse: collapse;font-size: 16pt;">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;" colspan="<?php echo count(@$complaint_type);?>">ผลการดำเนินการในเดือน <U><?php echo date_thai($yymm.'-01', true,'m y');?></U></th>
                            <th class="text-center" style="vertical-align: middle;width: 10%;border: 1px solid black;padding: 5px;border-width:thin;" rowspan="2">รวมทั้งสิ้น</th>
                        </tr>
                        <tr>
                            <?php
                            $int_type = 0;
                            foreach($complaint_type AS $type_name){
                                $int_type++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 10%;border: 1px solid black;padding: 5px;border-width:thin;">'.$int_type.'.'.$type_name.'</th>';
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;" colspan="<?php echo (count(@$complaint_type))+2;?>">1. เรื่องร้องเรียนที่ได้รับดำเนินการในปีงบประมาณ พ.ศ.<?php echo date_thai($yymm.'-01', true,'y');?>  และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.<?php echo date_thai($yymm.'-01', true,'y');?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;">&nbsp;- เรื่องรับเข้าใหม่ปีงบฯ <?php echo date_thai($yymm.'-01', true,'Y');?> ดังนี้</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;">&nbsp;</td>';
                            }
                            ?>
                            <td style="vertical-align: middle;border: 1px solid black;border-width:thin;"></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;">&nbsp;&nbsp;&nbsp;ค้างเดือน<?php echo date_thai($_GET['yy'].'-'.($_GET['mm']-1).'-01', true,'m y');?></td>
                            <?php
                            $sum_outstanding_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_outstanding_month += $outstanding_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;">'.number_format($outstanding_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;"><?php echo number_format($sum_outstanding_month);?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;">&nbsp;&nbsp;&nbsp;เรื่องเข้าเดือน<?php echo date_thai($yymm.'-01', true,'m y');?></td>
                            <?php
                            $sum_incoming_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_incoming_month += $incoming_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;">'.number_format($incoming_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;"><?php echo number_format($sum_incoming_month);?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;">&nbsp;&nbsp;&nbsp;ยุติได้ในเดือน<?php echo date_thai($yymm.'-01', true,'m y');?></td>
                            <?php
                            $sum_terminate_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_terminate_month += $terminate_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;">'.number_format($terminate_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;"><?php echo number_format($sum_terminate_month);?></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td style="vertical-align: middle;border: 1px solid black;padding: 5px;border-width:thin;">&nbsp;- คงเหลือ</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                $total = $remain[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;">'.number_format($total).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;border: 1px solid black;text-align: right;padding: 5px;border-width:thin;">
                                <?php
                                $total_terminate = ($sum_outstanding_month+$sum_incoming_month)-$sum_terminate_month;
                                echo number_format($total_terminate);
                                ?>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
