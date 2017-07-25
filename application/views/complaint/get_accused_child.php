<?php
if(!array_key_exists('message', @$accused_type_lists)){ ?>
<div>
    <?php
        $list = @$accused_type_lists;
        $list[''] = 'กรุณาเลือก';
        ksort($list);
        echo form_dropdown([
            'id' => 'accused_type_id_'.$count_acc,
            'class' => 'form-control',
            'has_child'=>'accused_child_'.$count_acc,
            'onchange'=>"get_accused_child(this)"
        ], $list,'');
    ?>
    <span id="accused_child_<?php echo $count_acc; ?>">

    </span>
</div>
<?php } ?>
