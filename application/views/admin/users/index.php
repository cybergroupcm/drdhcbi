<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$link = array(
    'href' => 'assets/css/dataTables.bootstrap.min.css',
    'rel' => 'stylesheet',
    'type' => 'text/css'
);
echo link_tag($link);
$link = array(
    'src' => 'assets/js/jquery.dataTables.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/dataTables.bootstrap.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/user/index.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header" style="text-align: right;">
                                    <div class="col-md-12">
                                        <h3 class="box-title"><?php echo anchor('admin/users/create', '<i class="fa fa-plus"></i> '. lang('users_create_user'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table id="usertable" class="table table-bordered table-striped table-hover dataTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo 'ชื่อ';?></th>
                                                <th class="text-center"><?php echo 'นามสกุล';?></th>
                                                <th class="text-center"><?php echo 'อีเมลล์';?></th>
                                                <th class="text-center"><?php echo 'กลุ่มผู้ใช้งาน';?></th>
                                                <th class="text-center"><?php echo 'สถานะการใช้งาน';?></th>
                                                <th class="text-center"><?php echo 'เครื่องมือ';?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($users as $user):?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td align="center">
<?php foreach ($user->groups as $group):?>
                                                    <?php echo anchor('admin/groups/edit/'.$group->id, '<span class="label" style="background:'.$group->bgcolor.';">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>'); ?>
<?php endforeach?>
                                                </td>
                                                <td align="center"><?php echo ($user->active) ? '<span style="cursor:pointer;" class="label label-success" data-toggle="modal" data-target="#popUpIndex" onclick="changeFrameSrc(\''.'../admin/users/deactivate/'. $user->id.'\')">'.lang('users_active').'</span>' : anchor('admin/users/activate/'. $user->id, '<span class="label label-danger">'.lang('users_inactive').'</span>'); ?></td>
                                                <td>
                                                    <?php echo anchor('admin/users/create/'.$user->id, lang('actions_edit')); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
<div id="popUpIndex" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo sprintf(lang('users_deactivate_question'), '<span class="label label-primary">').'</span>';?></h4>
            </div>
            <div class="modal-body text-center">
                <iframe id="popUpDeactivate" src="" style="border: 0px; width: 95%; height: 50px;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="submitFormIniFrame('popUpDeactivate','form-status_user')">บันทึก</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>

    </div>
</div>
