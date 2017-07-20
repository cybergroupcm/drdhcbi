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
                            <th class="text-center" style="vertical-align: middle;text-align: center;padding: 5px;" colspan="14">รายงานสถิติเรื่องร้องเรียนร้องทุกข์(ประเภทเรื่อง)</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" rowspan="2">ประเภทเรื่องร้องทุกข์</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;padding: 5px;" colspan="<?php echo count(@$month_report);?>">สถิติรายเดือน</th>
                            <th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;" rowspan="2">รวม</th>
                        </tr>
                        <tr>
                            <?php
                            foreach($month_report AS $key=>$month){
                                echo '<th class="text-center" style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width:6%;mso-number-format:\@;">'.$month.'</th>';
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
                        foreach($complain_type AS $key_type=>$type_name) {
                            echo '<tr>';
                            echo '<td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;"> '.$type_name.'</td>';
                            $sum_type = 0;
                            $sum_type_all = 0;
                            foreach($arr_data_month AS $key=>$val){
                                @$sum_type = (@$report_type[$key_type][$key])?@$report_type[$key_type][$key]:'0';
                                @$sum_type_all += $sum_type;
                                @$arr_sum_all[$key] +=  $sum_type;
                                echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.number_format(@$sum_type).' </td>';
                            }
                            echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.number_format(@$sum_type_all).' </td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <?php
                        echo '<tr>';
                        echo '<td  style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">รวม</td>';
                        $sum_total_all = 0;
                        foreach($month_report AS $key=>$month){
                            $sum_total_all += $arr_sum_all[$key];
                            echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.number_format(@$arr_sum_all[$key]).'</td>';
                        }
                        echo '<td style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">'.number_format(@$sum_total_all).'</td>';
                        echo '</tr>';

                        ?>
                        </tfoot>
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
