<?php
$link = array(
    'src' => 'assets/jquery/jQuery-2.1.3.min.js',
    'type' => 'text/javascript'
);
    echo script_tag($link);
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> รายงานรวมเรื่องร้องทุกข์</h3>
                </div>
                <div class="box-body">
                    <div id="exportData">
                        <table border="1" id="example1" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                            <tr>
                                <th class="text-center" rowspan="2">ประเภทการร้องทุกข์</th>
                                <th class="text-center" colspan="12">ช่องทางการร้องทุกข์</th>
                            </tr>
                            <tr>
                                <th class="text-center">มาด้วยตนเอง</th>
                                <th class="text-center">โทรศัพท์/โทรสาร/ฝากข้อความอัตโนมัติ 1567</th>
                                <th class="text-center">สำนักนายกรัฐมนตรี 1111</th>
                                <th class="text-center">จดหมาย</th>
                                <th class="text-center">สำนักงานรัฐมนตรีกระทรวงมหาดไทย</th>
                                <th class="text-center">ศูนย์ดำรงธรรมจังหวัด</th>
                                <th class="text-center">ปลัดกระทรวงมหาดไทย</th>
                                <th class="text-center">กระทรวง/กรม/อื่นๆ</th>
                                <th class="text-center">ผ่าน สนง.ผู้ตรวจการแผ่นดิน</th>
                                <th class="text-center">ศูนย์ดำรงธรรมอำเภอ</th>
                                <th class="text-center">ศูนย์ดำรงธรรมส่วนกลาง</th>
                                <th class="text-center">รวม</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <?php //echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
<script>
    function exportExcel(){
            var headContent = $('head').html();
            var bodyContent = $('#exportData').html();
            $.ajax({
                method: "POST",
                url: "<?php echo base_url();?>html2doc/html2doc_setContent.php",
                data: {htmlHead : headContent, htmlBody : bodyContent, apptype : 'application/vnd.ms-excel', filetype : 'xls', exportData : 'on', filename : '', logFile : '', logPathFile : ''}
            }) .done(function( msg ) {
                if($.trim(msg) == 'ok'){
                    window.open('<?php echo base_url();?>html2doc/html2doc.php','_blank');
                    window.close();
                }
            });
    }
</script>
<script>
    $(document).ready(function(){
        exportExcel();
    });
</script>