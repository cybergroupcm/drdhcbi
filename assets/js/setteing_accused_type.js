$(document).ready(function () {
    $("#bt_add").click(function () {
        var method = 'POST';
        if ($("#action").val() == 'edit') {
            method = 'PUT';
        }
        var jwt = Cookies.get("api_token");
        var accused_type_id = $('#accused_type_id').val();
        var accused_type = $('#accused_type').val();
        $.ajax({
            type: method, //GET, POST, PUT
            url: 'http://rest.net/drdhcbi/api/setting/accused_type/',  //the url to call
            data: { accused_type_id: accused_type_id , accused_type: accused_type },     //Data sent to server
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
