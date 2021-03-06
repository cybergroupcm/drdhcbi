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
$this->load->view('report_all_complaint/search');

function replace_empty($value){
    if($value==''){
        return '0';
    }else{
        return $value;
    }
}
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> รายงานรวมเรื่องร้องทุกข์</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล">
                            <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                        </a>
                        <a href="<?php echo base_url('report/report_all_complaint_pdf'.$param_get); ?>" class="btn btn-default" role="button"  title="สั่งพิมพ์" target="_blank">
                            <i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                        </a>
                        <a href="<?php echo base_url('report/report_all_complaint_excel'.$param_get); ?>" class="btn btn-default" role="button" title="ส่งออก Excel" target="_blank">
                            <i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                        </a>
                    </div>
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        <div class="chart">
                            <canvas id="barChart" style="height:400px"></canvas>
                        </div>
                    </div>
                    <div class="col-xs-1"></div>
                    <?php
                    $td_width = "width: 15%;";
                    if(count($channel_max) > 1){
                        $td_width = "width: 6%;";
                    }
                    ?>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ประเภทการร้องทุกข์</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo count($channel_max);?>">ช่องทางการร้องทุกข์</th>
                            <th class="text-center" style="vertical-align: middle;<?php echo $td_width;?>" rowspan="2">รวม</th>
                        </tr>
                        <tr>
                            <?php foreach($channel_max as $key => $value){ ?>
                            <th class="text-center" style="vertical-align: middle;<?php echo $td_width;?>"><?php echo $value; ?></th>
                            <?php } ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sum_all = 0;
                        foreach($complaint_type as $key => $value){ ?>
                            <tr>
                                <td><?php echo $value; ?></td>
                                <?php foreach($channel_max as $key2 => $value2){ ?>
                                    <td align="right"><?php echo replace_empty(@$data[$key][$key2]); ?></td>
                                <?php
                                    @$data[$key]['sum_all'] += replace_empty(@$data[$key][$key2]);
                                    @$data['sum_all'][$key2] += replace_empty(@$data[$key][$key2]);
                                } ?>
                                <td align="right"><?php echo replace_empty(@$data[$key]['sum_all']); ?></td>
                            </tr>
                        <?php
                            $sum_all += replace_empty(@$data[$key]['sum_all']);
                        } ?>
                            <tr>
                                <td align="center">รวม</td>
                                <?php foreach($channel_max as $key2 => $value2){ ?>
                                    <td align="right"><?php echo replace_empty(@$data['sum_all'][$key2]); ?></td>
                                <?php } ?>
                                <td align="right"><?php echo $sum_all; ?></td>
                            </tr>
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
$link = array(
    'src' => 'assets/js/report.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
<?php
$arr_max_data = array();
$i=0;
foreach($complaint_type AS $key=>$value){
    if(@$complaint_type[$key]) {
        $arr_max_data[$key] = $value;
    }
}

$data_value = '';
$color = array('#00C0EF','#DD4B39','#F39C12','#0073B7','#00A65A','#F06292','#FFFF00','#800000','#00FF00','#008080','#800080','#F1948A');
$data_value .= '{data: [';
$sum_type = 0;
//echo '<pre>'; print_r($channel); echo '</pre>';
foreach($channel_max AS $key2=>$val2){
    $sum_type = (@$data['sum_all'][$key2])?@$data['sum_all'][$key2]:'0';
    $data_value .=  $sum_type.',';
}
$data_value .= '],
            backgroundColor: "#0073B7",
            label:"ช่องทางการร้องทุกข์"
            },';

function substr_utf8( $str, $start_p , $len_p){
    return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s','$1' , $str );
}

$arr_channel = array();
$i=0;
foreach($channel_max AS $key=>$val) {
    $newtext = substr_utf8($val,0,13);
    $arr_channel[$i]['channel_id'] = $key;
    $arr_channel[$i]['channel_name_shrot'] = $newtext.'...';
    $arr_channel[$i]['channel_name'] = $val;
    $i++;
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

    var  arr_channel= '<?php echo json_encode($arr_channel);?>';
    var  channel = JSON.parse(arr_channel);

    var config = {
        type: 'bar',
        data: {
            datasets: [<?php echo $data_value;?>
            ],
            labels: [
                <?php
                foreach($arr_channel AS $key=>$val){
                    echo "'".$val['channel_name_shrot']."',";
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
                           title = channel[tooltipItems[0].index].channel_name;
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
