$( document ).ready(function() {
});

function bt_delete(id) {
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
                        type: 'get', //GET, POST, PUT
                        url: 'http://localhost/drdhcbi/api/setting/accused_type/'+id,  //the url to call
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
                                            window.location.href=$('#base_url').attr('class')+'setting_accused_type/dashboard';
                                    }
                            });


                        //alert(response);
                        //Response ok. process reuslt
                }).fail(function (err) {
                        //console.log(err);
                        swal("ลบข้อมูลไม่สำเร็จ", "", "error");
                        //alert(err);
                        //Error during request
                });
        });
}


