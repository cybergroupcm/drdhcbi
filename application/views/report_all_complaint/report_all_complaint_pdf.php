<?php
function replace_empty($value){
    if($value==''){
        return '0';
    }else{
        return $value;
    }
}
?>
    <h3 class="box-title"> รายงานรวมเรื่องร้องทุกข์</h3>
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
