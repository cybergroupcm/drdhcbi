<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div style="text-align: left;font-size: 16pt;font-weight: bold;">
                    <span>
                        3. รายงานรวมผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัดแบบรายเดือน
                    </span>
                </div>
                <div class="box-body">
                    <?php
                    $yymm=$_GET['yy'].'-'.$_GET['mm'];
                    ?>
                    <table style="width: 100%;border-collapse: collapse;font-size: 16pt;">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 15%;border-width:thin;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" colspan="<?php echo (count(@$complaint_type)+1);?>">
                                ผลการดำเนินการในเดือน <U><?php echo date_thai($yymm.'-01', true,'m y');?></U>
                            </th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" colspan="<?php echo (count(@$progress_type)+1);?>">
                                ผลการดำเนินงาน
                            </th>
                        </tr>
                        <tr>
                            <?php
                            $i=0;
                            foreach($complaint_type AS $key_complaint=>$val_complaint){
                                $i++;
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 6%;border-width:thin;">'.$i.'.<br>'.$val_complaint.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 6%;border-width:thin;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress1=>$val_progress1){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 6%;border-width:thin;">'.$val_progress1.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 6%;border-width:thin;">รวมทั้งสิ้น</th>';
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $col_sub = (count(@$complaint_type)+count(@$progress_type)+3);
                        foreach($result_progress AS $key_result=>$val) {
                            echo '<tr>';
                            echo '<td class="text-left" style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;" colspan="'.$col_sub.'">'.$val['result']['column1'].'</td>';
                            echo '</tr>';
                            ###############รายเดือน
                            foreach($val['result_sub'] AS $key_sub => $val_sub){
                                echo '<tr>';
                                echo '<td class="text-left" style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.$val_sub['column1'].'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column2']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column3']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column4']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column5']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column6']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column7']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column8']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column9']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column10']).'</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">'.number_format($val_sub['column11']).'</td>';
                                echo '</tr>';
                            }
                            ###############รวม
                            if($val['result_sum'] != '') {
                                echo '<tr>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . $val['result_sum']['column1'] . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column2']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column3']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column4']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column5']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column6']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column7']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column8']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column9']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column10']) . '</td>';
                                echo '<td class="text-center" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;border-width:thin;">' . number_format($val['result_sum']['column11']) . '</td>';
                                echo '</tr>';
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