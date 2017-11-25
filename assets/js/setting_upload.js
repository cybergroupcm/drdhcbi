var base_url = $('#base_url').attr('class');
var jwt = Cookies.get("api_token");
$( document ).ready(function() {

});

function save_setting(){
    var base_url = $('#base_url').attr('class');
    var setting_id = $('#setting_id').val();
    var upload_size = $('#upload_size').val();
    var upload_type = $('#upload_type').val();
    swal({title: "คุณต้องการบันทึกข้อมูลหรือไม่?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00C0EF",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false},
        function () {
            $.ajax({
                type: 'POST', //GET, POST, PUT
                url: base_url+'api/setting/setting_upload/',  //the url to call
                data:{setting_id : setting_id, upload_size : upload_size, upload_type : upload_type},
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
                            window.location.href=base_url+'setting_upload/dashboard';
                        }
                    });

            }).fail(function (err) {
                swal("บันทึกข้อมูลไม่สำเร็จ", "", "error");
            });
        });
}
