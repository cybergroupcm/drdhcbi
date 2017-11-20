var jwt = Cookies.get("api_token");
var base_url = $('#base_url').attr('class');
$(document).ready(function () {
    $("#btSaveResult").click(function () {
        var return_to = $('#return_to').attr('class');
        if($('#result_id').val()==''){
            var method = 'POST';
        }else{
            var method = 'PUT';
        }
        var jwt = Cookies.get("api_token");
        var keyin_id = $('#keyin_id_result').val();
        var result_detail = $('#result_detail').val();
        var result_user_id = $('#result_user_id').val();
        //var result_date = $('#result_date').val();
        var result_date = '';
        if($('#result_date').val() != '') {
            //var arr_result_date = $('#result_date').val().split('/');
            // var result_date = (arr_result_date[2] - 543) + '-' + arr_result_date[1] + '-' + arr_result_date[0];
            var result_date = $('#result_date').val();
        }else{
            var result_date = moment(new Date ).format('DD/MM/BBBB HH:mm:ss');
        }
        if($('#save_result_status').prop('checked') == true){
            current_status_id = '4';
        }else{
            current_status_id = '3';
        }

        add_result(keyin_id,result_detail,result_date,result_user_id,method);
        update_status(keyin_id,current_status_id,result_detail,result_date,result_user_id);
        result_attach_file(keyin_id);
        setTimeout(function(){
            $(location).attr('href',base_url+'complaint/'+return_to);
        }, 2000);
    });

    $(".btOpenSend").click(function () {
        $(this).attr('data-id', $("#keyin_id_result").val());
        $("#save_result .close").click();
    });
});
var text_ok = 'บันทึกข้อมูลสำเร็จ';
var text_error = 'บันทึกข้อมูลไม่สำเร็จ';

//บันทึกสถานะ
function update_status(keyin_id,current_status_id,result_detail,result_date,result_user_id){
    $.ajax({
        type: 'PUT', //GET, POST, PUT
        url: base_url+'api/complaint/key_in/',  //the url to call
        data: { keyin_id: keyin_id ,current_status_id:current_status_id },     //Data sent to server
        beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        },
        async: false,
        cache: false
    }).done(function (response,xhr) {
        //add_result(keyin_id,result_detail,result_date);
    }).fail(function (err) {
        swal("ผิดพลาด",text_error, "error");
    });
}

function add_result(keyin_id,result_detail,result_date,result_user_id,method){
    $.ajax({
        type: method, //GET, POST, PUT
        url: base_url +'api/complaint/result/',  //the url to call
        data: { keyin_id: keyin_id , result_detail: result_detail , result_date: result_date, result_user_id:result_user_id},     //Data sent to server
        beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        },
        async: false,
        cache: false
    }).done(function (response,xhr) {
        /*if(xhr.state = 201){
            swal({
                title: "สำเร็จ",
                text: text_ok,
                type: "success",
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function(){
                $(location).attr('href',base_url+'complaint/dashboard');
            }, 2000);
        }*/
        $('#result_id').val(response);
    }).fail(function (err) {
        swal("ผิดพลาด",text_error, "error");
    });
}

//แนบไฟล์
function result_attach_file(keyin_id){
    var data = new FormData($("#form_save_result")[0]);
    $.ajax({
        method: "POST",
        url: base_url +"api/complaint/result_file_attach/",
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        }
    }).done(function (response) {
        $('#result_id').val(response);
        $('#close_modal').trigger('click');
        swal('บันทึกข้อมูลเรียบร้อยแล้ว');
        //alert(response);
        //Response ok. process reuslt
    }).fail(function (err) {
        //alert(err);
        //Error during request
    });
}

function delete_result_file(file_id, file_name){
    swal({
        title: "ท่านต้องการลบไฟล์หรือไม่",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                method: "POST",
                url: base_url +"api/complaint/result_file_delete/",
                data: {file_id : file_id, file_name : file_name},
                beforeSend: function (xhr) {   //Include the bearer token in header
                    xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
                }
            }).done(function (response) {
                $('#file_'+file_id).remove();
                //alert(response);
                //Response ok. process reuslt
            }).fail(function (err) {
                //alert(err);
                //Error during request
            });
        }
    });
}