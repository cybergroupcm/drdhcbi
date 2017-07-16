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
        <?php echo img(array('src'=>'assets/images/search.png', 'title'=> 'ค้นหาข้อมูล','width'=>'48px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#search')); ?>
        <a href="<?php echo base_url("report/report_all_complaint_pdf");?>" target="_blank"><?php echo img(array('src'=>'assets/images/print.png', 'title'=> 'สั่งพิมพ์','width'=>'48px','style'=>'cursor:pointer')); ?></a>
                    </div>
                    <div class="col-xs-7" id="donut-chart" style="height: 200px;"></div>
                    <div class="col-xs-5 text-right">
                        <?php echo img(array('src'=>'assets/images/pic_right.jpg','width'=>'450px','style'=>'margin-right: -15px;opacity: 0.6;'));?>
                    </div>
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
$i=1;
$letter = array();
for($a='a';$a<'z';$a++)
{
    $letter[$i] = $a;
    $i++;
}
$chart_data='';

    foreach($complaint_type as $key => $value){
        $j=1;
        $chart_data .= "{ y: '".$value."', ";
        $labels = '[';
        $ykeys = '[';
        foreach($channel as $key2 => $value2){
            $chart_data .= $letter[$j].": ".replace_empty(@$data[$key][$key2]).", ";
            $labels .= "'".$value2."', ";
            $ykeys .= "'".$letter[$j]."', ";
            $j++;
        }
        $chart_data .= " },";
        $labels = substr($labels, 0, -1);
        $labels .= ']';
        $ykeys = substr($ykeys, 0, -1);
        $ykeys .= ']';
    }
$chart_data = substr($chart_data, 0, -1);
?>
<script>
    //BAR CHART
    var bar = new Morris.Bar({
        element: 'donut-chart',
        resize: true,
        data: [<?php echo $chart_data; ?>],
        barColors: ['#3c8dbc', '#0073b7', '#00c0ef'],
        xkey: 'y',
        ykeys: <?php echo $ykeys; ?>,
        labels: <?php echo $labels; ?>,
        hideHover: 'auto'
    });
      function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
      }
</script>
