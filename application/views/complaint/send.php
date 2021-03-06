<div class="example-modal">
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">ส่งต่อเรื่องร้องทุกข์</h4>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo base_url('complaint/dashboard')?>" name="form_save_send" id="form_save_send">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="hidden" id="action"  value="<?php echo @$data['action'];?>"/>
                                    <input type="hidden" name="complain_no_send" id="complain_no_send" value="">
                                    <input type="hidden" name="keyin_id_send" id="keyin_id_send" value="">
                                    <label class="col-sm-5 text-right">
                                        กำหนดวันที่ส่งกลับ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="reply_date" id="reply_date" class="form-control pull-right" />
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        กำหนดหน่วยงานส่งต่อเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7 text-left">
                                    <?php
                                        /*foreach($send_org_parent AS $key_parent=>$val_parent) {
                                            ?>
                                            <input type="radio" id="send_org_parent<?php echo $key_parent; ?>" name="send_org_parent" value="<?php echo $key_parent; ?>"> <?php echo $val_parent; ?><br>
                                            <?php
                                            if(!empty($send_org[$key_parent])){
                                                ?>
                                            <select class="form-control" name="send_org_id" id="send_org_id">
                                                <option value=''>--กรุณาเลือก--</option>
                                                <?php
                                                foreach ($send_org[$key_parent] AS $key => $val) {
                                                    echo "<option value='" . $key . "'>" . $val . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <br>
                                            <?php
                                            }
                                        }*/
                                    ?>
                                    <span id='send_org'>
                                        <?php
                                            $i++;
                                            $send_org_parent_list = $send_org_parent;
                                            $send_org_parent_list[''] = 'กรุณาเลือก';
                                            ksort($send_org_parent_list);
                                            echo form_dropdown([
                                                'id' => 'send_org_'.$i,
                                                'class' => 'form-control',
                                                'has_child'=>'send_org_space_'.$i,
                                                'onchange' => 'get_send_org_child(this)'
                                            ], $send_org_parent_list, '');
                                        ?>
                                        <span id="send_org_space_<?php echo $i; ?>">

                                        </span>
                                    </span>
                                    <input type="hidden" name="send_org_id" id="send_org_id" >
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right">
                                        วันที่ส่งต่อเรื่องร้องทุกข์ :
                                    </label>
                                    <label class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="send_org_date" id="send_org_date" class="form-control pull-right" />
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-sm-5 text-right"></label>
                                    <label class="col-sm-7 text-left">
                                        <input type="checkbox" id="send_status" name="send_status" value="1"> ส่งต่อเรื่องร้องทุกข์
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" name="btOpenReceived" class="btn btn-warning btOpenReceived open-received" data-toggle="modal" data-target="#received" data-id="">ยกเลิกการรับเรื่อง</button>
                    <button type="button" name="btSaveSend" id="btSaveSend" class="btn btn-primary">บันทึกส่งต่อเรื่องร้องทุกข์</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
$link = array(
    'src' => 'assets/js/js.cookie.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
$link = array(
    'src' => 'assets/js/complaint_send.js',
    'type' => 'text/javascript'
);
echo script_tag($link);
?>
