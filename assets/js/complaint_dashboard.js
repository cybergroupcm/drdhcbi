$( document ).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน


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
        //var dateMin = $(this).val();
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

function getDataReceived(req_id){
    var url = $('#base_url').attr("class")+"complaint/getDataReceived/"+req_id;
    $.ajax({
        method: "GET",
        url: url
    }).done(function (result) {
        var  dataReceived = JSON.parse(result);
        $('#req_id').val(dataReceived.req_id);
        $('#text_req_id').html(dataReceived.req_id);
        $('#req_title').val(dataReceived.req_title);
        $('#text_req_title').html(dataReceived.req_title);
        $('#req_name').val(dataReceived.req_name);
        $('#text_req_name').html(dataReceived.req_name);
        $('#send_date').val(dataReceived.send_date);
        $('#text_send_date').html(thaidateformat(dataReceived.send_date));
    });
}

function getDataSend(req_id){
    $('#req_id_send').val(req_id);
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


