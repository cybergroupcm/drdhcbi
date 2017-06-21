<style>
    .btn-info {
        background-color: #4db6ac;
        border-color: #4db6ac;
    }
    .btn-info.hover{background-color:#4db6ac}
</style>
    <section class="content-header">
        <h1>&nbsp;</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">ตั้งค่าข้อมูลประเภทผู้ถูกร้องเรียน</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12 text-right" style="margin-bottom: 5px;">
                            <button class="btn btn-info" title="เพิ่ม" id="bt_add" onclick="window.location.href='<?php echo base_url('setting_accused_type/add')?>';"><i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                        </div>
                        <table id="example1" class="table table-bordered table-striped table-hover dataTable">
                            <tr>
                                <th width="20%" class="text-center">รหัสประเภทผู้ถูกร้องเรียน</th>
                                <th class="text-center">ประเภทผู้ถูกร้องเรียน</th>
                                <th width="15%" class="text-center">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($data AS $val) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $val['accused_type_id'];?></td>
                                    <td><?php echo $val['accused_type'];?></td>
                                    <td class="text-center">
                                        <span onclick="window.location.href='<?php echo base_url('setting_accused_type/add/'.$val['accused_type_id'])?>';">
                                            <?php echo img(array('src'=>'assets/images/edit.png', 'title'=> 'แก้ไข','width'=>'36px','style'=>'cursor:pointer'));?>
                                        </span>
                                        <span class="bt_delete" id="<?php echo $val['accused_type_id'];?>">
                                            <?php echo img(array('src'=>'assets/images/bin.png', 'title'=> 'ลบ','width'=>'36px','style'=>'cursor:pointer'));?>
                                        </span>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div id="base_url" class="<?php echo base_url();?>"></div>
<script>
    $( document ).ready(function() {
        $('.bt_delete').click(function(){
            swal({title: "คุณต้องการจะลบข้อมูลหรือไม่?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ใช่, ต้องการจะลบข้อมูล!",
                    cancelButtonText: "ไม่",
                    closeOnConfirm: false},
                function () {
                    var  link = $('#base_url').attr("class")+"setting_accused_type/dashboard";
                    window.location = link;
                });
        });
    });
</script>
