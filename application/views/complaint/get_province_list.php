<?php
    $list = @$province_list;
    $list[''] = 'กรุณาเลือก';
    ksort($list);
    echo form_dropdown([
        'id' => 'province_id',
        'name' => 'province_id',
        'class' => 'form-control',
        'onchange' => "get_district(this.value,'')"
    ], $list, @$default);
?>