var jwt = Cookies.get("api_token");
$( document ).ready(function() {
        var base_url = $('#base_url').attr('class');
        $("#bt_add").click(function () {
                if($('#subject_name').val() != ""){
                        var method = 'POST';
                        if ($("#action").val() == 'edit') {
                                method = 'PUT';
                        }

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

    var table = $('#example1').DataTable({
        "order": [[ 1, "desc" ]],
        "columnDefs": [
            { "targets": [0,3], "orderable": false },
            { "targets": [0,3],"searchable": false }
        ],
        "language": {
            "search": "ค้นหา:",
            "info": "เรื่องที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ เรื่อง",
            "infoEmpty":"เรื่องที่ 0 ถึง 0 จากทั้งหมด 0 เรื่อง",
            "zeroRecords":"ไม่พบรายการที่ค้นหา",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "ต่อไป",
                "previous":   "ย้อนกลับ"
            },
        },
        "bLengthChange": false,
        "pageLength": 15
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
                url: base_url+'api/setting/subject/'+id,  //the url to call
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
                            window.location.href=base_url+'setting_subject/dashboard';
                        }
                    });
            }).fail(function (err) {
                swal("ลบข้อมูลไม่สำเร็จ", "", "error");
            });
        });
}


