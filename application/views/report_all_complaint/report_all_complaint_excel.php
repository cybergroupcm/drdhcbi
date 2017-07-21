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
<div id="exportData">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table style="width: 100%;border-collapse: collapse;font-size: 16pt;">
                            <thead>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;text-align: center;padding: 5px;" colspan="<?php echo count($channel)+2;?>">รายงานรวมเรื่องร้องทุกข์</th>
                            </tr>
                            <tr>
                                <th style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;" rowspan="2">ประเภทการร้องทุกข์</th>
                                <th style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;padding: 5px;" colspan="<?php echo count($channel);?>">ช่องทางการร้องทุกข์</th>
                                <th style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width: 6%;" rowspan="2">รวม</th>
                            </tr>
                            <tr>
                                <?php foreach($channel as $key => $value){ ?>
                                    <th style="vertical-align: middle;text-align: center;border: 1px solid black;border-width:thin;width:6%;"><?php echo $value; ?></th>
                                <?php } ?>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($complaint_type as $key => $value){ ?>
                                <tr>
                                    <td style="text-align: left;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;"><?php echo $value; ?></td>
                                    <?php foreach($channel as $key2 => $value2){ ?>
                                        <td align="right" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;"><?php echo replace_empty(@$data[$key][$key2]); ?></td>
                                        <?php
                                        @$data[$key]['sum_all'] += replace_empty(@$data[$key][$key2]);
                                    } ?>
                                    <td align="right" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;"><?php echo replace_empty(@$data[$key]['sum_all']); ?></td>
                                </tr>
                                <?php $sum_all += replace_empty(@$data[$key]['sum_all']); } ?>
                            <tr>
                                <td align="center" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;">รวม</td>
                                <?php foreach($channel as $key2 => $value2){ ?>
                                    <td align="right" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;"><?php echo replace_empty(@$data['sum_all'][$key2]); ?></td>
                                <?php } ?>
                                <td align="right" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-width:thin;vertical-align: top;padding: 5px;"><?php echo $sum_all; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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