$(document).ready(function () {
    $("#btSaveReceived").click(function () {
        var base_url = $('#base_url').attr('class');
        var method = 'POST';
        var jwt = Cookies.get("api_token");
        var keyin_id = $('#keyin_id').val();
        var complain_no = $('#complain_no').val();
        var receive_date = $('#receive_date').val();

        if($('#receive_status').prop('checked') == true){
            receive_status = '2';
        }else{
            receive_status = '1';
        }
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
                    $(location).attr('href',base_url+'complaint/dashboard');
                }, 2000);
            }
        }).fail(function (err) {
            swal("ผิดพลาด",text_error, "error");
        });
    });

});
