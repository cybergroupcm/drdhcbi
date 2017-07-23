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
        var parent_id = $('#parent_id').val();
        $.ajax({
            type: method, //GET, POST, PUT
            url: base_url+'api/setting/accused_type/',  //the url to call
            data: { accused_type_id: accused_type_id , accused_type: accused_type, parent_id: parent_id },     //Data sent to server
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
                        if(parent_id == 0) {
                            window.location.href=base_url+'setting_accused_type/dashboard';
                        }else{
                            window.location.href = base_url + 'setting_accused_type/dashboard?type=parent&parent_id='+parent_id;
                        }
                    }
                });

        }).fail(function (err) {
            swal("บันทึกข้อมูลไม่สำเร็จ", "", "error");
        });
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
    var url = $('#base_url').attr("class")+"setting_accused_type/getAccusedType/"+id;
    $.ajax({
        method: "GET",
        url: url,
        async:false
    }).done(function (result) {
        var  data_use = JSON.parse(result);
        if(data_use == 'YES'){
            save_delete(id);
        }else{
            swal("ไม่สามารถลบข้อมูลได้ \nเนื่องจากรายการนี้ถูกใช้งานแล้ว", "", "error");
        }
    });
}

function save_delete(id){
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
