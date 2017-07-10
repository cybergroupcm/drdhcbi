var base_url = $('#base_url').attr('class');
function saveForm() {
    var method = 'POST';
    var text_ok = 'บันทึกข้อมูลสำเร็จ';
    var text_error = 'บันทึกข้อมูลไม่สำเร็จ';
    if ($("#action").val() == 'edit') {
        method = 'PUT';
        text_ok = 'แก้ไขข้อมูลสำเร็จ';
        text_error = 'แก้ไขข้อมูลไม่สำเร็จ';
    }
    var jwt = Cookies.get("api_token");
    var formData = $("#keyInForm").serialize();
    var fileData = new FormData();
    var files = 0;
    $( "input[name='attach_file[]']").each(function() {
        fileData.append("attach_file[]", $(this)[0].files[0]);
        files++;
    });
    $.ajax({
        type: method,
        url: base_url+'api/complaint/key_in/',
        data:formData,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        },
        async: false,
        cache: false
    }).done(function (response,xhr) {
        console.log(response);
        console.log(xhr);
        if(xhr.state = 201 && files > 0){
            fileData.append('keyin_id',response);
            $.ajax({
                type: 'POST', //GET, POST, PUT
                url: base_url+'api/complaint/key_in_file/',  //the url to call
                data: fileData,     //Data sent to server
                beforeSend: function (xhr) {   //Include the bearer token in header
                    xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
                },
                async: false,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (response,xhr) {
                if(xhr.state = 201){
                    swal({
                        title: "สำเร็จ",
                        text: text_ok,
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }).fail(function (err) {
            });
        }else if(xhr.state = 201){
            swal({
                title: "สำเร็จ",
                text: text_ok,
                type: "success",
                timer: 3000,
                showConfirmButton: false
            });
        }else{
            swal("ผิดพลาด",text_error, "error");
        }

    }).fail(function (err) {
        swal("ผิดพลาด",text_error, "error");
    });
}

function validateForm() {
    var text_warning = "";
    if ($('#complain_date').val() == "") {
        text_warning += " - วันที่ร้องทุกข์\n";
    }
    if ($('#recipient').val() == "") {
        text_warning += " - ผู้รับแจ้ง\n";
    }
    if ($('#complain_type_id').val() == "") {
        text_warning += " - ประเภทเรื่อง\n";
    }
    if ($('#complain_name').val() == "") {
        text_warning += " - หัวข้อเรื่อง\n";
    }
    if ($('#channel_id').val() == "") {
        text_warning += " - ช่องทางรับเรื่อง\n";
    }
    if ($('#subject_id').val() == "") {
        text_warning += " - ลักษณะเรื่อง\n";
    }
    if ($('#user_complain_1').is(':checked') === false && $('#user_complain_2').is(':checked') === false) {
        text_warning += " - ผู้ร้องทุกข์\n";
    } else if ($('#user_complain_2').is(':checked') === true) {
        if ($('#pn_id').val() == "" || $('#first_name').val() == "" || $('#last_name').val() == "") {
            text_warning += " - ชื่อผู้ร้องทุกข์\n";
        }
    }

    var complaint_type = 0;
    $(".complaint_type").each(function (index) {
        if ($(this).is(':checked') === true) {
            complaint_type++;
        }
    });
    if (complaint_type == 0) {
        text_warning += " - ประเภทเรื่องร้องทุกข์หลัก\n";
    }

    var accused_type = 0;
    $(".accused_type").each(function (index) {
        if ($(this).is(':checked') === true) {
            accused_type++;
        }
    });
    if (accused_type == 0) {
        text_warning += " - หน่วยงานหรือผู้ถูกร้องเรียนร้องทุกข์\n";
    }

    if ($('#place_scene').val() == "") {
        text_warning += " - สถานที่เกิดเหตุ\n";
    }
    if ($('#province_id').val() == "") {
        text_warning += " - จังหวัด\n";
    }
    if ($('#district_id').val() == "") {
        text_warning += " - อำเภอ\n";
    }
    if ($('#address_id').val() == "") {
        text_warning += " - ตำบล\n";
    }
    if ($('#complaint_detail').val() == "") {
        text_warning += " - เหตุการณ์/พฤติการณ์\n";
    }

    var desire = 0;
    $(".desire").each(function (index) {
        if ($(this).is(':checked') === true) {
            desire++;
        }
    });
    if (desire == 0) {
        text_warning += " - ความประสงค์ในการดำเนินการ\n";
    }


    if (text_warning != "") {
        swal("กรุณาระบุข้อมูลต่อไปนี้", text_warning, "warning");
        return false;
    } else {
        saveForm();
    }
}

function checkFile(id) {
    var x = document.getElementById("attach_file_"+id);
    var txt = "";
    if ('files' in x) {
        var j = 1;
        for (var i = 0; i < x.files.length; i++) {
            var file = x.files[i];
            if (parseInt(file.size) > 1048576) {
                txt += "ไม่สามารถแนบไฟล์ " + file.name + " ได้เนื่องจากไฟล์มีขนาดใหญ่เกินไป<br>";
                var file_show = '<span id="show_file_'+id+'">'+txt+'</span><hr>';
                $('#attach_file_'+id).remove();
            } else {
                //txt += "<br><strong>" + (j) + ". file</strong><br>";
                if ('name' in file) {
                    txt += "name: " + file.name + "<br>";
                }
                if ('size' in file) {
                    txt += "size: " + file.size + " bytes <br>";
                }
                j++;
                var file_show = '<span id="show_file_'+id+'">'+txt+'<input type="button" class="btn btn-danger" value="ลบ" onclick="delete_new_file(\''+id+'\')"><hr></span>';
            }
        }
    }
    
    $('#checkFile').append(file_show);
    //document.getElementById("checkFile").innerHTML = txt;
}

function changeUserComplain() {
    console.log($('#user_complain_1').is(':checked'));
    if ($('#user_complain_2').is(':checked') === true) {
        $('#user_complain_detail').show();
    } else {
        $('#user_complain_detail').hide();
    }
}
var file_count = $("#file_count").val();
function add_new_file(){
    file_count++;
    var input = '<input type="file" name="attach_file[]" class="attach_file" accept=".jpg, .png, .pdf" onchange="checkFile(\''+file_count.toString()+'\')" id="attach_file_'+file_count.toString()+'" style="display:none;">';
    $('#file_add_space').append(input);
    $('#attach_file_'+file_count.toString()).trigger('click');
}

function delete_new_file(id){
    $('#attach_file_'+id).remove();
    $('#show_file_'+id).remove();
}
function ajax_delete(id,file_id) {
    var jwt = Cookies.get("api_token");
    swal({
            title: "ลบไฟล์เอกสารหลักฐาน",
            text: "ต้องการลบไฟล์เอกสารหลักฐานใช่หรือไม่",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function(){
            setTimeout(function(){
                $.ajax({
                    type: "DELETE",
                    url: base_url+'api/complaint/key_in_file/'+id,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
                    },
                    async: false,
                    cache: false
                }).done(function (response,xhr) {
                    if(xhr.state = 200){
                        delete_new_file(file_id);
                        swal({
                            title: "สำเร็จ",
                            text: "ลบไฟล์เอกสารหลักฐานแล้ว",
                            type:"success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }else {
                        swal("ผิดพลาด", "ลบไฟล์เอกสารหลักฐานไม่สำเร็จ", "error");
                    }
                }).fail(function (err) {
                    swal("ผิดพลาด", "ลบไฟล์เอกสารหลักฐานไม่สำเร็จ", "error");
                });
            }, 2000);
        });
}

function get_district(value,defaule_value){
    if(value!=''){
        var province_code = value.substring(0, 3);
        var url = base_url+'complaint/get_district_list/Aumpur/'+province_code+'/'+defaule_value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#district_span').html(data);
            var subdistrict = '';
            subdistrict += '<select name="subdistrict_id" class="form-control" id="subdistrict_id">';
            subdistrict += '<option value="">กรุณาเลือก</option>';
            subdistrict += '</select>';
            $('#subdistrict_span').html(subdistrict);
        });
    }
}

function get_subdistrict(value,defaule_value){
    if(value!=''){
        var district_code = value.substring(0, 4);
        var url = base_url+'complaint/get_district_list/Tamboon/'+district_code+'/'+defaule_value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#subdistrict_span').html(data);
        });
    }
}

$(document).ready(function () {
    $('.datepicker').datepicker({
        language: 'th-th',
        format: 'dd/mm/yyyy',
        thaiyear: true
    });
    changeUserComplain();
});