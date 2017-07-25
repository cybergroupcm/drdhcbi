<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style>
    .main-header{
        display: none;
    }
    .main-sidebar{
        display: none;
    }
    .main-footer{
        display: none;
    }
    .content-wrapper{
        padding-top: 0px !important;
        margin-left: 0px !important;
    }
    .wrapper{
        background-image: none !important;
        background: #ffffff !important;
    }
    .content-wrapper{
        background: #ffffff !important;
    }
</style>
<?php echo form_open('admin/users/deactivate/'. $id, array('class' => 'form-horizontal', 'id' => 'form-status_user')); ?>
<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-11 col-md-11 text-left">
                <label class="radio-inline">
                    <input type="radio" name="confirm" id="confirm1" value="yes" checked="checked"><?php echo 'ใช่'; ?>
                </label>
                <label class="radio-inline">
                    <input type="radio" name="confirm" id="confirm0" value="no"><?php echo 'ไม่ใช่'; ?>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
        <?php echo form_hidden($csrf); ?>
        <?php echo form_hidden(array('id'=>$id)); ?>
        <div class="btn-group">
        </div>
    </div>
</div>
<?php echo form_close();?>
