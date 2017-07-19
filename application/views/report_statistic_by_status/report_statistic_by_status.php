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

$this->load->view('report_statistic_by_status/search');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> รายงานสถิติเรื่องร้องเรียนร้องทุกข์(สถานะ)</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <?php
                        $param_pdf = "?year=".$_GET['year']."&current_status_id=".$_GET['complain_type_id']."&partid=".$_GET['partid']."&province_id=".$_GET['province_id']."&district_id=".$_GET['district_id']."&address_id=".$_GET['address_id'];

                        echo '<i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 3em;" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล"></i>  ';
                        echo '<a href="'.base_url('report/report_statistic_by_status_pdf'.$param_pdf).'" style="color: #333333;" target="_blank"><i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 3em;" title="สั่งพิมพ์"></a></i>  ';
                        echo '<a href="'.base_url('report/report_statistic_by_status_excel'.$param_pdf).'" style="color: #333333;" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 3em;" title="ส่งออก Excel"></a></i>';
                        ?>
                    </div>
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        <div class="chart">
                            <canvas id="barChart" style="height:400px"></canvas>
                        </div>
                    </div>
                    <div class="col-xs-1"></div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">สถานะเรื่องร้องทุกข์</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo count(@$month_report);?>">สถิติรายเดือน</th>
                            <th class="text-center" style="vertical-align: middle;width: 6%;" rowspan="2">รวม</th>
                        </tr>
                        <tr>
                            <?php
                            foreach($month_report AS $key=>$month){
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$month.'</th>';
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
                            echo '<td class="text-left">'.$type_name.'</td>';
                            $sum_type = 0;
                            $sum_type_all = 0;
                            foreach($arr_data_month AS $key=>$val){
                                @$sum_type = (@$report_type[$key_type][$key])?@$report_type[$key_type][$key]:'0';
                                @$sum_type_all += $sum_type;
                                @$arr_sum_all[$key] +=  $sum_type;
                                echo '<td class="text-right">'.number_format(@$sum_type).'</td>';
                            }
                            echo '<td class="text-right">'.number_format(@$sum_type_all).'</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <?php
                        echo '<tr>';
                        echo '<td class="text-left">รวม</td>';
                        $sum_total_all = 0;
                        foreach($month_report AS $key=>$month){
                            $sum_total_all += $arr_sum_all[$key];
                            echo '<td class="text-right">'.number_format(@$arr_sum_all[$key]).'</td>';
                        }
                        echo '<td class="text-right">'.number_format(@$sum_total_all).'</td>';
                        echo '</tr>';

                        ?>
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
//echo '<pre>'; print_r($report_type); echo '</pre>';
$arr_max_data = array();
$i=0;
foreach($month_report AS $key2=>$month){
    if(@$report_type_max[$key2]) {
        $arr_max_data[$key2] = $month;
    }
}

$data_value = '';
$color = array('#00C0EF','#DD4B39','#F39C12','#0073B7','#00A65A');
foreach($current_status AS $key=>$val){
    $data_value .= '{data: [';
    $sum_type = 0;
    foreach($arr_max_data AS $key2=>$val2){
        $sum_type = (@$report_type[$key][$key2])?@$report_type[$key][$key2]:'0';
        $data_value .=  $sum_type.',';
    }
    $data_value .= '],
                backgroundColor: "'.$color[$key].'",
                label:"'.$val.'"
                },';
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
    var config = {
        type: 'bar',
        data: {
            datasets: [<?php echo $data_value;?>
            ],
            labels: [
                <?php
                foreach($arr_max_data AS $key=>$val){
                    echo "'".$val."',";
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
            }
        }
    };
    window.onload = function() {
        var ctx = document.getElementById("barChart").getContext("2d");
        window.myDoughnut = new Chart(ctx,config);
    };
</script>