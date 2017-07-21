<?php
$link = array(
    'src' => 'assets/jquery/jQuery-2.1.3.min.js',
    'type' => 'text/javascript'
);
    echo script_tag($link);
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
                    <div id="exportData">
                        <table id="example1" style="border:1px solid;" cellspacing="0" cellpadding="0">
                            <thead>
                            <tr>
                                <th style="border-right:1px solid;border-bottom:1px solid;" rowspan="2">ประเภทการร้องทุกข์</th>
                                <th style="border-bottom:1px solid;border-right:1px solid;" colspan="<?php echo count($channel);?>">ช่องทางการร้องทุกข์</th>
                                <th style="border-bottom:1px solid;" rowspan="2">รวม</th>
                            </tr>
                            <tr>
                                <?php foreach($channel as $key => $value){ ?>
                                    <th style="border-right:1px solid;border-bottom:1px solid;"><?php echo $value; ?></th>
                                <?php } ?>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($complaint_type as $key => $value){ ?>
                                <tr>
                                    <td style="border-right:1px solid;border-bottom:1px solid;padding:10 0 10 0px;"><?php echo $value; ?></td>
                                    <?php foreach($channel as $key2 => $value2){ ?>
                                        <td align="right" style="border-right:1px solid;border-bottom:1px solid;padding:10 2 10 0px;"><?php echo replace_empty(@$data[$key][$key2]); ?></td>
                                        <?php
                                        @$data[$key]['sum_all'] += replace_empty(@$data[$key][$key2]);
                                    } ?>
                                    <td align="right" style="border-bottom:1px solid;padding:10 2 10 0px;"><?php echo replace_empty(@$data[$key]['sum_all']); ?></td>
                                </tr>
                                <?php $sum_all += replace_empty(@$data[$key]['sum_all']); } ?>
                            <tr>
                                <td align="center" style="border-right:1px solid;padding:10 0 10 0px;">รวม</td>
                                <?php foreach($channel as $key2 => $value2){ ?>
                                    <td align="right" style="border-right:1px solid;padding:10 0 10 0px;"><?php echo replace_empty(@$data['sum_all'][$key2]); ?></td>
                                <?php } ?>
                                <td align="right" style="padding:10 0 10 0px;"><?php echo $sum_all; ?></td>
                            </tr>
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