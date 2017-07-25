<?php
if(!array_key_exists('message', @$complain_type_lists)){ ?>
<div>
    <?php
        $list = @$complain_type_lists;
        $list[''] = 'กรุณาเลือก';
        ksort($list);
        echo form_dropdown([
            'id' => 'complain_type_id_'.$count_type,
            'class' => 'form-control',
            'has_child'=>'complain_child_'.$count_type,
            'onchange'=>"get_complain_type_child(this)"
        ], $list,'');
    ?>
    <span id="complain_child_<?php echo $count_type; ?>">

    </span>
</div>
<?php } ?>
