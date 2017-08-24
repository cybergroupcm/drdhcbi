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
                    <h3 class="box-title">รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (เรื่องค้าง)</h3>
                </div>
                <div class="box-body">
<!--                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">-->
<!--                        --><?php
//                            $param_pdf = "?year=".$_GET['year']."&current_status_id=".$_GET['complain_type_id']."&partid=".$_GET['partid']."&province_id=".$_GET['province_id']."&district_id=".$_GET['district_id']."&address_id=".$_GET['address_id'];
//                        ?>
<!--                            <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล">-->
<!--                                <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>-->
<!--                            </a>-->
<!--                            <a href="--><?php //echo base_url('report_result_progress/pdf'.$param_pdf); ?><!--" class="btn btn-default" role="button"  title="สั่งพิมพ์" target="_blank">-->
<!--                                <i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>-->
<!--                            </a>-->
<!--                            <a href="--><?php //echo base_url('report_result_progress/excel'.$param_pdf); ?><!--" class="btn btn-default" role="button" title="ส่งออก Excel" target="_blank">-->
<!--                                <i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>-->
<!--                            </a>-->
<!--                    </div>-->
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <?php
                        $col_data = count(@$complaint_type)+1;
                        ?>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ที่</th>
                            <th class="text-center" style="vertical-align: middle;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo $col_data;?>">ผลการดำเนินการในเดือน <u>กรกฏาคม 2560</u></th>
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
                        $col_sub = ($col_data*2)+3;
                        foreach($main_data AS $key_main => $value_main) {
                            ?>
                            <tr>
                                <td colspan="<?php echo $col_sub ?>"><?php echo "2.".$key_main." ".$value_main ?></td>
                            </tr>
                        <?php
                            foreach($sub_data[$key_main] AS $key_sub => $value_sub){
                                ?>
                                <tr>
                                    <td></td>
                                    <td >- <?php echo  $value_sub?></td>
                                    <?php
                                    foreach ($complaint_type AS $key => $value) {
                                        echo '<td class="text-center"  style="vertical-align: top;width: 6%;">' .$sub_detail_report[$key_sub][$key] . '</td>';
                                        $index_complaint++;
                                    }
                                    ?>
                                    <td><?php echo array_sum($sub_detail_report[$key_sub])?></td>
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
