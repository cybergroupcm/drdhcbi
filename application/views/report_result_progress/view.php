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

//$this->load->view('report_result_progress/search');

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">3. รายงานรวมผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัดแบบรายเดือน</h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;width: 15%;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo (count(@$complaint_type)+1);?>">
                                ผลการดำเนินการในเดือน <U><?php echo date_thai($yymm.'-01', true,'m y');?></U>
                            </th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo (count(@$progress_type)+1);?>">
                                ผลการดำเนินงาน
                            </th>
                        </tr>
                        <tr>
                            <?php
                            $i=0;
                            foreach($complaint_type AS $key_complaint=>$val_complaint){
                                $i++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$i.'. '.$val_complaint.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;width: 6%;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress1=>$val_progress1){
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$val_progress1.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;width: 6%;">รวมทั้งสิ้น</th>';
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $col_sub = (count(@$complaint_type)+count(@$progress_type)+3);
                        $sum_column2 = 0;
                        $sum_column3 = 0;
                        $sum_column4 = 0;
                        $sum_column5 = 0;
                        $sum_column6 = 0;
                        $sum_column7 = 0;
                        $sum_column8 = 0;
                        $sum_column9 = 0;
                        $sum_column10 = 0;
                        $sum_column11 = 0;
                        foreach($result_progress AS $key_result=>$val) {
                            echo '<tr>';
                            echo '<td class="text-left" colspan="'.$col_sub.'">'.$val['result']['column1'].'</td>';
                            echo '</tr>';
                            ###############รายเดือน
                            foreach($val['result_sub'] AS $key_sub => $val_sub){
                                echo '<tr>';
                                echo '<td class="text-left">'.$val_sub['column1'].'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column2']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column3']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column4']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column5']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column6']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column7']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column8']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column9']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column10']).'</td>';
                                echo '<td class="text-right">'.number_format($val_sub['column11']).'</td>';
                                echo '</tr>';
                                $sum_column2 += $val_sub['column2'];
                                $sum_column3 += $val_sub['column3'];
                                $sum_column4 += $val_sub['column4'];
                                $sum_column5 += $val_sub['column5'];
                                $sum_column6 += $val_sub['column6'];
                                $sum_column7 += $val_sub['column7'];
                                $sum_column8 += $val_sub['column8'];
                                $sum_column9 += $val_sub['column9'];
                                $sum_column10 += $val_sub['column10'];
                                $sum_column11 += $val_sub['column11'];
                            }
                        }
                        ###############รวม
                        echo '<tr>';
                        echo '<td class="text-right">รวม</td>';
                        echo '<td class="text-right">' . number_format($sum_column2) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column3) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column4) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column5) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column6) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column7) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column8) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column9) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_column10) . '</td>';
                        echo '<td class="text-right">' . number_format($sum_colum11) . '</td>';
                        echo '</tr>';
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
