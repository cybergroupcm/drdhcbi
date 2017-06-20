<div class="example-modal">
    <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">กรองข้อมูล</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="col-sm-5 text-right">
                                ประเภทเรื่องร้องทุกข์หลัก :
                            </label>
                            <label class="col-sm-7">
                                <select class="form-control">
                                    <option>--กรุณาเลือก--</option>
                                    <?php
                                        foreach($data_filter AS $key=> $val){
                                            echo "<option value='".$key."'>".$val."</option>";
                                        }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary">กรองข้อมูล</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ล้างค่า</button>
                </div>
            </div>
        </div>
    </div>
</div>
