    function validateForm() {
        var action = '';
        if($('#id').val()!=''){
            action = 'edit';
        }
        var text_warning = "";

        if(action != "") {
            if ($('#prename_th_id').val() == "") {
                text_warning += " - คำนำหน้าชื่อ\n";
            }
        }
        if($("#id_type").val() == '1') {
            if ($('#idcard').val() == "") {
                text_warning += " - รหัสประจำตัวประชาชน\n";
            }
            if($('#id_type').val() == 1 ){
              if(!CheckIdCardThai($('#idcard').val())){
                text_warning += "เลขบัตรประจำตัวประชาชนไม่ตามกรมการปกครอง\n";
              }
            }
            if ($('#name_th').val() == "") {
                text_warning += " - ชื่อ\n";
            }
            if ($('#surname_th').val() == "") {
                text_warning += " - นามสกุล\n";
            }
        }else if($("#id_type").val() == '2'){
          if ($('#idcard').val() == "") {
              text_warning += " - Passport\n";
          }
          if ($('#name_en').val() == "") {
              text_warning += " - First name\n";
          }
          if ($('#surname_en').val() == "") {
              text_warning += " - Last name\n";
          }
        }
        if ($('#gender1').is(':checked') === false && $('#gender2').is(':checked') === false ) {
         if(action != ""){
             text_warning += " - เพศ\n";
         }
        }
        if(action != "") {
            if ($('#section').val() == "") {
                text_warning += " - หน่วยงาน/แผนก ที่สังกัด\n";
            }

            if ($('#address').val() == "") {
                text_warning += " - ที่อยู่\n";
            }
        }
        if ($('#province').val() == "") {
            text_warning += " - จังหวัด\n";
        }
        if ($('#district').val() == "") {
            text_warning += " - อำเภอ\n";
        }
        if ($('#sub_district').val() == "") {
            text_warning += " - ตำบล\n";
        }

        if(action != "") {
            if ($('#email').val() == "" ) {
                text_warning += " - อีเมล์\n";
            }else{
                if($('#email').val() != $('#email2').val() && $('#email2').val() !='none'){
                    text_warning += " - การยืนยัน email ไม่ตรงกัน\n";
                }
            }
        }

        if ($('#phone_number').val() == "") {
            text_warning += " - เบอร์โทรศัพท์\n";
        }
        if ($('#username').val() == "") {
            text_warning += " - ชื่อผู้ใช้งาน\n";
        }

        if(action == "") {
            if ($('#password').val() == "") {
                text_warning += " - รหัสผ่าน\n";
            }else{
                if ($('#password2').val() == "") {
                    text_warning += " - ยืนยันรหัสผ่าน\n";
                }else {
                    if ($('#password').val() != $('#password2').val()) {
                        text_warning += " - การยืนยันรหัสผ่านไม่ตรงกัน\n";
                    }
                }
            }
        }else{
            if($('#password').val() != $('#password2').val()){
                text_warning += " - การยืนยันรหัสผ่านไม่ตรงกัน\n";
            }
        }

        if (text_warning != "") {
            swal("กรุณาระบุข้อมูลต่อไปนี้", text_warning, "warning");
            return false;
        }else{
            //var data = $("#frm_user").serialize();
            var data = new FormData($("#frm_user")[0]);

            $.ajax({
                    method: "POST",
                    url: base_url +"api/user/user/",
                    data: data,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function( msg ) {
                    block_ui();
                    //console.log(msg);
                    swal({
                            title: "บันทึกข้อมูลเรียบร้อยแล้ว",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonText: "ยืนยัน",
                            closeOnConfirm: true},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location.href=base_url+$('#action_to').val();
                            }
                        });

                });
        }
    }

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
        if($('#id_type').val() == 1 && element.value != ''){
          if(!CheckIdCardThai(element.value)){
            swal("กรุณาตรวจสอบข้อมูล", 'เลขบัตรประจำตัวประชาชนไม่ตามกรมการปกครอง', "warning");
            return false;
          }
        }
    }

    function check_first_letters(element,event){
        if($('#'+element.id).val() == ''){
            var inputValue = event.which;
            // allow letters and whitespaces only.
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                event.preventDefault();
            }
        }
    }

    function validateEmail(element){
        if($('#'+element.id).val()!=''){
            if (/^\w+([\.-]?\ w+)*@\w+([\.-]?\ w+)*(\.\w{2,3})+$/.test($('#'+element.id).val())){
                //return (true);
            }else{
                swal("","ท่านกรอกรูปแบบของ email ไม่ถูกต้อง","warning");
                $('#'+element.id).focus();
                //return (false);
            }
        }
    }

    function confirm_input(id_main,id_confirm,id_return){
        if($('#'+id_main).val()!=$('#'+id_confirm).val()){
            $('#'+id_return).text('การยืนยันข้อมูลไม่ตรงกัน');
        }else{
            $('#'+id_return).text('');
        }
    }

    $( document ).ready(function() {
        //input no symbol
        var restricted = [96, 126, 40, 41, 61, 91, 93, 123, 125, 92, 124, 59, 47, 60, 62];

        $('.no_symbol').keypress(function (event) {
          if (restricted.indexOf(event.which) !== -1) {
            console.log('key restricted!');
            event.preventDefault();
          }
        });

        //input number
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

        $(".letters").keypress(function(event){
            var inputValue = event.which;
            // allow letters and whitespaces only.
            if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
                event.preventDefault();
            }
        });

        $("#id_type").change(function() {
            if($(this).val() == '2'){
                $(".show_input").hide();
                $("#idcard").attr("placeholder", "Passport");
                $("#prename_en option[value='']").text('Prename');
                $("#name_en").attr("placeholder", "First name");
                $("#surname_en").attr("placeholder", "Last name");
                $("#address").attr("placeholder", "Address");
                $("#email").attr("placeholder", "Email address");
                $("#phone_number").attr("placeholder", "Phone");
                $("#username").attr("placeholder", "User name");
                $("#password").attr("placeholder", "Enter a password");
                $("#password2").attr("placeholder", "Confirm the password");
                $('#text_danger_name_en').html("*");
                $('#text_danger_surname_en').html("*");
            }else{
                $(".show_input").show();
                $("#idcard").attr("placeholder", "รหัสประจำตัวประชาชน");
                $("#prename_en option[value='']").text('คำนำหน้าชื่อ (ภาษาอังกฤษ)');
                $("#name_en").attr("placeholder", "ชื่อ (ภาษาอังกฤษ)");
                $("#surname_en").attr("placeholder", "นามสกุล (ภาษาอังกฤษ)");
                $("#address").attr("placeholder", "ที่อยู่ติดต่อกลับ");
                $("#email").attr("placeholder", "อีเมลล์");
                $("#phone_number").attr("placeholder", "เบอร์โทรศัพท์");
                $("#username").attr("placeholder", "ชื่อผู้ใช้");
                $("#password").attr("placeholder", "รหัสผ่าน");
                $("#password2").attr("placeholder", "ยืนยันรหัสผ่าน");
                $('#text_danger_name_en').html("");
                $('#text_danger_surname_en').html("");
            }
        });

    });
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#show_photo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function get_district(value,defaule_value){
    if(value!=''){
        var province_code = value.substring(0, 3);
        var url = base_url+'auth/get_district_list/Aumpur/'+province_code+'/'+defaule_value;  //the url to call
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
        var url = base_url+'auth/get_district_list/Tamboon/'+district_code+'/'+defaule_value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#subdistrict_span').html(data);
        });
    }
}

function get_list_text(id_from, id_to){
    $('#'+id_to).val($('#'+id_from+' :selected').text());
}

function check_username(value){
    if(value!=''){
        block_ui();
        var url = base_url+'auth/check_username/'+value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            if(data!=''){
                //$('#username_confirm_text').html('ไม่สามารถใช้ username นี้ได้');
                swal('ไม่สามารถใช้ username นี้ได้');
                $('#username').focus();
                $.unblockUI();
            }else{
                //$('#username_confirm_text').html('');
                $.unblockUI();
            }
        });
    }
}

function block_ui(){
    $.blockUI({
        message: '<h3 style="color:#FFF;">กรุณารอสักครู่<h3>',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        },
        baseZ: 9000,
    });
}
