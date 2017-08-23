<?php
$link = array(
    'href' => '/assets/css/step.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
$step_array = array();
$step_array[1] = 'บันทึกเรื่องร้องทุกข์';
$step_array[2] = 'เนื้อหา';
$step_array[3] = 'ความประสงค์';
$step_array[4] = 'หลักฐาน';
$step_array[5] = 'สรุปข้อมูล';
<<<<<<< HEAD
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
                <div class="stepwizard-step" style="width:20%;">
                        <a type="button" class="btn <?php echo $btn; ?> btn-circle" <?php echo $disabled; ?> onclick="location.href='<?php echo base_url('complaint/key_in/key_in_step'.$key.'/'.@$id); ?>'"><?php echo $key; ?></a>
                        <p><?php echo $value; ?></p>
                </div>
                <?php } ?>
=======
//echo $key_in_data['step'];
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <?php foreach($step_array as $key => $value) {
                        if ($key > $step ) {
                            $class = '';
                        }elseif( $step == $key ){
                            $class = 'active';
                        } else {
                            $class = 'completed';
                        }
                        ?>
                        <li class="<?php echo $class;?>">
                            <a style="cursor: pointer;" onclick="location.href='<?php echo base_url('complaint/key_in/key_in_step' . $key . '/' . @$id); ?>'"><?php echo $step_array[$key]; ?></a>
                        </li>
                        <?php
                            }
                        ?>
                </ul>
>>>>>>> 707d20ae57d2ad41907c4143a15227e0eb5007b0
            </div>
        </div>
    </div>
<?php
$link = array(
    'src' => 'assets/js/step.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>