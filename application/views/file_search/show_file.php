<?php
if($key_in_data['attach_file']) {
    foreach ($key_in_data['attach_file'] as $key => $val) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-7">
                    <div class="form-group">
                        <label class="col-sm-5 text-right">
                        </label>
                        <label class="col-sm-7">
                            <?php
                            $runfile = $key + 1;
                            echo $runfile . '. ' . '<a href="' . base_url(@$val['file_system_name']) . '" target="_blank">' . $val['file_name'] . '</a>';
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>