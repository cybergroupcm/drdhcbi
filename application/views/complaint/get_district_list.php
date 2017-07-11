<?php
    $list = @$district_list;
    $list[''] = 'กรุณาเลือก';
    ksort($list);
    echo form_dropdown([
        'name' => $type=='Aumpur'?'':'address_id',
        'id' => $type=='Aumpur'?'':'address_id',
        'class' => 'form-control',
        'onchange'=>$type=='Aumpur'?"get_subdistrict(this.value,'')":""
    ], $list, @$default);
?>