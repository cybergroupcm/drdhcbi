<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        </div>


        <script src="<?php echo base_url($frameworks_dir . '/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url($plugins_dir . '/icheck/js/icheck.min.js'); ?>"></script>
<?php
    if($this->uri->segment(2) == 'register'){
        ?>
        <link href="<?php echo base_url('template/plugins/bootstrap-sweetalert/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url('template/plugins/bootstrap-sweetalert/js/sweetalert.min.js'); ?>"></script>

        <?php
    }
?>
        <script src="<?php echo base_url($plugins_dir . '/icheck/js/icheck.min.js'); ?>"></script>
        <script>
            $(function(){
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%'
                });
            });
        </script>
    </body>
</html>