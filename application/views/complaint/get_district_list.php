<?php
    $list = @$district_list;
    $list[''] = 'กรุณาเลือก';
    ksort($list);
    echo form_dropdown([
        'name' => 'district_id',
        'id' => 'district_id',
        'class' => 'form-control',
        'onchange'=>$type=='Aumpur'?"get_subdistrict(this.value,'')":""
    ], $list, @$default);
?>