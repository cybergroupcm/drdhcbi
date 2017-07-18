<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
            <div class="login-logo">
                <a href="#"><b>ศูนย์ดำรงธรรม</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">&nbsp;</p>
                <?php echo $message;?>

                <?php echo form_open('auth/login');?>
                    <div class="form-group has-feedback">
                        <?php echo form_input($identity);?>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <?php echo form_input($password);?>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?><?php echo 'จดจำรหัสผ่าน'; ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <?php echo form_submit('submit', 'เข้าสู่ระบบ', array('class' => 'btn btn-primary btn-block btn-flat'));?>
                        </div>
                    </div>
                <?php echo form_close();?>

<?php if ($auth_social_network == TRUE): ?>
                <div class="social-auth-links text-center">
                    <p>- <?php echo lang('auth_or'); ?> -</p>
                    <?php echo anchor('#', '<i class="fa fa-facebook"></i>' . lang('auth_sign_facebook'), array('class' => 'btn btn-block btn-social btn-facebook btn-flat')); ?>
                    <?php echo anchor('#', '<i class="fa fa-google-plus"></i>' . lang('auth_sign_google'), array('class' => 'btn btn-block btn-social btn-google btn-flat')); ?>
                </div>
<?php endif; ?>
<?php if ($forgot_password == TRUE): ?>
                <?php echo anchor('#', 'ลืมรหัสผ่าน'); ?><br />
<?php endif; ?>
<?php if ($new_membership == TRUE): ?>
                <?php echo anchor('auth/register', 'ลงทะเบียน สมัครสมาชิก'); ?><br />
<?php endif; ?>
            </div>
