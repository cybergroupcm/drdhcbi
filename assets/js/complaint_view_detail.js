var jwt = Cookies.get("api_token");
$( document ).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });
    //datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    //$(".datepicker").prop('readonly', 'readonly');

    $('#receive_date').datetimepicker({
        locale: 'th',
        format: 'DD/MM/BBBB HH:mm:ss',
        dayViewHeaderFormat: 'MMMM BBBB',
        showTodayButton: true,
        showClear: true,
        tooltips: {
            today: 'วันนี้',
            clear: 'ล้างค่า',
            selectTime: 'เลือกเวลา'
        }
    });

    $('#reply_date').datetimepicker({
        locale: 'th',
        format: 'DD/MM/BBBB HH:mm:ss',
        dayViewHeaderFormat: 'MMMM BBBB',
        showTodayButton: true,
        showClear: true,
        tooltips: {
            today: 'วันนี้',
            clear: 'ล้างค่า',
            selectTime: 'เลือกเวลา'
        }
    });

    $('#send_org_date').datetimepicker({
        locale: 'th',
        format: 'DD/MM/BBBB HH:mm:ss',
        dayViewHeaderFormat: 'MMMM BBBB',
        showTodayButton: true,
        showClear: true,
        tooltips: {
            today: 'วันนี้',
            clear: 'ล้างค่า',
            selectTime: 'เลือกเวลา'
        }
    });

    $('#result_date').datetimepicker({
        locale: 'th',
        format: 'DD/MM/BBBB HH:mm:ss',
        dayViewHeaderFormat: 'MMMM BBBB',
        showTodayButton: true,
        showClear: true,
        tooltips: {
            today: 'วันนี้',
            clear: 'ล้างค่า',
            selectTime: 'เลือกเวลา'
        }
    });
    //start ปฏิทิน
    $('.datepickerstart').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });

    $('.datepickerend').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });

    $('.datepicker').each(function(){
        $(this).datepicker('update', $(this).val());
    });
    $('.datepickerstart').each(function(){
        $(this).datepicker('update', $(this).val());
    });
    $('.datepickerend').each(function(){
        $(this).datepicker('update', $(this).val());
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

    $(document).on("click", ".open-received", function () {
        var req_id = $(this).data('id');
        getDataReceived(req_id);
    });

    $(document).on("click", ".open-send", function () {
        var req_id = $(this).data('id');
        getDataSend(req_id);
    });

    $(document).on("click", ".open-result", function () {
        var id = $(this).data('id');
        $('#keyin_id_result').val(id);
        var url = $('#base_url').attr("class")+"complaint/getDataResult/"+id;
        $.ajax({
            method: "GET",
            url: url,
            async:false
        }).done(function (result) {
            var dataReceived = JSON.parse(result);
            console.log(dataReceived.result);
            if (dataReceived.result != null) {
                $('#result_detail').val(dataReceived.result.result_detail);
                if (dataReceived.result.result_date != '0000-00-00 00:00:00') {
                    var original_result_date = dataReceived.result.result_date.split(' ');
                    var new_result_date = original_result_date[0];
                    var new_result_time = original_result_date[1];
                    var arr_result_date = new_result_date.split('-');
                    var result_date_eng = arr_result_date[2]+'/'+arr_result_date[1]+'/'+(parseInt(arr_result_date[0])+543)+' '+new_result_time;
                    $('#result_date').data("DateTimePicker").date(result_date_eng);
                }else{
                    $('#result_date').data("DateTimePicker").date(moment(new Date ).format('DD/MM/BBBB HH:mm:ss'));
                }
                $('#result_id').val(dataReceived.result.result_id);
                var result_attach_file = dataReceived.result_attach_file;
                $('#checkFile').html('');
                for (var key in result_attach_file) {
                    console.log(result_attach_file[key]);
                    txt_append = "<div id='file_" + result_attach_file[key].file_id + "'>name : <a href='" + $('#base_url').attr("class") + "upload/result_attach_file/" + result_attach_file[key].file_system_name + "' target='_blank'>" + result_attach_file[key].file_name + "</a><br>";
                    txt_append += "<input type='button' class='btn btn-danger' onclick=\"delete_result_file('" + result_attach_file[key].file_id + "', '" + result_attach_file[key].file_system_name + "')\" value='ลบ'></div>";
                    $('#checkFile').append(txt_append);
                }
            }
        });

        var url = $('#base_url').attr("class")+"complaint/getDataReceived/"+id;
        $.ajax({
            method: "GET",
            url: url,
            async:false
        }).done(function (result) {
            var  dataReceived = JSON.parse(result);
            if(dataReceived.current_status_id == '4'){
                if(!$('#save_result_status').prop('checked')) {
                    $("#save_result_status").prop("checked", true);
                }
            }else{
                if($('#save_result_status').prop('checked')) {
                    $("#save_result_status").prop("checked", false);
                }
            }
        });
    });
});
function Accept(keyin_id,receive_status) {
    Number.prototype.padLeft = function(base,chr){
        var  len = (String(base || 10).length - String(this).length)+1;
        return len > 0? new Array(len).join(chr || '0')+this : this;
    }
    var base_url = $('#base_url').attr('class');
    var jwt = Cookies.get("api_token");
    var d = new Date,
        dformat = [d.getDate().padLeft(),
                (d.getMonth()+1).padLeft(),
                (d.getFullYear()+543)].join('/') +' ' +
            [d.getHours().padLeft(),
                d.getMinutes().padLeft(),
                d.getSeconds().padLeft()].join(':');
    var receive_date = dformat;

    var text_ok = 'บันทึกข้อมูลสำเร็จ';
    var text_error = 'บันทึกข้อมูลไม่สำเร็จ';

    $.ajax({
        type: 'PUT', //GET, POST, PUT
        url: base_url+'api/complaint/key_in/',  //the url to call
        data: {keyin_id: keyin_id,current_status_id:receive_status, receive_date: receive_date },     //Data sent to server
        beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        }
    }).done(function (response,xhr) {
        if(xhr.state = 201){
            swal({
                title: "สำเร็จ",
                text: text_ok,
                type: "success",
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function(){
                $(location).attr('href',base_url+'complaint/view_detail/'+keyin_id);
            }, 2000);
        }
        console.log("response:"+response);
    }).fail(function (err) {
        swal("ผิดพลาด",text_error, "error");
    });
}
function getDataSend(id){
    $('#keyin_id_send').val(id);
    var url = $('#base_url').attr("class")+"complaint/getDataSend/"+id;
    $.ajax({
        method: "GET",
        url: url,
        async:false
    }).done(function (result) {
        var  dataSend = JSON.parse(result);
        if((dataSend.reply_date != '') && (dataSend.reply_date != '0000-00-00 00:00:00') && (dataSend.reply_date != null)) {
            var original_reply_date = dataSend.reply_date.split(' ');
            var new_reply_date = original_reply_date[0];
            var new_reply_time = original_reply_date[1];
            var arr_reply_date = new_reply_date.split('-');
            var reply_date_eng = arr_reply_date[2]+'/'+arr_reply_date[1]+'/'+(parseInt(arr_reply_date[0])+543)+' '+new_reply_time;
            //$('#reply_date').datepicker("setDate", reply_date_eng);  //กำหนดวัน
            $('#reply_date').data("DateTimePicker").date(reply_date_eng);
        }else{
            //$('#reply_date').datepicker("setDate", "0");
            $('#reply_date').data("DateTimePicker").date(moment(new Date ).format('DD/MM/BBBB HH:mm:ss'));
        }

        if((dataSend.send_org_date != '') && (dataSend.send_org_date != '0000-00-00 00:00:00') && (dataSend.send_org_date != null)) {
            var original_send_org_date = dataSend.send_org_date.split(' ');
            var new_send_org_date = original_send_org_date[0];
            var new_send_org_time = original_send_org_date[1];
            var arr_send_org_date = new_send_org_date.split('-');
            var send_org_date_eng = arr_send_org_date[2]+'/'+arr_send_org_date[1]+'/'+(parseInt(arr_send_org_date[0])+543)+' '+new_send_org_time;

            //$('#send_org_date').datepicker("setDate", send_org_date_eng);  //กำหนดวัน
            $('#send_org_date').data("DateTimePicker").date(send_org_date_eng);
        }else{
            //$('#send_org_date').datepicker("setDate", "0");
            $('#send_org_date').data("DateTimePicker").date(moment(new Date ).format('DD/MM/BBBB HH:mm:ss'));
        }

        var send_org_id = dataSend.send_org_id;
        $('#send_org_id').val(send_org_id);

        var url = base_url+'complaint/get_send_org/'+send_org_id;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#send_org').html(data);
        });

        /*if(send_org_id != '' && send_org_id != '0') {
         if (send_org_id == '2') {
         $('input[name=send_org_parent][value="2"]').prop('checked', true);
         } else {
         $('input[name=send_org_parent][value="1"]').prop('checked', true);
         $('#send_org_id option[value=' + send_org_id + ']').prop('selected', 'selected');
         }
         }else{
         $('#send_org_id option[value=""]').prop('selected', 'selected');
         }*/

        if(dataSend.current_status_id == '3' || dataSend.current_status_id == '4'){
            if(!$('#send_status').prop('checked')) {
                $("#send_status").prop("checked", true);
            }
        }else{
            if($('#send_status').prop('checked')) {
                $("#send_status").prop("checked", false);
            }
        }
    });
}
var count_send_org = 0;
function get_send_org_child(ele){
    var value = ele.value;
    $('#send_org_id').val(value);
    if($('#'+ele.id).attr('has_child') != '') {
        $('#' + $('#' + ele.id).attr('has_child')).html('');
    }
    if(value!=''){
        count_send_org++;
        var url = base_url+'complaint/get_send_org_child/'+value+'/'+count_send_org;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#' + $('#' + ele.id).attr('has_child')).append(data);
        });
    }
}