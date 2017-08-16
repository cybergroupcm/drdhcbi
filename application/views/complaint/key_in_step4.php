<?php
$link = array(
    'href' => '/assets/css/key_in.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
$link = array(
    'href' => '/assets/css/step.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
echo form_open_multipart('',array('id' => 'keyInForm'));
    if(@$_GET['debug']=='on'){
        echo"<pre>";print_r(@$key_in_data);echo"</pre>";
        echo"<pre>";print_r(@$district_list);echo"</pre>";
    }
?>
<input type="hidden" id="action" value="<?php echo (@$id!='')?'edit':'add'; ?>">
<input type="hidden" id="keyin_id" name="keyin_id" value="<?php echo (@$id!='')?$id:''; ?>">
<input type="hidden" id="action_to" value="key_in_step5">
<?php
if(@$key_in_data['step']!='' && $key_in_data['step']>'4'){
    $step = @$key_in_data['step'];
}else{
    $step = '4';
}
?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <input type="hidden" id="step_now" name="step_now" value="4">
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">หลักฐานประกอบเรื่องร้องเรียน/ร้องทุกข์</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 right">
                            แนบไฟล์เอกสารหลักฐาน<br>/Attach confident document :
                        </label>
                        <label class="col-sm-6">
                            <!--input type="file" multiple id="myFile" name="attach_file[]" onchange="checkFile()"
                                   accept=".jpg, .png, .pdf"-->
                            <input type="button" id="add_file" class="btn btn-primary" value="เพิ่มไฟล์" onclick="add_new_file()">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                            <!--span class="col-sm-12 right" style="color:red;">
                                อณุญาตให้แนบไฟล์นามสกุล .jpg, .png, .pdf ขนาดไม่เกิน 1 MB
                            </span-->
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-2 right"></label>
                            <span class="col-sm-10">
                                <i id="checkFile">
                                    <?php
                                    $fileCount = 0;
                                    if(array_key_exists('attach_file',$key_in_data)){
                                        if(!is_null($key_in_data['attach_file'])){
                                            foreach ($key_in_data['attach_file'] as $file){
                                                $fileCount++;
                                                echo '<span id="show_file_'.$fileCount.'">name: '.$file['file_name'].'<br><input type="button" class="btn btn-sm btn-primary" value="แสดง" onclick="window.open(\''.base_url($file['file_system_name']).'\', \'_blank\');" >&nbsp;&nbsp;&nbsp;&nbsp;<input class="btn btn-sm btn-danger" value="ลบ" onclick="ajax_delete(\''.$file['file_id'].'\',\''.$fileCount.'\');" type="button"><hr></span>';
                                            }
                                        }
                                    }
                                    ?>
                                </i>
                                <input type="hidden" id="file_count" value="<?php echo $fileCount;?>">
                            </span>
                </div>
            </div>
            <div id="file_add_space">
            </div>
        </div>
        <?php
        echo form_close();
        ?>
        <div class="row footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-5">
                        <input type="button" class="btn btn-bitbucket" value="หน้าก่อนหน้า" onclick="validateForm('key_in_step3','back')">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="หน้าถัดไป" onclick="validateForm('key_in_step5','')">
                    </label>
                </div>
            </div>
        </div>
    </div>
<div id="base_url" class="<?php echo base_url(); ?>"></div>
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/key_in.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/step.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'href' => 'template/plugins/datepicker/bootstrap-datetimepicker.min.css',
    'rel' => 'stylesheet',
    'type' => 'text/css'
);
echo link_tag($link);
$link = array(
    'src' => 'template/plugins/datepicker/moment-with-locales.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'template/plugins/datepicker/bootstrap-datetimepicker.min.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>