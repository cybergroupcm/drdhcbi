<?php
    $list = @$test_list[@$id];
    $list[''] = '--กรุณาเลือก--';
    ksort($list);
    echo form_dropdown([
        'name' => 'subdistrict_id',
        'id' => 'subdistrict_id',
        'class' => 'form-control'
    ], $list, @$default);
?>