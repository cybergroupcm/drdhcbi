$(document).ready(function () {
    $("#btSaveSend").click(function () {
        var method = 'POST';
        var jwt = Cookies.get("api_token");
        var keyin_id = $('#keyin_id_send').val();
        var complain_no = $('#complain_no_send').val();
        var arr_reply_date = $('#reply_date').val().split('/');
        var reply_date = (arr_reply_date[2]-543)+'-'+arr_reply_date[1]+'-'+arr_reply_date[0];

        var arr_send_org_date = $('#send_org_date').val().split('/');
        var send_org_date = (arr_send_org_date[2]-543)+'-'+arr_send_org_date[1]+'-'+arr_send_org_date[0];

        var send_org_id = $('#send_org_id :selected').val();

        $.ajax({
            type: 'PUT', //GET, POST, PUT
            url: 'http://localhost/drdhcbi/api/complaint/send/',  //the url to call
            data: {reply_date: reply_date, send_org_date:send_org_date, send_org_id:send_org_id,keyin_id:keyin_id },     //Data sent to server
            //contentType: 'application/json',
            beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
            }
        }).done(function (response) {
            alert(response);
            //Response ok. process reuslt
        }).fail(function (err) {
            alert(err);
            //Error during request
        });
    });

});
