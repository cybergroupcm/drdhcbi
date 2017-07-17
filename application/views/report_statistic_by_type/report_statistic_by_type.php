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
$this->load->view('report_statistic_by_type/search');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> รายงานสถิติเรื่องร้องเรียนร้องทุกข์(ประเภทเรื่อง)</h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <?php
                        echo img(array('src'=>'assets/images/search.png', 'title'=> 'ค้นหาข้อมูล','width'=>'48px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#search'));
                        echo img(array('src'=>'assets/images/print.png', 'title'=> 'สั่งพิมพ์','width'=>'48px','style'=>'cursor:pointer'));
                        ?>
                    </div>
                    <div class="col-xs-6" id="bar-chart" style="height: 300px;"></div>
                    <div class="col-xs-6 text-right">
                        <?php echo img(array('src'=>'assets/images/pic_right.jpg','width'=>'450px','style'=>'margin-right: -15px;opacity: 0.6;'));?>

                        <!--
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">ประเภทเรื่องร้องทุกข์</th>
                                    <th class="text-center" colspan="4">สถิติรายเดือน</th>
                                    <th class="text-center" rowspan="2">รวม</th>
                                </tr>
                                <tr>
                                    <?php for($i=3;$i>=0;$i--){ ?>
                                    <th class="text-center"><?php echo date_thai(date('Y-m',strtotime('-'.$i.' month')),false,"m y"); ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                        </table>
                        -->
                   </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;" rowspan="2">ประเภทเรื่องร้องทุกข์</th>
                                    <th class="text-center" colspan="<?php echo count(@$month_report);?>">สถิติรายเดือน</th>
                                    <th class="text-center" style="vertical-align: middle;" rowspan="2">รวม</th>
                                </tr>
                                <tr>
                                    <?php
                                    foreach($month_report AS $key=>$month){
                                        echo '<th class="text-center">'.$month.'</th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                        <tbody>
                        <?php
                        foreach($complain_type AS $key_type=>$type_name) {
                            echo '<tr>';
                            echo '<td class="text-left">'.$type_name.'</td>';
                                $sum_type = 0;
                                $sum_type_all = 0;
                                foreach($month_report AS $key=>$month){
                                    $sum_type = (@$report_type[$key_type][$key])?@$report_type[$key_type][$key]:'0';
                                    $sum_type_all += $sum_type;
                                    echo '<td class="text-right">'.number_format($sum_type).'</td>';
                                }
                                echo '<td class="text-right">'.number_format($sum_type_all).'</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <?php
                            echo '<tr>';
                                echo '<td class="text-left">รวม</td>';
                                $sum_total = 0;
                                $sum_total_all = 0;
                                foreach($month_report AS $key=>$month){
                                    echo '<td class="text-right">'.number_format($sum_total).'</td>';
                                }
                                echo '<td class="text-right">'.number_format($sum_total_all).'</td>';
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
    $data_labels = '';
    $data_labels .= '[';
    $data_ykeys = '';
    $data_ykeys .= '[';
    foreach($complain_type AS $key=>$val){
        $comma = ($key == 1)?'':',';
        $data_labels .= $comma."'".$val."'";
        $data_ykeys .= $comma."'".$key."'";
    }
    $data_labels .= ']';
    $data_ykeys .= ']';

    $data_type = '';
    $data_type .= '[';
    foreach($month_report AS $key2=>$month){
        $data_type .= "{y:'".$month."'";
        $sum_type = 0;
        foreach($report_type AS $key=>$val) {
            $sum_type = (@$val[$key2])?$val[$key2]:'0';
            $data_type .= ",".$key.": ".$sum_type;
        }
        $data_type .= "},";
    }
    $data_type .= ']';
?>
<script>
        //BAR CHART
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: <?php echo $data_type;?>,
            barColors: ['#3c8dbc', '#0073b7', '#0073b7'],
            xkey: 'y',
            ykeys: <?php echo $data_ykeys;?>,
            labels: <?php echo $data_labels;?>,
            hideHover: 'auto'
        });

        /*
       * Custom Label formatter
       * ----------------------
       */
      function labelFormatter(label, series) {
        return "<div style='font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
      }
</script>
