    function validateForm() {
        var text_warning = "";
        if ($('#username').val() == "") {
            text_warning += " - ชื่อผู้ใช้งาน\n";
        }
        if ($('#password').val() == "") {
            text_warning += " - รหัสผ่าน\n";
        }else{
            if($('#password').val() != $('#password2').val()){
                text_warning += " - การยืนยันรหัสผ่านไม่ตรงกัน\n";
            }
        }
        if ($('#email').val() == "") {
            text_warning += " - อีเมล์\n";
        }else{
            if($('#email').val() != $('#email2').val()){
                text_warning += " - การยืนยัน email ไม่ตรงกัน\n";
            }
        }
        if ($('#idcard').val() == "") {
            text_warning += " - รหัสประจำตัวประชาชน\n";
        }
        if ($('#prename_th').val() == "") {
            text_warning += " - คำนำหน้าชื่อ\n";
        }
        if ($('#name_th').val() == "") {
            text_warning += " - ชื่อ\n";
        }
        if ($('#surname_th').val() == "") {
            text_warning += " - นามสกุล\n";
        }
        if ($('#gentle1').is(':checked') === false && $('#gentle2').is(':checked') === false) {
            text_warning += " - เพศ\n";
        }
        if ($('#section').val() == "") {
            text_warning += " - หน่วยงาน/แผนก ที่สังกัด\n";
        }
        if ($('#address').val() == "") {
            text_warning += " - ที่อยู่\n";
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
        
        
        if (text_warning != "") {
            swal("กรุณาระบุข้อมูลต่อไปนี้", text_warning, "warning");
            return false;
        }else{

            var data = $("#frm_user").serialize();
            $.ajax({
                    method: "POST",
                    url: base_url +"auth/save_user",
                    data: data
                })
                .done(function( msg ) {
                    console.log( "Data Saved: " + msg );
                });
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
    });