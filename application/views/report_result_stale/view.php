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

$this->load->view('report_result_stale/search');

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">2. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (คงค้าง)</h3>
                </div>
                <!--<div class="col-xs-12 text-left">
                    จังหวัดชลบุรี ประจำเดือนกรกฎาคม 2560
                </div>-->
                <div class="box-body">
                    <!--<div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <?php
/*                            $param_pdf = "?year=".$_GET['year']."&current_status_id=".$_GET['complain_type_id']."&partid=".$_GET['partid']."&province_id=".$_GET['province_id']."&district_id=".$_GET['district_id']."&address_id=".$_GET['address_id'];
                        */?>
                            <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล">
                                <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                            <a href="<?php /*echo base_url('report_result_progress/pdf'.$param_pdf); */?>" class="btn btn-default" role="button"  title="สั่งพิมพ์" target="_blank">
                                <i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                            <a href="<?php /*echo base_url('report_result_progress/excel'.$param_pdf); */?>" class="btn btn-default" role="button" title="ส่งออก Excel" target="_blank">
                                <i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                    </div>-->
                    <div class="col-xs-12 col-md-10 col-md-offset-1 col-sm-12">
                        <div class="col-xs-6 col-md-6  col-sm-12">
                            <div class="chart">
                                <canvas id="barChart" style="height:400px"></canvas>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 col-sm-12">
                            <div class="chart" >
                                <canvas id="barChart2" style="height:400px"></canvas>
                            </div>
                        </div>
                    </div>

                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <?php
                        $col_data = count(@$complaint_type)+1;
                        ?>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo $col_data;?>">ผลการดำเนินการในเดือน <u><?php echo $data_detail['month_name'][$data_detail['month']] ." ". ($data_detail['year']+543) ?></u></th>
                        </tr>
                        <tr>
                            <?php
                                $index_complaint = 1;
                                foreach ($complaint_type AS $key => $value) {
                                    echo '<th class="text-center"  style="vertical-align: top;width: 10%;"> '. $index_complaint.' . '.$value . '</th>';
                                    $index_complaint++;
                                }
                                ?>
                                <th class="text-center"  style="vertical-align: top;width: 6%;">รวมทั้งสิ้น</th>
                            <?php
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $col_sub = ($col_data*2)+2;
                        foreach($main_data AS $key_main => $value_main) {
                            ?>
                            <tr>
                                <td colspan="<?php echo $col_sub ?>">2.<?php echo $key_main." ".$value_main?></td>
                            </tr>
                        <?php
                            foreach($sub_data[$key_main] AS $key_sub => $value_sub){
                                ?>
                                <tr>
                                    <td >- <?php echo  $value_sub?></td>
                                    <?php
                                    foreach ($complaint_type AS $key => $value) {
                                        echo '<td class="text-right"  style="vertical-align: top;width: 6%;">' .number_format($sub_detail_report[$key_main][$key_sub][$key]) . '</td>';
                                        $index_complaint++;
                                    }
                                    ?>
                                    <td class="text-right"><?php echo number_format(array_sum($sub_detail_report[$key_main][$key_sub]))?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
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
    '0'=>'เรื่องเข้าทั้งหมด',
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
    var  arr_complaint= '<?php echo json_encode($arr_complaint);?>';
    var  complaint = JSON.parse(arr_complaint);

    var config = {
        type: 'bar',
        data: {
            datasets: [
                {
                    data:[<?php echo implode(",",$sub_detail_report[1][1]) ?>],
                    backgroundColor: "#00C0EF",
                    label:"เรื่องเข้าทั้งหมดปี <?php echo substr((($data_detail['year']+543)-2),2,2) ?>"
                },
                {
                    data:[<?php echo implode(",",$sub_detail_report[1][2]) ?>],
                    backgroundColor: "#DD4B39",
                    label:"ดำเนินการจนยุติปี <?php echo substr((($data_detail['year']+543)-2),2,2) ?>",
                }
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
                text: '<?php  echo "เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.".(($data_detail['year']+543)-2) ?>'
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


    var config2 = {
        type: 'bar',
        data: {
            datasets: [
                {
                    data: [<?php echo implode(",",$sub_detail_report[2][1]) ?>],
                    backgroundColor: "#00C0EF",
                    label: "เรื่องเข้าทั้งหมดปี <?php echo substr((($data_detail['year'] + 543) - 1), 2, 2) ?>"
                },
                {
                    data: [<?php echo implode(",",$sub_detail_report[2][2]) ?>],
                    backgroundColor: "#DD4B39",
                    label: "ดำเนินการจนยุติปี <?php echo substr((($data_detail['year'] + 543) - 1), 2, 2) ?>"
                }],
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
                text: '<?php echo "เรื่องร้องเรียนที่ค้างดำเนินการเมื่อปีงบประมาณ พ.ศ.".(($data_detail['year']+543)-1) ?>'
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
        var ctx2 = document.getElementById("barChart2").getContext("2d");
        window.myDoughnut = new Chart(ctx,config);
        window.myDoughnut = new Chart(ctx2,config2);
    };
</script>