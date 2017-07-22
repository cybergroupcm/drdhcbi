    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <?php $this->load->view('complaint/step_of_view_detail'); ?>
                        <div class="col-xs-12 text-right">
                           <a href="<?php echo base_url('complaint/pdf_detail/' . @$key_in_data['keyin_id'])?>" target="_blank">
                                <?php echo img(array('src' => 'assets/images/print.png', 'title' => 'สั่งพิมพ์', 'width' => '48px', 'style' => 'cursor:pointer')); ?>
                            </a>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        เลขที่เรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['complain_no'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        วันที่ร้องทุกข์ :

                                        <span style="font-weight: normal;">
                                            <?php
                                                $complain_date =($key_in_data['complain_date'] !='' && $key_in_data['complain_date'] !='0000-00-00')?date_thai($key_in_data['complain_date'], true):'';
                                                echo $complain_date;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        ผู้รับแจ้ง :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['recipient'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        วันที่หนังสือส่งเข้า :
                                        <span style="font-weight: normal;">
                                            <?php
                                                $doc_receive_date=($key_in_data['doc_receive_date'] !='' && $key_in_data['doc_receive_date'] !='0000-00-00')?date_thai($key_in_data['doc_receive_date'], true):'ไม่ระบุ';
                                                echo $doc_receive_date;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        เลขที่หนังสือส่งเข้า :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['doc_receive_no'] != '')?@$key_in_data['doc_receive_no']:'ไม่ระบุ';?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        วันที่หนังสือส่งออก :
                                        <span style="font-weight: normal;">
                                            <?php
                                            $doc_send_date=($key_in_data['doc_send_date'] !='' && $key_in_data['doc_send_date'] !='0000-00-00')?date_thai($key_in_data['doc_send_date'], true):'ไม่ระบุ';
                                            echo $doc_send_date;
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        เลขที่หนังสือส่งออก :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['doc_send_no'] != '')?@$key_in_data['doc_send_no']:'ไม่ระบุ';?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-8"></label>
                                    <label class="col-sm-4 text-right">
                                        ผู้บันทึก :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12 text-center">
                                        เรืองร้องทุกข์/ร้องรียน
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ประเภทเรื่องร้องทุกข์ : <span style="font-weight: normal;"><?php echo @$key_in_data['complaint_type'][1]['complain_type_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หัวข้อเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['complain_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ช่องทางร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['channel'][0]['channel_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ลักษณะลักษณะเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['subject'][0]['subject_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        รายละเอียดเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo (@$key_in_data['complaint_detail'] !='')?$key_in_data['complaint_detail']:'ไม่ระบุ';?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        ผู้ร้องทุกข์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เลขบัตรประจำตัวประชาชน :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['id_card'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ชื่อผู้ร้องทุกข์ :
                                        <span style="font-weight: normal;">
                                            <?php
                                            $full_accused_name = @$key_in_data['title_name'][0]['prename'].@$key_in_data['first_name'].'  '.@$key_in_data['last_name'];
                                            echo $full_accused_name;
                                            ?>
                                        </span>
                                    </label>
                                    <label class="col-sm-8">
                                        อายุ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ที่อยู่ปัจจุบันที่สามารถติดต่อได้ :
                                    </label>
                                    <label class="col-sm-8">
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        ตำบล/แขวง :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                    <label class="col-sm-8">
                                        อำเภอ/เขต :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        จังหวัด :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                    <label class="col-sm-8">
                                        รหัสไปรษณีย์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-4">
                                        เบอร์โทรศัพท์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                    <label class="col-sm-8">
                                        เบอร์โทรศัพท์มือถือ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['phone_number'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เบอร์โทรสาร :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ประเภทเรื่องร้องทุกข์หลัก :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ประเภทเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        สาเหตุเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        ผู้ถูกร้องทุกข์ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['accused_name'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หน่วยงานภายใน
                                    </label>
                                </div>
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <tr>
                                        <th class="text-center">กรม</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หน่วยงานที่เกี่ยวข้อง :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        เนื้อหาสาระ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        วันเดือนปีที่เกิดเหตุ (ถ้ามี) :
                                        <span style="font-weight: normal;">
                                        <?php
                                            $doc_scene_date=($key_in_data['scene_date'] !='' && $key_in_data['scene_date'] !='0000-00-00')?date_thai($key_in_data['scene_date'], true):'ไม่ระบุ';
                                            echo $doc_scene_date;
                                        ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        สถานที่เกิดเหตุ :
                                        <span style="font-weight: normal;"><?php echo @$key_in_data['place_scene'];?></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        จังหวัด :
                                        <span style="font-weight: normal;">
                                            <?php
                                                $province_id = substr(@$key_in_data['address_id'], 0, 2).'000000';
                                                echo $province_list[$province_id];
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        เหตุการณ์พฤติการณ์ :
                                        <span style="font-weight: normal;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        ควมประสงค์ในการดำเนินการ :
                                        <span style="font-weight: normal;">
                                        <br>
                                            <?php
                                            if($key_in_data['wish']) {
                                                foreach ($key_in_data['wish'] AS $key => $val) {
                                                    echo @$val['wish_name'] . '<br>';
                                                }
                                            }
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        หลักฐานประกอบเรื่องร้องทุกข์ :
                                        <span style="font-weight: normal;">
                                         <br>
                                            <?php
                                            if($key_in_data['attach_file']) {
                                                foreach ($key_in_data['attach_file'] AS $key => $val) {
                                                    $runfile = $key + 1;
                                                    echo $runfile . '. ' . '<a href="' . base_url(@$val['file_system_name']) . '" target="_blank">' . $val['file_name'] . '</a><br>';
                                                }
                                            }
                                            ?>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        <br>
                                        สถานดำเนินการเรื่องร้องทุกข์
                                    </label>
                                </div>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped dataTable">
                            <tr>
                                <th width="5%" class="text-center">ลำดับ</th>
                                <th width="20%" class="text-center">สถานภาพการดำเนินการ</th>
                                <th width="12%" class="text-center">วันที่ดำเนินการ</th>
                                <th width="25%" class="text-center">รายละเอียด</th>
                                <th width="12%" class="text-center">จำนวนเงินชดเชย</th>
                                <th width="18%" class="text-center">ผู้รับผิดชอบ</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $runno = 0;
                            $arr_data = array();
                            foreach($arr_data AS $val) {
                                $runno++;
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $runno;?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="text-right">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div id="base_url" class="<?php echo base_url();?>"></div>
