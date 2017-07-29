<?php
$i = 0;
foreach($send_org as $key => $value){ ?>
<span id="send_org_space_<?php echo $i; ?>">
    <?php
    $i++;
    $send_org_list = $send_org[$key];
    $send_org_list[''] = 'กรุณาเลือก';
    ksort($send_org_list);
    echo form_dropdown([
        'id' => 'send_org_'.$i,
        'class' => 'form-control',
        'has_child'=>'send_org_space_'.$i,
        'onchange' => 'get_send_org_child(this)'
    ], $send_org_list, $get_send_org[$key]);
    }
    ?>
    <span id="send_org_space_<?php echo $i; ?>">

    </span>
    <?php
    foreach($send_org as $key => $value){
        echo"</span>";
    }
    ?>
