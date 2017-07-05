$( document ).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    });
    //datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน


    //start ปฏิทิน
    $('.datepickerstart').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    });

    $('.datepickerend').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    });

    $('.datepickerstart').on('changeDate', function(){
        var arrDateMin= $(this).val().split('/');
        var dateMin = parseInt(arrDateMin[0])+'/'+parseInt(arrDateMin[1])+'/'+parseInt((arrDateMin[2]-543));
        $('.datepickerend').datepicker('setStartDate', dateMin);
    });
    $('.datepickerend').on('changeDate', function(){
        var arrDateMax= $(this).val().split('/');
        var dateMax =parseInt(arrDateMax[0])+'/'+parseInt(arrDateMax[1])+'/'+parseInt((arrDateMax[2]-543));
        $('.datepickerstart').datepicker('setEndDate', dateMax);
    });
    //end ปฏิทิน

    $('#bt_add').click(function(){
      var  link = $('#base_url').attr("class")+"complaint/key_in";
      window.location = link;
    });

    $('#received').on('show.bs.modal', function(e) {
        req_id = e.relatedTarget.id;
        getDataReceived(req_id);
    });

    $('#send').on('show.bs.modal', function(e) {
        req_id = e.relatedTarget.id;
        getDataSend(req_id);
    });

    $("#btSaveReceived").click(function() {
        $("#form_save_received").submit();
    });

    $("#btSaveSend").click(function() {
        $("#form_save_send").submit();
    });

    $("#btFilter").click(function() {
        $("#form_filter").submit();
    });

    $("#btSearch").click(function() {
        $("#form_search").submit();
    });
});

function getDataReceived(id){
    var url = $('#base_url').attr("class")+"complaint/getDataReceived/"+id;
    $.ajax({
        method: "GET",
        url: url
    }).done(function (result) {
        var  dataReceived = JSON.parse(result);
        $('#keyin_id').val(dataReceived.keyin_id);
        $('#complain_no').val(dataReceived.complain_no);
        $('#text_complain_no').html(dataReceived.complain_no);
        $('#complain_name').val(dataReceived.complain_name);
        $('#text_complain_name').html(dataReceived.complain_name);
        $('#recipient').val(dataReceived.recipient);
        $('#text_recipient').html(dataReceived.recipient);
        if((dataReceived.doc_receive_date != '') && (dataReceived.doc_receive_date != '0000-00-00')) {
            $('#doc_receive_date').val(dataReceived.doc_receive_date);
            $('#text_doc_receive_date').html(thaidateformat(dataReceived.doc_receive_date));
        }else{
            $('#text_doc_receive_date').html('-');
        }

        if((dataReceived.receive_date.trim() != '') && (dataReceived.receive_date.trim() != '0000-00-00')) {
            var arr_receive_date = dataReceived.receive_date.split('-');
            var receive_date_eng = arr_receive_date[2]+'/'+arr_receive_date[1]+'/'+arr_receive_date[0];
            $('#receive_date').datepicker("setDate", receive_date_eng);  //กำหนดวัน
            $("#receive_status").attr('checked','checked');
        }else{
            $('#receive_date').datepicker("setDate", "");
            $("#receive_status").removeAttr('checked','');
        }
    });
}

function getDataSend(id){
    $('#keyin_id_send').val(id);
    var url = $('#base_url').attr("class")+"complaint/getDataSend/"+id;
    $.ajax({
        method: "GET",
        url: url
    }).done(function (result) {
        var  dataSend = JSON.parse(result);
        if((dataSend.reply_date != '') && (dataSend.reply_date != '0000-00-00')) {
            var arr_reply_date = dataSend.reply_date.split('-');
            var reply_date_eng = arr_reply_date[2]+'/'+arr_reply_date[1]+'/'+arr_reply_date[0];
            $('#reply_date').datepicker("setDate", reply_date_eng);  //กำหนดวัน
        }else{
            $('#reply_date').datepicker("setDate", "");
        }

        if((dataSend.send_org_date != '') && (dataSend.send_org_date != '0000-00-00')) {
            var arr_send_org_date = dataSend.send_org_date.split('-');
            var send_org_date_eng = arr_send_org_date[2]+'/'+arr_send_org_date[1]+'/'+arr_send_org_date[0];
            $('#send_org_date').datepicker("setDate", send_org_date_eng);  //กำหนดวัน
        }else{
            $('#send_org_date').datepicker("setDate", "");
        }

        var send_org_id = dataSend.send_org_id;
        if(send_org_id != '') {
            $('#send_org_id option[value=' + send_org_id + ']').attr('selected', 'selected');
            if (send_org_id == '2') {
                $('input[name=send_org_parent][value="2"]').attr('checked', true);
            } else {
                $('input[name=send_org_parent][value="1"]').attr('checked', true);
            }
        }
    });
}

function bt_delete(req_id) {
    swal({
            title: "คุณต้องการจะลบข้อมูลหรือไม่?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่, ต้องการจะลบข้อมูล!",
            cancelButtonText: "ไม่",
            closeOnConfirm: false
        },
        function () {
            var  link = $('#base_url').attr("class")+"complaint/dashboard";
            window.location = link;
        });
}

function thaidateformat(d,long) {
    var gD = new Date(d);
    var thmonthCut = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
    var thmonthLong = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
    if(long == 'S'){
        thmonth = thmonthCut;
    }else{
        thmonth =  thmonthLong;
    }
    return gD.getDate() + ' ' + thmonth[gD.getMonth()] + ' ' + (gD.getFullYear() + 543);
}


