var base_url = $('#base_url').attr('class');
function checkData() {
    if($('#username').val() == '' || $('#email').val() == '' || $('#idcard').val() == ''){
        swal("กรุณากรอกข้อมูลให้ครบถ้วน",'', "error");
    }else {
        var method = 'POST';
        var formData = $("#checkDataForm").serialize();
        $.ajax({
            type: method,
            url: base_url + 'api/authen/repassword_info/',
            data: formData,
            async: false,
            cache: false
        }).done(function (response) {
            console.log(response);
            $('#id').val(response);
            swal({
                title: "พบข้อมูล",
                text: '',
                type: "success",
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function(){
                $('#check_data').hide();
                $('#show_repassword').show();
            }, 2000);

        }).fail(function (err) {
            swal("ไม่พบข้อมูล",'', "error");
        });
    }
}

function saveData() {
    if($('#repassword').val()==''){
        swal("กรุณากรอกรหัสผ่าน",'', "error");
    }else if($('#repassword').val()!=$('#repassword2').val()){
        swal("การยืนยันรหัสผ่านไม่ตรงกัน",'', "error");
    }else{
        var method = 'POST';
        var formData = $("#repasswordForm").serialize();
        $.ajax({
            type: method,
            url: base_url+'api/authen/repassword/',
            data:formData,
            async: false,
            cache: false
        }).done(function (response) {
            swal({
                title: "เปลี่ยนรหัสผ่านสำเร็จ",
                text: '',
                type: "success",
                timer: 2000,
                showConfirmButton: false
            });
            setTimeout(function(){
                $(location).attr('href',base_url);
            }, 2000);
        }).fail(function (err) {
            swal("ไม่สามารถบันทึกข้อมูลได้",'', "error");
        });
    }
}
$(document).ready(function () {
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