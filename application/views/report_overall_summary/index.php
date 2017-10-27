<?php
/**
 * Created by PhpStorm.
 * User: wisedsmac
 * Date: 8/23/2017 AD
 * Time: 21:02
 */
if( !isset($_GET['yy']) || $_GET['yy'] == '' ){
    $_GET['yy'] = date('Y');
}
if( !isset($_GET['mm']) || $_GET['mm'] == '' ){
    $_GET['mm'] = date('m');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right" style="padding: 15px;">
            <a href="#" class="btn btn-default" role="button" data-toggle="modal" data-target="#search" title="ค้นหาข้อมูล">
                <i class="fa fa-search" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
            </a>
            <a href="<?php echo base_url('Report_overall_summary/pdf?yy='.@$_GET['yy'].'&mm='.@$_GET['mm']); ?>" class="btn btn-default" role="button"  title="สั่งพิมพ์" target="_blank">
                <i class="fa fa-print" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
            </a>
            <a href="<?php echo base_url('Report_overall_summary/excel?yy='.@$_GET['yy'].'&mm='.@$_GET['mm']); ?>" class="btn btn-default" role="button" title="ส่งออก Excel" target="_blank">
                <i class="fa fa-file-excel-o" aria-hidden="true" style="cursor: pointer;font-size: 2em;"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <iframe src="<?php echo base_url('report_performance_new/view?yy='.@$_GET['yy'].'&mm='.@$_GET['mm']); ?>" width="100%" style="border:0px; height: 900px;"></iframe>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <iframe src="<?php echo base_url('report_result_stale/view?yy='.@$_GET['yy'].'&mm='.@$_GET['mm']); ?>" width="100%" style="border:0px; height: 1100px;"></iframe>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <iframe src="<?php echo base_url('report_result_progress/view?yy='.@$_GET['yy'].'&mm='.@$_GET['mm']); ?>" width="100%" style="border:0px; height: 1200px;"></iframe>
        </div>
    </div>
</div>
<div class="example-modal">
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ค้นหาข้อมูล</h4>
                </div>
                <form class="form-horizontal" role="form" method="GET" action="" name="form_search" id="form_search">
                    <div class="modal-body" style="margin-left: -30px;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right" style="padding-top:10px;">
                                    เดือน :
                                </label>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-left">
                                    <?php
                                    $monthList = array();
                                    $monthList['01'] = 'มกราคม';
                                    $monthList['02'] = 'กุมภาพันธ์';
                                    $monthList['03'] = 'มีนาคม';
                                    $monthList['04'] = 'เมษายน';
                                    $monthList['05'] = 'พฤษภาคม';
                                    $monthList['06'] = 'มิถุนายน';
                                    $monthList['07'] = 'กรกฎาคม';
                                    $monthList['08'] = 'สิงหาคม';
                                    $monthList['09'] = 'กันยายน';
                                    $monthList['10'] = 'ตุลาคม';
                                    $monthList['11'] = 'พฤศจิกายน';
                                    $monthList['12'] = 'ธันวาคม';
                                    echo form_dropdown([
                                        'id' => 'mm',
                                        'name'=>'mm',
                                        'class' => 'form-control'
                                    ], $monthList, @$_GET['mm']);
                                    ?>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <label class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right" style="padding-top:10px;">
                                    ปี :
                                </label>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-left">
                                    <?php
                                    $yearList = array();
                                    for($i = 2007;$i <= date('Y');$i++){
                                        $yearList[$i] = $i+543;
                                    }
                                    echo form_dropdown([
                                        'id' => 'yy',
                                        'name'=>'yy',
                                        'class' => 'form-control'
                                    ], $yearList, @$_GET['yy']);
                                    ?>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="text-align: center;">
                        <input type="submit" name="btSearch" id="btSearch" class="btn btn-primary" value="ค้นหาข้อมูล">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

