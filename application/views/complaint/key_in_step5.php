<?php
$link = array(
    'href' => '/assets/css/key_in.css',
    'type' => 'text/css',
    'rel' => 'stylesheet'
);
echo link_tag($link);
if(@$_GET['debug']=='on'){
    echo"<pre>";print_r(@$key_in_data);echo"</pre>";
    echo"<pre>";print_r(@$district_list);echo"</pre>";
}
?>
    <input type="hidden" id="action" value="<?php echo (@$id!='')?'edit':'add'; ?>">
    <input type="hidden" id="keyin_id" name="keyin_id" value="<?php echo (@$id!='')?$id:''; ?>">
    <?php
        if(@$key_in_data['step']!='' && $key_in_data['step']>'1'){
            $step = @$key_in_data['step'];
        }else{
            $step = '5';
        }
    ?>
    <input type="hidden" id="step" name="step" value="<?php echo $step; ?>">
    <div class="row frame">
        <?php $this->load->view('complaint/step_of_keyin'); ?>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">บันทึกเรื่องร้องทุกข์/ร้องเรียน</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            วันที่ร้องทุกข์ :
                        </label>
                        <span class="col-sm-7">
                            <?php echo date('d/m/Y',  strtotime('+543 year',strtotime(@$key_in_data['complain_date']))); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            ผู้รับแจ้ง :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['recipient']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            วันที่หนังสือส่งเข้า :
                        </label>
                        <span class="col-sm-7">
                            <?php echo date('d/m/Y',  strtotime('+543 year',strtotime(@$key_in_data['doc_receive_date']))); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            เลขที่หนังสือส่งเข้า :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['doc_receive_no']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            วันที่หนังสือส่งออก :
                        </label>
                        <span class="col-sm-7">
                            <?php echo date('d/m/Y',  strtotime('+543 year',strtotime(@$key_in_data['doc_send_date']))); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            เลขที่หนังสือส่งออก :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['doc_send_no']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ผู้บันทึก :
                        </label>
                        <span class="col-sm-7">
                            เจ้าหน้าที่รับผิดชอบเรื่องร้องเรียนจังหวัด ชลบุรี
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ผู้ร้องทุกข์ :
                        </label>
                        <span class="col-sm-7">
                            <?php
                            if(@$key_in_data['user_complain_type_id'] == '1'){
                                echo "ไม่ประสงค์ออกนาม";
                            }else{
                                echo @$title_name[$key_in_data['pn_id']].$key_in_data['first_name']." ".@$key_in_data['last_name'];
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="user_complain_detail" style="display: none;">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            รหัสประจำตัวประชาชน :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['id_card']; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            โทรศัพท์เคลื่อนที่ : <br>(ที่สามารถติดต่อได้)
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['phone_number']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">ความประสงค์ในการดำเนินการ</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ประเภทเรื่อง :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$complain_type[$key_in_data['complain_type_id']]; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            หัวข้อเรื่อง :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['complain_name']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            ช่องทางรับเรื่อง :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$channel[$key_in_data['channel_id']]; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            ลักษณะเรื่อง :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$subject[$key_in_data['subject_id']]; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            หน่วยงานหรือผู้ถูกร้องเรียนร้องทุกข์ :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$accused_type[$key_in_data['accused_type_id']]; ?>
                        </span>
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
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['accused_name']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            ความประสงค์ :
                        </label>
                        <span class="col-sm-7">
                            <?php
                            if(@$key_in_data['wish']!=''){
                                foreach (@$key_in_data['wish'] as $key => $value) { ?>
                                    <div><?php echo $value['wish_name']; ?></div>
                            <?php
                                }
                            } ?>
                        </span>
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
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['wish_detail']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row title">
            <div class="col-md-12">
                <div class="form-group">เนื้อหาเรื่องร้องทุกข์ร้องเรียน</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right">
                            วันเดือนปีที่เกิดเหตุ(ถ้ามี) :
                        </label>
                        <span class="col-sm-7">
                            <?php echo date('d/m/Y',  strtotime('+543 year',strtotime(@$key_in_data['scene_date']))); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            สถานที่เกิดเหตุ :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['place_scene']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            จังหวัด :
                        </label>
                        <span class="col-sm-7">
                            <?php echo $province_list[substr(@$key_in_data['address_id'],0,3)."00000"]; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            อำเภอ :
                        </label>
                        <span class="col-sm-7">
                            <?php echo $district_list[substr(@$key_in_data['address_id'],0,4)."0000"]; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            ตำบล :
                        </label>
                        <span class="col-sm-7">
                            <?php echo $subdistrict_list[@$key_in_data['address_id']]; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            รายละเอียดการร้องเรียน/ร้องทุกข์ :
                        </label>
                        <span class="col-sm-7">
                            <?php echo @$key_in_data['complaint_detail']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 right ">
                            จุดเกิดเหตุ :
                        </label>
                        <label class="col-sm-2">
                            ละติจูด
                        </label>
                        <span class="col-sm-5">
                            <?php echo @$key_in_data['latitude']; ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3">
                            ลองติจูด
                        </label>
                        <span class="col-sm-5">
                            <?php echo @$key_in_data['longitude']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    <div class="row title">
        <div class="col-md-12">
            <div class="form-group">หลักฐานประกอบเรื่องร้องเรียน/ร้องทุกข์</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-sm-2 right"></label>
                            <span class="col-sm-10">
                                    <?php
                                    $fileCount = 0;
                                    if(array_key_exists('attach_file',$key_in_data)){
                                        if(!is_null($key_in_data['attach_file'])){
                                            foreach ($key_in_data['attach_file'] as $file){
                                                $fileCount++;
                                                ?>
                                                <?php echo $fileCount.". "; ?><a style="cursor:pointer;" onclick="window.open('<?php echo base_url($file['file_system_name']); ?>', '_blank');"><?php echo $file['file_name']; ?></a>
                                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                            </span>
            </div>
        </div>
    </div>
        <div class="row footer">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-5">
                        <input type="button" class="btn btn-bitbucket" value="หน้าก่อนหน้า" onclick="document.location.href='<?php echo base_url('complaint/key_in/key_in_step4/'.$id); ?>';">
                    </label>
                    <label class="col-sm-5 right">
                        <input type="button" class="btn btn-bitbucket" value="กลับหน้าหลัก" onclick="document.location.href='<?php echo base_url('complaint/dashboard/'); ?>';">
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
?>