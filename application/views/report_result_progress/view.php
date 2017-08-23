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

//$this->load->view('report_result_progress/search');

?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">รายงานผลการดำเนินการแก้ไขปัญหาเรื่องร้องเรียนขอศูนย์ดำรงธรรมจังหวัดชลบุรี</h3>
                </div>
                <div class="col-xs-12 text-left">
                    ตั้งแต่เดือนตุลาคม 2557 – กรกฎาคม 2560
                </div>
                <div class="box-body">
                    <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                        <?php
                            $param_pdf = "?year=".$_GET['year']."&current_status_id=".$_GET['complain_type_id']."&partid=".$_GET['partid']."&province_id=".$_GET['province_id']."&district_id=".$_GET['district_id']."&address_id=".$_GET['address_id'];
                        ?>
                            <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล">
                                <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                            <a href="<?php echo base_url('report_result_progress/pdf'.$param_pdf); ?>" class="btn btn-default" role="button"  title="สั่งพิมพ์" target="_blank">
                                <i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                            <a href="<?php echo base_url('report_result_progress/excel'.$param_pdf); ?>" class="btn btn-default" role="button" title="ส่งออก Excel" target="_blank">
                                <i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
                            </a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;width: 15%;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo (count(@$complaint_type)+1);?>">
                                ผลการดำเนินการในเดือน กรกฎาคม 2560
                            </th>
                            <th class="text-center" style="vertical-align: middle;" colspan="<?php echo (count(@$progress_type)+1);?>">
                                ผลการดำเนินงาน
                            </th>
                        </tr>
                        <tr>
                            <?php
                            $i=0;
                            foreach($complaint_type AS $key_complaint=>$val_complaint){
                                $i++;
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$i.'.<br>'.$val_complaint.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;width: 6%;">รวมทั้งสิ้น</th>';

                            foreach($progress_type AS $key_progress1=>$val_progress1){
                                echo '<th class="text-center" style="vertical-align: middle;width: 6%;">'.$val_progress1.'</th>';
                            }
                            echo '<th class="text-center" style="vertical-align: middle;width: 6%;">รวมทั้งสิ้น</th>';
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($result_progress AS $key_result=>$val) {
                            echo '<tr>';
                            echo '<td class="text-left" colspan="11">'.$val['result']['column1'].'</td>';
                            echo '</tr>';
                            ###############รายเดือน
                            foreach($val['result_sub'] AS $key_sub => $val_sub){
                                echo '<tr>';
                                echo '<td class="text-left">'.$val_sub['column1'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column2'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column3'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column4'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column5'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column6'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column7'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column8'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column9'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column10'].'</td>';
                                echo '<td class="text-center">'.$val_sub['column11'].'</td>';
                                echo '</tr>';
                            }
                            ###############รวม
                            if($val['result_sum'] != '') {
                                echo '<tr>';
                                echo '<td class="text-right">' . $val['result_sum']['column1'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column2'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column3'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column4'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column5'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column6'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column7'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column8'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column9'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column10'] . '</td>';
                                echo '<td class="text-center">' . $val['result_sum']['column11'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
