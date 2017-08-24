<?php
$link = array(
    'src' => 'assets/jquery/jQuery-2.1.3.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
<div id="exportData">
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table style="width: 100%;border-collapse: collapse;font-size: 16pt;">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;padding: 5px;" colspan="14">รายงานผลการดำเนินการแก้ไขปัญหาเรื่องร้องเรียนขอศูนย์ดำรงธรรมจังหวัดชลบุรี</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;padding: 5px;" colspan="14">ตั้งแต่เดือนตุลาคม 2557 – กรกฎาคม 2560</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 5%;" rowspan="2">ลำดับ</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 15%;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" colspan="<?php echo (count(@$complaint_type)+1);?>">ประเภทเรื่องร้องเรียน</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" colspan="<?php echo (count(@$progress_type)+1);?>">
                                การดำเนินการของจังหวัด<br>
                                ในเดือนกรกฎาคม  2560
                            </th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" colspan="<?php echo (count($progress_type)+1);?>">
                                ยอดสะสม<br>
                                ตั้งแต่เดือนตุลาคม 57 – งวดรายงาน
                            </th>
                        </tr>
                        <tr>
                            <?php
                            $i=0;
                            foreach($complaint_type AS $key_complaint=>$val_complaint){
                                $i++;
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;">'.$i.'.<br>'.$val_complaint.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress1=>$val_progress1){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;">'.$val_progress1.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress2=>$val_progress2){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;">'.$val_progress2.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;">รวมทั้งสิ้น</th>';
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($result_progress AS $key_result=>$val) {
                            echo '<tr>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column1'].'</td>';
                            echo '<td class="text-left" style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column2'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column3'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column4'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column5'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column6'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column7'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column8'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column9'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column10'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column11'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column12'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column13'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column14'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result']['column15'].'</td>';
                            echo '</tr>';
                            ###############รายเดือน
                            foreach($val['result_sub'] AS $key_sub => $val_sub){
                                echo '<tr>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column1'].'</td>';
                                echo '<td class="text-left" style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column2'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column3'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column4'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column5'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column6'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column7'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column8'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column9'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column10'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column11'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column12'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column13'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column14'].'</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val_sub['column15'].'</td>';
                                echo '</tr>';
                            }
                            ###############รวม
                            echo '<tr>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column1'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column2'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column3'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column4'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column5'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column6'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column7'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column8'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column9'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column10'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column11'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column12'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column13'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column14'].'</td>';
                            echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.$val['result_sum']['column15'].'</td>';
                            echo '</tr>';
                            ###############รวม 1+2+3
                            if($val['result_sum_all'] != '') {
                                echo '<tr>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column1'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column2'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column3'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column4'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column5'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column6'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column7'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column8'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column9'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column10'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column11'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column12'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column13'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column14'] . '</td>';
                                echo '<td class="text-center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">' . $val['result_sum_all']['column15'] . '</td>';
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
</div>
<div id="base_url" class="<?php echo base_url();?>"></div>
<script>
    $(document).ready(function(){
        var headContent = $('head').html();
        var bodyContent = $('#exportData').html();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url();?>html2doc/html2doc_setContent.php",
            data: {htmlHead : headContent, htmlBody : bodyContent, apptype : 'application/vnd.ms-excel', filetype : 'xls', exportData : 'on', filename : '', logFile : '', logPathFile : ''}
        }) .done(function( msg ) {
            if($.trim(msg) == 'ok'){
                window.open('<?php echo base_url();?>html2doc/html2doc.php','_blank');
                window.close();
            }
        });
    });
</script>
