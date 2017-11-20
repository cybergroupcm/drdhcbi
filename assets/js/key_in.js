var base_url = $('#base_url').attr('class');
function saveForm(action_to) {
    var method = 'POST';
    var text_ok = 'บันทึกข้อมูลสำเร็จ';
    var text_error = 'บันทึกข้อมูลไม่สำเร็จ';
    if ($("#action").val() == 'edit') {
        method = 'PUT';
        text_ok = 'บันทึกข้อมูลสำเร็จ';
        text_error = 'บันทึกข้อมูลไม่สำเร็จ';
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
        if($('#keyin_id').val()!=''){
            var keyin_id = $('#keyin_id').val();
        }else{
            var keyin_id = response;
        }
        if(xhr.state = 201 && files > 0){
            fileData.append('keyin_id',keyin_id);
            console.log(fileData);
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
                    if(action_to == 'key_in_step5'){
                      swal({
                          title: "สำเร็จ",
                          text: text_ok,
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      });
                    }
                    setTimeout(function(){
                        $(location).attr('href',base_url+'complaint/key_in/'+action_to+'/'+keyin_id);
                    }, 2000);
                }else {
                    swal("ผิดพลาด",text_error, "error");
                }
            }).fail(function (err) {
            });
        }else if(xhr.state = 201){
            if(action_to == 'key_in_step5'){
              swal({
                  title: "สำเร็จ",
                  text: text_ok,
                  type: "success",
                  timer: 3000,
                  showConfirmButton: false
              });
            }
            setTimeout(function(){
                if(action_to=='dashboard' || action_to=='dashboard_member'){
                    $(location).attr('href',base_url+'complaint/'+action_to);
                }else if(action_to == 'key_in_step5_pdf'){
                    window.open(base_url+'complaint/'+action_to+'/'+keyin_id, "_blank");
                }else{
                    $(location).attr('href',base_url+'complaint/key_in/'+action_to+'/'+keyin_id);
                }
            }, 2000);
        }else{
            swal("ผิดพลาด",text_error, "error");
        }

    }).fail(function (err) {
        swal("ผิดพลาด",text_error, "error");
    });
}

function validateForm(action_to,type) {
    var text_warning = "";
    if($('#step_now').val()=='1') {
        if ($('#complain_date').val() == "") {
            text_warning += " - วันที่ร้องทุกข์\n";
        }
        if ($('#recipient').val() == "") {
            text_warning += " - ผู้รับแจ้ง\n";
        }
        if ($('#user_complain_1').is(':checked') === false && $('#user_complain_2').is(':checked') === false) {
            text_warning += " - ผู้ร้องทุกข์\n";
        } else if ($('#user_complain_2').is(':checked') === true) {
            if ($('#id_card').val() == "") {
                text_warning += " - รหัสประจำตัวประชาชนของผู้ร้องทุกข์\n";
            }else{
                if(!CheckIdCardThai($('#id_card').val())){
                    text_warning += " - เลขบัตรประจำตัวประชาชนไม่ตามกรมการปกครอง\n";
                }
            }
            if ($('#pn_id').val() == "" || $('#first_name').val() == "" || $('#last_name').val() == "") {
                text_warning += " - ชื่อผู้ร้องทุกข์\n";
            }
            if ($('#phone_number').val() == "") {
                text_warning += " - โทรศัพท์เคลื่อนที่ของผู้ร้องทุกข์\n";
            }
        }
    }else if($('#step_now').val()=='3'){
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

        if ($('#accused_type_id').val() == '') {
            text_warning += " - หน่วยงานหรือผู้ถูกร้องเรียนร้องทุกข์\n";
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
    }else if($('#step_now').val()=='2'){
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
    }

    if (text_warning != "" && type != 'back') {
        swal("กรุณาระบุข้อมูลต่อไปนี้", text_warning, "warning");
        return false;
    } else {
        saveForm(action_to);
    }
}

function checkFile(id) {
    var x = document.getElementById("attach_file_"+id);
    var txt = "";
    if ('files' in x) {
        var j = 1;
        for (var i = 0; i < x.files.length; i++) {
            var file = x.files[i];
            /*if (parseInt(file.size) > 1048576) {
                txt += "ไม่สามารถแนบไฟล์ " + file.name + " ได้เนื่องจากไฟล์มีขนาดใหญ่เกินไป<br>";
                var file_show = '<span id="show_file_'+id+'">'+txt+'</span><hr>';
                $('#attach_file_'+id).remove();
            } else {*/
                //txt += "<br><strong>" + (j) + ". file</strong><br>";
                if ('name' in file) {
                    txt += "name: " + file.name + "<br>";
                }
                if ('size' in file) {
                    txt += "size: " + file.size + " bytes <br>";
                }
                j++;
                var file_show = '<span id="show_file_'+id+'">'+txt+'<input type="button" class="btn btn-danger" value="ลบ" onclick="delete_new_file(\''+id+'\')"><hr></span>';
            //}
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
    var input = '<input type="file" name="attach_file[]" class="attach_file" onchange="checkFile(\''+file_count.toString()+'\')" id="attach_file_'+file_count.toString()+'" style="display:none;">';
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
var count_accused = 0;
function get_accused_child(ele){
    var value = ele.value;
    $('#accused_type_id').val(value);
    if($('#'+ele.id).attr('has_child') != '') {
        $('#' + $('#' + ele.id).attr('has_child')).html('');
    }
    if(value!=''){
        count_accused++;
        var url = base_url+'complaint/get_accused_child/'+value+'/'+count_accused;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#' + $('#' + ele.id).attr('has_child')).append(data);
        });
    }
}

var count_complain_type = 0;
function get_complain_type_child(ele){
    var value = ele.value;
    $('#complain_type_id').val(value);
    if($('#'+ele.id).attr('has_child') != '') {
        $('#' + $('#' + ele.id).attr('has_child')).html('');
    }
    if(value!=''){
        count_complain_type++;
        var url = base_url+'complaint/get_complain_type_child/'+value+'/'+count_complain_type;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#' + $('#' + ele.id).attr('has_child')).append(data);
        });
    }
}

$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });
    $('.datetimepicker').datetimepicker({
        locale: 'th',
        format: 'DD/MM/BBBB HH:mm:ss',
        dayViewHeaderFormat: 'MMMM BBBB',
        showTodayButton: true,
        showClear: true,
        tooltips: {
            today: 'วันนี้',
            clear: 'ล้างค่า',
            selectTime: 'เลือกเวลา'
        }
    });
    $('.datetimepicker').on("dp.change", function (e) {
        $(this).data("DateTimePicker").hide();
    });
    $('.datepicker').each(function(){
        $(this).datepicker('update', $(this).val());
    });
    $('.datepicker').blur(function(){
        $(this).datepicker('update', $(this).val());
    });
    changeUserComplain();

    $(".numbers").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

function CheckIdCardIsNumeric(input) {
    var RE = /^-?(0|INF|(0[1-7][0-7]*)|(0x[0-9a-fA-F]+)|((0|[1-9][0-9]*|(?=[\.,]))([\.,][0-9]+)?([eE]-?\d+)?))$/;
    return (RE.test(input));
}

function CheckIdCardThai(id) {

    id = id.toString();
    id = id.replace('-', '');
    // for support jquery masked input
    id = id.replace('-', '');
    id = id.replace('-', '');
    id = id.replace('-', '');

    if (!CheckIdCardIsNumeric(id))
        return false;
    if (id.substring(0, 1) == 0)
        return false;
    if (id.length != 13)
        return false;
    for (i = 0, sum = 0; i < 12; i++)
        sum += parseFloat(id.charAt(i)) * (13 - i);
    if ((11 - sum % 11) % 10 != parseFloat(id.charAt(12)))
        return false;
    return true;
}

function checkIdCardRegister(element){
    if(element.value != ''){
        if(!CheckIdCardThai(element.value)){
            swal("กรุณาตรวจสอบข้อมูล", 'เลขบัตรประจำตัวประชาชนไม่ตามกรมการปกครอง', "warning");
            return false;
        }
    }
}
