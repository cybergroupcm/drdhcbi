var base_url = $('#base_url').attr('class');
var jwt = Cookies.get("api_token");
$( document ).ready(function() {
    $("#bt_add").click(function () {
        var method = 'POST';
        if ($("#action").val() == 'edit') {
            method = 'PUT';
        }

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

        }).fail(function (err) {
            swal("บันทึกข้อมูลไม่สำเร็จ", "", "error");
        });
    });
});

function bt_delete(id) {
    var base_url = $('#base_url').attr('class');
    swal({title: "คุณต้องการจะลบข้อมูลหรือไม่?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่, ต้องการจะลบข้อมูล!",
            cancelButtonText: "ไม่",
            closeOnConfirm: false},
        function () {
                $.ajax({
                        type: 'DELETE', //GET, POST, PUT
                        url: base_url+'api/setting/accused_type/'+id,  //the url to call
                        //contentType: 'application/json',
                        beforeSend: function (xhr) {   //Include the bearer token in header
                                xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
                        }
                }).done(function (response) {
                        swal({
                                    title: "ลบข้อมูลสำเร็จ",
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

                }).fail(function (err) {
                        swal("ลบข้อมูลไม่สำเร็จ", "", "error");
                });
        });
}


