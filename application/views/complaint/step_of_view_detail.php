<?php
$link = array(
    'href' => '/assets/css/step.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
$step_array = array();
$step_array[1]['name'] = 'อยู่ระหว่างตรวจสอบ';
$step_array[1]['color'] = 'btn-danger';
$step_array[2]['name'] = 'รับเรื่อง';
$step_array[2]['color'] = 'btn-warning';
$step_array[3]['name'] = 'ส่งต่อ';
$step_array[3]['color'] = 'btn-primary';
$step_array[4]['name'] = 'ยุติ/ดำเนินการแล้ว';
$step_array[4]['color'] = 'btn-success';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <?php foreach($step_array as $key => $value) {
                        if ($key > @$key_in_data['current_status_id'] ) {
                            $class = '';
                        }elseif( @$key_in_data['current_status_id'] == $key ){
                            $class = 'active';
                        } else {
                            $class = 'completed';
                        }
                        ?>
                        <li class="<?php echo $class;?>">
                            <a style="cursor:default;"><?php echo $step_array[$key]['name']; ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

<!--        <div class="stepwizard col-md-offset-0">-->
<!--            <div class="stepwizard-row setup-panel">-->
<!--                --><?php //foreach($step_array as $key => $value){
//                    if(@$key_in_data['current_status_id'] == $key){
//                        $btn = $value['color'];
//                    }else{
//                        $btn = 'btn-default';
//                    }
//                    ?>
<!--                <div class="stepwizard-step" style="width:25%;">-->
<!--                        <a type="button" class="btn --><?php //echo $btn; ?><!-- btn-circle" disabled="disabled">--><?php //echo $key; ?><!--</a>-->
<!--                        <p>--><?php //echo $value['name']; ?><!--</p>-->
<!--                </div>-->
<!--                --><?php //} ?>
<!--            </div>-->
<!--        </div>-->
<?php
$link = array(
    'src' => 'assets/js/step.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>