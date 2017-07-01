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
                        echo img(array('src'=>'assets/images/search.png', 'title'=> 'ค้นหาข้อมูล','width'=>'48px','style'=>'cursor:pointer','data-toggle'=>'modal','data-target'=>'#search'));
                        echo img(array('src'=>'assets/images/print.png', 'title'=> 'สั่งพิมพ์','width'=>'48px','style'=>'cursor:pointer'));
                        ?>
                    </div>
                    <div class="col-xs-6" id="donut-chart" style="height: 200px;"></div>
                    <div class="col-xs-6" >
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">สถานะเรื่องร้องทุกข์</th>
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
                    </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                                <tr>
                                    <th class="text-center" rowspan="2">สถานะเรื่องร้องทุกข์</th>
                                    <th class="text-center" colspan="4">สถิติรายเดือน</th>
                                    <th class="text-center" rowspan="2">รวม</th>
                                </tr>
                                <tr>
                                    <?php for($i=3;$i>=0;$i--){ ?>
                                    <th class="text-center"><?php echo date_thai(date('Y-m',strtotime('-'.$i.' month')),false,"m y"); ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                    <?php //echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
<script>
/*
         * DONUT CHART
         * -----------
         */

        var donutData = [
          {label: "Series2", data: 30, color: "#3c8dbc"},
          {label: "Series3", data: 20, color: "#0073b7"},
          {label: "Series4", data: 50, color: "#00c0ef"}
        ];
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 1,
              innerRadius: 0.5,
              label: {
                show: true,
                radius: 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: false
          }
        });
        /*
         * END DONUT CHART
         */
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
