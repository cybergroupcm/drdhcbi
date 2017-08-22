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