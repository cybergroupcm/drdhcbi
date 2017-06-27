$(document).ready(function () {
    $("#btSaveReceived").click(function () {
        var method = 'POST';
        //if ($("#action").val() == 'edit') {
        //    method = 'PUT';
        //}
        var jwt = Cookies.get("api_token");
        var complain_no = $('#complain_no').val();
        var receive_date = $('#receive_date').val();
        //alert(complain_no+'|'+receive_date);
        $.ajax({
            type: 'PUT', //GET, POST, PUT
            url: 'http://rest.net/drdhcbi/api/setting/accused_type/',  //the url to call
            data: { complain_no: complain_no , receive_date: receive_date },     //Data sent to server
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
