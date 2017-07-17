<?php
$link = array(
    'href' => '/assets/css/step.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
$step_array = array();
$step_array[1] = 'บันทึกเรื่องร้องทุกข์/ร้องเรียน';
$step_array[2] = 'ความประสงค์ในการดำเนินการ';
$step_array[3] = 'เนื้อหาเรื่องร้องทุกข์ร้องเรียน';
$step_array[4] = 'หลักฐานประกอบเรื่องร้องเรียน/ร้องทุกข์';
$step_array[5] = 'สรุปข้อมูลเรื่องร้องเรียน/ร้องทุกข์';
?>
        <div class="stepwizard col-md-offset-0">
            <div class="stepwizard-row setup-panel">
                <?php foreach($step_array as $key => $value){
                    if($step == $key){
                        $btn = 'btn-primary';
                    }else{
                        $btn = 'btn-default';
                    }
                    if($key <= $key_in_data['step']+1){
                        $disabled = '';
                    }else{
                        $disabled = 'disabled="disabled"';
                    }
                    ?>
                <div class="stepwizard-step">
                        <a type="button" class="btn <?php echo $btn; ?> btn-circle" <?php echo $disabled; ?> onclick="validateForm('key_in_step<?php echo $key; ?>','')"><?php echo $key; ?></a>
                        <p><?php echo $value; ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
<?php
$link = array(
    'src' => 'assets/js/step.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>