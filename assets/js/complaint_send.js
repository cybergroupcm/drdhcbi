$(document).ready(function () {
    $("#btSaveSend").click(function () {
        var base_url = $('#base_url').attr('class');
        var method = 'POST';
        var jwt = Cookies.get("api_token");
        var keyin_id = $('#keyin_id_send').val();
        var complain_no = $('#complain_no_send').val();
        var reply_date = $('#reply_date').val();
        var send_org_date = $('#send_org_date').val();

        if($('input[name=send_org_parent]:checked').val() == '2'){
            send_org_id = $('input[name=send_org_parent]:checked').val();
        }else{
            if(send_org_id == ''){
                send_org_id = $('input[name=send_org_parent]:checked').val();
            }else{
                send_org_id = $('#send_org_id :selected').val();
            }
        }

        if($('#send_status').prop('checked') == true){
            send_status = '3';
        }else{
            send_status = '2';
        }

        $.ajax({
            type: 'PUT', //GET, POST, PUT
            url: base_url+'api/complaint/key_in/',  //the url to call
            data: {keyin_id:keyin_id,reply_date: reply_date, send_org_date:send_org_date, send_org_id:send_org_id,current_status_id:send_status },     //Data sent to server
            //contentType: 'application/json',
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

    $(".btOpenReceived").click(function () {
        $(this).attr('id', $("#keyin_id_send").val());
        $("#send .close").click();
    });
});
