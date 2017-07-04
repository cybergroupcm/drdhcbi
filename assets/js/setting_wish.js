var jwt = Cookies.get("api_token");
$( document ).ready(function() {
        var base_url = $('#base_url').attr('class');
        $("#bt_add").click(function () {
                if($('#wish_name').val() != ""){
                        var method = 'POST';
                        if ($("#action").val() == 'edit') {
                                method = 'PUT';
                        }

                        var wish_id = $('#wish_id').val();
                        var wish_name = $('#wish_name').val();
                        $.ajax({
                                type: method, //GET, POST, PUT
                                url: base_url+'api/setting/wish/',  //the url to call
                                data: { wish_id: wish_id , wish_name: wish_name },     //Data sent to server
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
                                                    window.location.href=base_url+'setting_wish/dashboard';
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
                }else{
                        swal('กรุณากรอกความประสงค์','','error');
                }

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
                url: base_url+'api/setting/wish/'+id,  //the url to call
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
                            window.location.href=base_url+'setting_wish/dashboard';
                        }
                    });

            }).fail(function (err) {
                swal("ลบข้อมูลไม่สำเร็จ", "", "error");
            });
        });
}


