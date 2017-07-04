$(document).ready(function () {
    var base_url = $('#base_url').attr('class');
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
            url: base_url+'api/setting/accused_type/',  //the url to call
            data: { accused_type_id: accused_type_id , accused_type: accused_type },     //Data sent to server
            //contentType: 'application/json',
            beforeSend: function (xhr) {   //Include the bearer token in header
                xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
            }
        }).done(function (response) {
            swal({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#00C0EF",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        window.location.href=base_url+'setting_accused_type/dashboard';
                    }
                });


            //alert(response);
            //Response ok. process reuslt
        }).fail(function (err) {
            //console.log(err);
            swal("บันทึกข้อมูลไม่สำเร็จ", "", "error");
            //alert(err);
            //Error during request
        });
    });

});
