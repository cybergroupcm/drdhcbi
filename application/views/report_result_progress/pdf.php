<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header col-xs-12  text-center">
                    <table border="0" style="width: 100%;">
                        <tr>
                            <td style="text-align: center">
                                <h3 class="box-title" style="font-size: 14px;">รายงานผลการดำเนินการแก้ไขปัญหาเรื่องร้องเรียนขอศูนย์ดำรงธรรมจังหวัดชลบุรี</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center">ตั้งแต่เดือนตุลาคม 2557 – กรกฎาคม 2560</td>
                        </tr>
                    </table>
                </div>
                <div class="box-body">
                    <table style="width: 100%;border-collapse: collapse;font-size: 13px;">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 5%;" rowspan="2">ลำดับ</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 15%;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;" colspan="<?php echo (count(@$complaint_type)+1);?>">ประเภทเรื่องร้องเรียน</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;" colspan="<?php echo (count(@$progress_type)+1);?>">
                                การดำเนินการของจังหวัด<br>
                                ในเดือนกรกฎาคม  2560
                            </th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;" colspan="<?php echo (count(@$progress_type)+1);?>">
                                ยอดสะสม<br>
                                ตั้งแต่เดือนตุลาคม 57 – งวดรายงาน
                            </th>
                        </tr>
                        <tr>
                            <?php
                            $i=0;
                            foreach($complaint_type AS $key_complaint=>$val_complaint){
                                $i++;
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;width: 6%;">'.$i.'.<br>'.$val_complaint.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;width: 6%;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress1=>$val_progress1){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;width: 6%;">'.$val_progress1.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;width: 6%;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress2=>$val_progress2){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;width: 6%;">'.$val_progress2.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;font-size: 12px;width: 6%;">รวมทั้งสิ้น</th>';
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($result_progress AS $key_result=>$val) {
                            echo '<tr>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column1'].'</td>';
                            echo '<td class="text-left" style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column2'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column3'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column4'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column5'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column6'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column7'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column8'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column9'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column10'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column11'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column12'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column13'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column14'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result']['column15'].'</td>';
                            echo '</tr>';
                            ###############รายเดือน
                            foreach($val['result_sub'] AS $key_sub => $val_sub){
                                echo '<tr>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column1'].'</td>';
                                echo '<td class="text-left" style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column2'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column3'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column4'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column5'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column6'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column7'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column8'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column9'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column10'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column11'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column12'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column13'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column14'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val_sub['column15'].'</td>';
                                echo '</tr>';
                            }
                            ###############รวม
                            echo '<tr>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column1'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column2'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column3'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column4'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column5'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column6'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column7'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column8'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column9'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column10'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column11'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column12'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column13'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column14'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.$val['result_sum']['column15'].'</td>';
                            echo '</tr>';
                            ###############รวม 1+2+3
                            if($val['result_sum_all'] != '') {
                                echo '<tr>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column1'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column2'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column3'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column4'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column5'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column6'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column7'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column8'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column9'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column10'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column11'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column12'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column13'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column14'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column15'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                     <!--
                    <table style="width: 100%;border-collapse: collapse;font-size: 13px;">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;" rowspan="2">สถานะเรื่องร้องทุกข์</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;padding: 5px;" colspan="<?php echo count(@$month_report);?>">สถิติรายเดือน</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width: 6%;" rowspan="2">รวม</th>
                        </tr>
                        <tr>
                            <?php
                            foreach($month_report AS $key=>$month){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;width:6%;">'.$month.'</th>';
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $arr_data_month = array();
                        foreach($month_report AS $key=>$month){
                            $arr_data_month[$key] = 0;
                        }
                        $arr_sum_all = array();
                        foreach($current_status AS $key_type=>$type_name) {
                            echo '<tr>';
                            echo '<td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;"> '.$type_name.'</td>';
                            $sum_type = 0;
                            $sum_type_all = 0;
                            foreach($arr_data_month AS $key=>$val){
                                @$sum_type = (@$report_type[$key_type][$key])?@$report_type[$key_type][$key]:'0';
                                @$sum_type_all += $sum_type;
                                @$arr_sum_all[$key] +=  $sum_type;
                                echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.number_format(@$sum_type).' </td>';
                            }
                            echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.number_format(@$sum_type_all).' </td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <?php
                        echo '<tr>';
                        echo '<td  style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">รวม</td>';
                        $sum_total_all = 0;
                        foreach($month_report AS $key=>$month){
                            $sum_total_all += $arr_sum_all[$key];
                            echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.number_format(@$arr_sum_all[$key]).'</td>';
                        }
                        echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align: top;padding: 5px;">'.number_format(@$sum_total_all).'</td>';
                        echo '</tr>';

                        ?>
                        </tfoot> -->
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
