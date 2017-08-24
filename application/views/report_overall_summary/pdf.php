<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div style="text-align: right;font-size: 13px;">
                    <span>
                        แบบรายงานทุกเดือน
                    </span>
                </div>
                <div style="text-align: right;font-size: 13px;">
                        วันที่ปรับปรุงข้อมูล : <?php echo date_thai(date('Y-m-d'), true,'d m y');?>
                </div>
                <div style="text-align: right;font-size: 13px;">
                    ผู้รายงาน : <?php echo $user_report['user_name'];?>
                </div>
                <div style="text-align: right;font-size: 13px;">
                    ตำแหน่ง : <?php echo $user_report['user_position'];?>
                </div>
                <?php $this->load->view('report_performance_new/pdf');?>
                <br>
                <?php $this->load->view('report_result_stale/pdf');?>
                <br>
                <?php $this->load->view('report_result_progress/pdf');?>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
