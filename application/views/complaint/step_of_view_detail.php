<?php
$link = array(
    'href' => '/assets/css/step.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
$step_array = array();
$step_array[1]['name'] = 'อยู่ระหว่างรับเรื่อง';
$step_array[1]['color'] = 'btn-danger';
$step_array[2]['name'] = 'รับเรื่อง';
$step_array[2]['color'] = 'btn-warning';
$step_array[3]['name'] = 'ส่งต่อ';
$step_array[3]['color'] = 'btn-primary';
$step_array[4]['name'] = 'บันทึกผลเรียบร้อย';
$step_array[4]['color'] = 'btn-success';
?>
        <div class="stepwizard col-md-offset-0">
            <div class="stepwizard-row setup-panel">
                <?php foreach($step_array as $key => $value){
                    if(@$key_in_data['current_status_id'] == $key){
                        $btn = $value['color'];
                    }else{
                        $btn = 'btn-default';
                    }
                    ?>
                <div class="stepwizard-step" style="width:25%;">
                        <a type="button" class="btn <?php echo $btn; ?> btn-circle" ><?php echo $key; ?></a>
                        <p><?php echo $value['name']; ?></p>
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