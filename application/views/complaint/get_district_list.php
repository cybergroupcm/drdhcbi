<?php
    $list = @$test_list[@$id];
    $list[''] = '--กรุณาเลือก--';
    ksort($list);
    echo form_dropdown([
        'name' => 'district_id',
        'id' => 'district_id',
        'class' => 'form-control',
        'onchange'=>"get_subdistrict(this.value,'')"
    ], $list, @$default);
?>