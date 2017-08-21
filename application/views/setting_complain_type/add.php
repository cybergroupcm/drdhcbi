
<!--<form class="form-horizontal" role="form" method="POST" action="--><?php //echo base_url('setting_complain_type/dashboard')?><!--" name="form_add" id="form_add">-->
    <style>
        .btn-info {
            background-color: #4db6ac;
            border-color: #4db6ac;
        }
        .btn-info.hover{background-color:#4db6ac}
        .dd-selected{
            padding: 4px;
        }
        .dd-option{
            padding: 4px;
        }
    </style>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">เพิ่ม/แก้ไขข้อมูลประเภทเรื่องร้องทุกข์</h3>
                    </div>
                    <div class="box-body"  style="height: 400px;">
                        <div class="row">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="col-sm-5 text-right">
                                            รหัสประเภทเรื่องร้องทุกข์ :
                                        </label>
                                        <label class="col-sm-3">
                                            <input type="hidden" id="parent_id" name="parent_id" value="<?php echo @($_GET['type'] == 'parent')?$_GET['parent_id']:"0";?>"/>
                                            <input type="hidden" id="action"  value="<?php echo @$data['action'];?>"/>
                                            <input type="text" name="complain_type_id" id="complain_type_id" class="form-control" value="<?php echo @$data['complain_type_id'];?>" readonly="readonly" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="col-sm-5 text-right">
                                            ประเภทเรื่องร้องทุกข์ :
                                        </label>
                                        <label class="col-sm-7">
                                            <input type="text" name="complain_type_name" id="complain_type_name" class="form-control" value="<?php echo @$data['complain_type_name'];?>" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            $show_list_icon=@($_GET['type'] == 'parent')?'style="display: none;"':'';
                        ?>
                        <div class="row" <?php echo $show_list_icon;?>>
                            <div class="col-md-12">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label class="col-sm-5 text-right">
                                            สัญลักษณ์บนแผนที่ :
                                        </label>
                                        <label class="col-sm-7">
                                            <?php
                                                $arr_pin_icon = array(
                                                    '0'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map1.png'
                                                    ),
                                                    '1'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map2.png'
                                                    ),
                                                    '2'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map3.png'
                                                    ),
                                                    '3'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map4.png'
                                                    ),
                                                    '4'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map5.png'
                                                    ),
                                                    '5'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map6.png'
                                                    ),
                                                    '6'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map7.png'
                                                    ),
                                                    '7'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map8.png'
                                                    ),
                                                    '8'=>array(
                                                        'title'=>'',
                                                        'icon'=>'pin-map9.png'
                                                    )
                                                );
                                            ?>

                                            <select id="list_icon_pin" name="list_icon_pin">
                                                <?php
                                                foreach($arr_pin_icon AS $key=>$val) {
                                                    if($data['icon_pin'] == $val['icon']){
                                                        $selected = 'selected=selected';
                                                    }else{
                                                        $selected = '';
                                                    }
                                                    echo '<option value="'.$val['icon'].'" data-imagesrc="' . base_url('assets/images/'.$val['icon'].'') . '"data-description="" '.$selected.'>'.$val['title'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <input type="hidden" name="icon_pin" id="icon_pin" value="<?php echo $data['icon_pin'];?>">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-info" title="เพิ่ม" id="bt_add"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                                <button class="btn btn-info" title="ยกเลิก" id="bt_cancel"  onclick="window.location.href='<?php echo base_url();?>setting_complain_type/dashboard'"><i class="fa fa-times"></i> ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="base_url" class="<?php echo base_url();?>"></div>
<!--</form>-->
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/setting_complain_type.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/jquery.ddslick.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>

<script>
    //Dropdown plugin data
    var ddData = [];

    $('#list_icon_pin').ddslick({
        data: ddData,
        width: 80,
        imagePosition: "left",
        selectText: "",
        onSelected: function (data) {
            //console.log(data);
            //console.log(data.selectedData.value);
            $('#icon_pin').val(data.selectedData.value);
        }
    });

</script>
