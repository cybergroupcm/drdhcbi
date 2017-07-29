<?php
if(!array_key_exists('message', @$lists)){ ?>
<div>
    <?php
        $list_select = @$lists;
        $list_select[''] = 'กรุณาเลือก';
        ksort($list_select);
        echo form_dropdown([
            'id' => 'send_org_id_'.$count_type,
            'class' => 'form-control',
            'has_child'=>'send_org_child_'.$count_type,
            'onchange'=>"get_send_org_child(this)"
        ], $list_select,'');
    ?>
    <span id="send_org_child_<?php echo $count_type; ?>">

    </span>
</div>
<?php } ?>
