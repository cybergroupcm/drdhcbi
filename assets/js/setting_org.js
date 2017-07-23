var jwt = Cookies.get("api_token");
$( document ).ready(function() {
        var base_url = $('#base_url').attr('class');
        $("#bt_add").click(function () {
                if($('#send_org_name').val() != ""){
                        var method = 'POST';
                        if ($("#action").val() == 'edit') {
                                method = 'PUT';
                        }

                        var send_org_id = $('#send_org_id').val();
                        var send_org_name = $('#send_org_name').val();
                        var parent_id = $('#parent_id').val();
                        $.ajax({
                                type: method, //GET, POST, PUT
                                url: base_url+'api/setting/org/',  //the url to call
                                data: { send_org_id: send_org_id , send_org_name: send_org_name  , parent_id: parent_id },     //Data sent to server
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
                                                    window.location.href = base_url + 'setting_org/dashboard';
                                                }else{
                                                    window.location.href = base_url + 'setting_org/dashboard?type=parent&parent_id='+parent_id;
                                                }
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
    var url = $('#base_url').attr("class")+"setting_org/getUseOrg/"+id;
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
             url: base_url+'api/setting/org/'+id,  //the url to call
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
                    window.location.href=base_url+'setting_org/dashboard';
                 }
             });

         }).fail(function (err) {
            swal("ลบข้อมูลไม่สำเร็จ", "", "error");
         });
     });

}


