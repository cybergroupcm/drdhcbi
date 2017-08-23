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
                    <h3 class="box-title">1. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (เรื่องใหม่)</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        <div class="chart">
                            <canvas id="barChart" style="height:400px"></canvas>
                        </div>
                    </div>
                    <div class="col-xs-1"></div>

                    <?php
                    $yymm=$_GET['yy'].'-'.$_GET['mm'];
                    ?>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo count(@$complaint_type);?>">ผลการดำเนินการในเดือน <U><?php echo date_thai($yymm.'-01', true,'m y');?></U></th>
                            <th class="text-center" style="vertical-align: middle;width: 10%;" rowspan="2">รวมทั้งสิ้น</th>
                        </tr>
                        <tr>
                            <?php
                            $int_type = 0;
                            foreach($complaint_type AS $type_name){
                                $int_type++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 10%;">'.$int_type.'.'.$type_name.'</th>';
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="<?php echo (count(@$complaint_type))+2;?>">1. เรื่องร้องเรียนที่ได้รับดำเนินการในปีงบประมาณ พ.ศ.<?php echo date_thai($yymm.'-01', true,'y');?>  และสามารถแก้ไขปัญหาจนได้ข้อยุติในปีงบประมาณ พ.ศ.<?php echo date_thai($yymm.'-01', true,'y');?></td>
                          </tr>
                          <tr>
                            <td> - เรื่องรับเข้าใหม่ปีงบฯ <?php echo date_thai($yymm.'-01', true,'Y');?> ดังนี้</td>
                            <?php
                            foreach($complaint_type AS $type_id => $type_name){
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">&nbsp;</td>';
                            }
                            ?>
                            <td></td>
                          </tr>
                          <tr>
                            <td>   ค้างเดือน<?php echo date_thai($_GET['yy'].'-'.($_GET['mm']-1).'-01', true,'m y');?></td>
                            <?php
                            $sum_outstanding_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_outstanding_month += $outstanding_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($outstanding_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_outstanding_month);?></td>
                          </tr>
                          <tr>
                            <td>   เรื่องเข้าเดือน<?php echo date_thai($yymm.'-01', true,'m y');?></td>
                            <?php
                            $sum_incoming_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_incoming_month += $incoming_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($incoming_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_incoming_month);?></td>
                          </tr>
                          <tr>
                            <td>   ยุติได้ในเดือน<?php echo date_thai($yymm.'-01', true,'m y');?></td>
                            <?php
                            $sum_terminate_month = 0;
                            foreach($complaint_type AS $type_id => $type_name){
                                $sum_terminate_month += $terminate_month[$type_id];
                                echo '<td class="text-center" style="vertical-align: middle;width: 6%;">'.number_format($terminate_month[$type_id]).'</td>';
                            }
                            ?>
                            <td class="text-center" style="vertical-align: middle;width: 6%;"><?php echo number_format($sum_terminate_month);?></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
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
<?php
$arr_title = array(
    '0'=>'เรื่องเข้าเดือนกรกฎาคม 2560',
    '1'=>'ยุติได้ในเดือนกรกฎาคม 2560'
);

$report_data = array();
foreach($arr_title AS $key =>$val){
    $report_data[0] = $incoming_month;
    $report_data[1] = $terminate_month;
}

$color = array('#00C0EF','#DD4B39','#F39C12','#0073B7','#00A65A');
foreach($arr_title AS $key=>$val){
    $data_value .= '{data: [';
    $sum_type = 0;
    foreach($complaint_type AS $key2=>$val2){
        $sum_type = (@$report_data[$key][$key2])?@$report_data[$key][$key2]:'0';
        $data_value .=  $sum_type.',';
    }
    $data_value .= '],
                backgroundColor: "'.$color[$key].'",
                label:"'.$val.'"
                },';
}

$arr_complaint = array();
$i=0;
$j=1;
foreach($complaint_type AS $key=>$val) {
    $arr_complaint[$i]['complaint_id'] = $key;
    $arr_complaint[$i]['complaint_shrot'] = $j;
    $arr_complaint[$i]['complaint_name'] = $val;
    $i++;
    $j++;
}
?>
<?php
$link = array(
    'src' => 'assets/js/Chart.bundle.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/Chart.analytics.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/Chart.utils.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
<script>
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var  arr_complaint= '<?php echo json_encode($arr_complaint);?>';
    var  complaint = JSON.parse(arr_complaint);

    var config = {
        type: 'bar',
        data: {
            datasets: [<?php echo $data_value;?>
            ],
            labels: [
                <?php
                foreach($arr_complaint AS $key=>$val){
                    echo "'".$val['complaint_shrot']."',";
                }
                ?>
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: ''
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            tooltips: {
                callbacks: {
                    title: function(tooltipItems, data) {
                        // Pick first xLabel for now
                        var title = '';
                        if (tooltipItems.length > 0) {
                            title = complaint[tooltipItems[0].index].complaint_name;
                        }
                        return title;
                    },
                    label: function(tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ':' + tooltipItem.yLabel;
                    }
                }
            }
        }
    };
    window.onload = function() {
        var ctx = document.getElementById("barChart").getContext("2d");
        window.myDoughnut = new Chart(ctx,config);
    };
</script>