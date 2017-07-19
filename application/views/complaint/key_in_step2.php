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
<input type="hidden" id="action_to" value="key_in_step3">
<?php
if(@$key_in_data['step']!='' && $key_in_data['step']>'1'){
    $step = @$key_in_data['step'];
}else{
    $step = '2';
}
?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <input type="hidden" id="step_now" name="step_now" value="2">
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">ความประสงค์ในการดำเนินการ</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            ประเภทเรื่อง :
                        </label>
                        <label class="col-sm-7">
                            <?php
                            $dd1 = $complain_type;
                            $dd1[''] = 'กรุณาเลือก';
                            ksort($dd1);
                            echo form_dropdown([
                                'name' => 'complain_type_id',
                                'id' => 'complain_type_id',
                                'class' => 'form-control'
                            ], $dd1, @$key_in_data['complain_type_id']);
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            หัวข้อเรื่อง :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="complain_name" id="complain_name" class="form-control" value="<?php echo @$key_in_data['complain_name']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            ช่องทางรับเรื่อง :
                        </label>
                        <label class="col-sm-7">
                            <?php
                            $dd2 = $channel;
                            $dd2[''] = 'กรุณาเลือก';
                            ksort($dd2);
                            echo form_dropdown([
                                'name' => 'channel_id',
                                'id' => 'channel_id',
                                'class' => 'form-control'
                            ], $dd2, @$key_in_data['channel_id']);
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                            ลักษณะเรื่อง :
                        </label>
                        <label class="col-sm-7">
                            <?php
                            $dd3 = $subject;
                            $dd3[''] = 'กรุณาเลือก';
                            ksort($dd3);
                            echo form_dropdown([
                                'name' => 'subject_id',
                                'id' => 'subject_id',
                                'class' => 'form-control'
                            ], $dd3, @$key_in_data['subject_id']);
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                                หน่วยงานหรือผู้ถูกร้องเรียนร้องทุกข์ :
                        </label>
                        <label class="col-sm-7">
                            <?php
                            $i = 1;
                            foreach ($accused_type as $key => $value) {
                                if (!empty($key)) {
                                    if (($i % 3) == 1) {
                                        $class = 'col-md-3 col-md-offset-1';
                                    } else if (($i % 3) == 2) {
                                        $class = 'col-md-3';
                                    } else {
                                        $class = 'col-md-5';
                                    } ?>
                                    <div>
                                        <input type="radio" class="accused_type" id="accused_type_id_<?php echo $key; ?>" name="accused_type_id"
                                               value="<?php echo $key; ?>" <?php echo @$key_in_data['accused_type_id']==$key?'checked':'' ?>>
                                        <label for="accused_type_id_<?php echo $key; ?>">&nbsp;<?php echo $value; ?></label>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            } ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ชื่อผู้ถูกร้องเรียน :
                        </label>
                        <label class="col-sm-7">
                            <input type="text" name="accused_name" id="accused_name" class="form-control"
                                   value="<?php echo @$key_in_data['accused_name']; ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right required">
                                ความประสงค์ :
                        </label>
                        <label class="col-sm-7">
                            <?php
                            $wish_id = array();
                            if(@$key_in_data['wish']!=''){
                                foreach(@$key_in_data['wish'] as $key => $value){
                                    $wish_id[] = $value['wish_id'];
                                }
                            }
                            foreach ($wish as $key => $value) {
                                ?>
                                <div>
                                    <input type="checkbox" class="desire" id="wish_<?php echo $key ?>" name="wish[]"
                                           value="<?php echo $key; ?>" <?php echo in_array(@$key,@$wish_id)?'checked':''; ?> >
                                    <label for="wish_<?php echo $key ?>">&nbsp;<?php echo $value; ?></label>
                                </div>
                                <?php
                            }
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ความประสงค์เพิ่มเติม :
                        </label>
                        <label class="col-sm-7">
                                    <textarea class="form-control" cols="100" rows="5" id="wish_detail"
                                              name="wish_detail"><?php echo @$key_in_data['wish_detail']; ?></textarea>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo form_close();
        ?>
        <div class="row footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-5">
                        <input type="button" class="btn btn-bitbucket" value="หน้าก่อนหน้า" onclick="validateForm('key_in_step1','back')">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="หน้าถัดไป" onclick="validateForm('key_in_step3','')">
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
?>