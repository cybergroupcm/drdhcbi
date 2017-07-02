<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css">
<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/assets/css/checkbox.css">
            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo 'แก้ไขข้อมูล'; ?></h3>
                                </div>
                                <div class="box-body">
                                    <?php echo $message;?>

                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-edit_group','onSubmit'=>'save()')); ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">ชื่อกลุ่ม : </label>
                                            <div class="col-sm-10">
                                                <?php echo form_input($group_name);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">คำอธิบาย : </label>
                                            <div class="col-sm-10">
                                                <?php echo form_input($group_description); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">สี : </label>
                                            <div class="col-sm-3">
                                                <?php echo form_input($group_bgcolor); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title"><?php echo 'สิทธิ์การใช้งาน'; ?></h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div>
                                                                <?php echo form_input($jsfields); ?>
                                                                <!--<input type="hidden" name="jsfields" id="jsfields" value="">-->
                                                                <div id="jstree_div">
                                                                    <?php echo $orgTree;?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            </div>
                                                       <!-- <div class="col-sm-12">
                                                            <?php /*foreach($applications as $key => $value){ */?>
                                                                <div class="col-sm-12 text-left">
                                                                    <div class="checkbox checkbox-<?php /*echo $value['checkbox_type'];*/?>">
                                                                        <input id="checkbox<?php /*echo $value['app_id'];*/?>" type="checkbox">
                                                                        <label for="checkbox<?php /*echo $value['app_id'];*/?>">
                                                                            <?php /*echo $value['app_name'];*/?>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            <?php /*} */?>
                                                        </div>-->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/groups', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>

<?php
/*$link = array(
    'src' => 'assets/js/user/group.js',
    'type' => 'text/javascript'
);
echo script_tag($link);*/
?>