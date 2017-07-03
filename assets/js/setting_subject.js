$( document ).ready(function() {
        var base_url = $('#base_url').attr('class');
        $("#bt_add").click(function () {
                if($('#subject_name').val() != ""){
                        var method = 'POST';
                        if ($("#action").val() == 'edit') {
                                method = 'PUT';
                        }
                        var jwt = Cookies.get("api_token");
                        var subject_id = $('#subject_id').val();
                        var subject_name = $('#subject_name').val();
                        $.ajax({
                                type: method, //GET, POST, PUT
                                url: base_url+'api/setting/subject/',  //the url to call
                                data: { subject_id: subject_id , subject_name: subject_name },     //Data sent to server
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
                                                    window.location.href=base_url+'setting_subject/dashboard';
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
                        swal('กรุณากรอกลักษณะเรื่อง','','error');
                }

        });
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
            var  link = $('#base_url').attr("class")+"setting_subject/dashboard";
            window.location = link;
        });
}


