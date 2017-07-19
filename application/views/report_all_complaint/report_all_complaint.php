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
                        <?php //echo img(array('src'=>'assets/images/search.png', 'title'=> 'ค้นหาข้อมูล','width'=>'48px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#search')); ?>
                        <!--a href="<?php echo base_url("report/report_all_complaint_pdf");?>" target="_blank"><?php echo img(array('src'=>'assets/images/print.png', 'title'=> 'สั่งพิมพ์','width'=>'48px','style'=>'cursor:pointer')); ?></a-->
                        <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 3em;" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล"></i>
                        <a href="'.base_url('report/report_all_complaint_pdf').'" style="color: #333333;" target="_blank"><i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 3em;" title="สั่งพิมพ์"></a></i>

                    </div>
                    <div class="col-xs-1"></div>
                    <div class="col-xs-10">
                        <div class="chart">
                            <canvas id="barChart" style="height:400px"></canvas>
                        </div>
                    </div>
                    <div class="col-xs-1"></div>
                    <!--<div class="col-xs-6 text-right">
                        <?php echo img(array('src'=>'assets/images/pic_right.jpg','width'=>'450px','style'=>'margin-right: -15px;opacity: 0.6;'));?>
                   </div>-->
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" rowspan="2">ประเภทการร้องทุกข์</th>
                            <th class="text-center" colspan="<?php echo count($channel);?>">ช่องทางการร้องทุกข์</th>
                            <th class="text-center" rowspan="2">รวม</th>
                        </tr>
                        <tr>
                            <?php foreach($channel as $key => $value){ ?>
                            <th class="text-center"><?php echo $value; ?></th>
                            <?php } ?>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($complaint_type as $key => $value){ ?>
                            <tr>
                                <td><?php echo $value; ?></td>
                                <?php foreach($channel as $key2 => $value2){ ?>
                                    <td align="right"><?php echo replace_empty(@$data[$key][$key2]); ?></td>
                                <?php
                                    @$data[$key]['sum_all'] += replace_empty(@$data[$key][$key2]);
                                } ?>
                                <td align="right"><?php echo replace_empty(@$data[$key]['sum_all']); ?></td>
                            </tr>
                        <?php } ?>

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
$color = array('#00C0EF','#DD4B39','#F39C12','#0073B7','#00A65A','#FF3333','#CC6633','#6600CC','#0033CC','#006400','#FF7F50');
foreach($channel AS $key=>$val){
    $data_value .= '{data: [';
    $sum_type = 0;
    foreach($complaint_type AS $key2=>$val2){
        $sum_type = (@$data[$key2][$key])?@$data[$key2][$key]:'0';
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
