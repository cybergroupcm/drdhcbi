$(document).ready(function () {
    $("#btSaveReceived").click(function () {
        var method = 'POST';
        var jwt = Cookies.get("api_token");
        var keyin_id = $('#keyin_id').val();
        var complain_no = $('#complain_no').val();
        var receive_date = $('#receive_date').val();

        $.ajax({
            type: 'PUT', //GET, POST, PUT
            url: 'http://localhost/drdhcbi/api/complaint/received/',  //the url to call
            data: { complain_no: complain_no , receive_date: receive_date , keyin_id: keyin_id },     //Data sent to server
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
