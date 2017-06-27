$(document).ready(function () {
    $("#btSaveSend").click(function () {
        var method = 'POST';
        if ($("#action").val() == 'edit') {
            method = 'PUT';
        }
        var jwt = Cookies.get("api_token");
        var complain_no = $('#complain_no_send').val();
        var reply_date = $('#reply_date').val();
        var send_org_date = $('#send_org_date').val();
        var send_org_id = $('#send_org_id :selected').val();

        $.ajax({
            type: method, //GET, POST, PUT
            url: 'http://rest.net/drdhcbi/api/setting/accused_type/',  //the url to call
            data: { complain_no: complain_no , reply_date: reply_date, send_org_date:send_org_date, send_org_id:send_org_id },     //Data sent to server
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
