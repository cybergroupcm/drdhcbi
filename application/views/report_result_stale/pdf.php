<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div style="text-align: left;font-size: 13px;font-weight: bold;">
                    <span>
                        2. รายงานผลการดำเนินงานแก้ไขปัญหาเรื่องร้องเรียนของศูนย์ดำรงธรรมจังหวัด (คงค้าง)
                    </span>
                </div>
                <div class="box-body">
                    <?php
                    $yymm=$_GET['yy'].'-'.$_GET['mm'];
                    ?>
                    <table style="width: 100%;border-collapse: collapse;font-size: 13px;">
                        <thead>
                        <?php
                        $col_data = count(@$complaint_type)+1;
                        ?>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;padding: 5px;" rowspan="2">ตัวชี้วัด</th>
                            <th class="text-center" style="vertical-align: middle;border: 1px solid black;padding: 5px;" colspan="<?php echo $col_data;?>">ผลการดำเนินการในเดือน <u><?php echo date_thai($yymm.'-01', true,'m y');?></u></th>
                        </tr>
                        <tr>
                            <?php
                            $index_complaint = 1;
                            foreach ($complaint_type AS $key => $value) {
                                echo '<th class="text-center"  style="vertical-align: top;width: 10%;border: 1px solid black;padding: 5px;"> '. $index_complaint.' . '.$value . '</th>';
                                $index_complaint++;
                            }
                            ?>
                            <th class="text-center"  style="vertical-align: top;width: 10%;border: 1px solid black;padding: 5px;">รวมทั้งสิ้น</th>
                            <?php
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $col_sub = ($col_data)+1;
                        foreach($main_data AS $key_main => $value_main) {
                        ?>
                            <tr>
                                <td style="vertical-align: top;border: 1px solid black;padding: 5px;" colspan="<?php echo $col_sub ?>"><?php echo "2.".$key_main." ".$value_main ?></td>
                            </tr>
                        <?php
                            foreach($sub_data[$key_main] AS $key_sub => $value_sub){
                                ?>
                                <tr>
                                    <td style="vertical-align: top;border: 1px solid black;padding: 5px;">&nbsp;- <?php echo  $value_sub?></td>
                                    <?php
                                    foreach ($complaint_type AS $key => $value) {
                                        echo '<td class="text-center"  style="vertical-align: top;border: 1px solid black;text-align: right;padding: 5px;">' .number_format($sub_detail_report[$key_main][$key_sub][$key]) . '</td>';
                                        $index_complaint++;
                                    }
                                    ?>
                                    <td style="vertical-align: top;border: 1px solid black;text-align: right;padding: 5px;"><?php echo number_format(array_sum($sub_detail_report[$key_main][$key_sub]))?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="base_url" class="<?php echo base_url();?>"></div>
