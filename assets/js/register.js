    function validateForm() {
        var action = '';
        if($('#id').val()!=''){
            action = 'edit';
        }
        var text_warning = "";
        if ($('#username').val() == "") {
            text_warning += " - ชื่อผู้ใช้งาน\n";
        }
        if(action == "") {
            if ($('#password').val() == "") {
                text_warning += " - รหัสผ่าน\n";
            }else{
                if($('#password').val() != $('#password2').val()){
                    text_warning += " - การยืนยันรหัสผ่านไม่ตรงกัน\n";
                }
            }
        }else{
            if($('#password').val() != $('#password2').val()){
                text_warning += " - การยืนยันรหัสผ่านไม่ตรงกัน\n";
            }
        }
        if ($('#email').val() == "" ) {
            text_warning += " - อีเมล์\n";
        }else{
            if($('#email').val() != $('#email2').val() ){
                if(action == "") {
                    text_warning += " - การยืนยัน email ไม่ตรงกัน\n";
                }
            }
        }
        if ($('#idcard').val() == "") {
            text_warning += " - รหัสประจำตัวประชาชน\n";
        }
        if ($('#prename_th_id').val() == "") {
            text_warning += " - คำนำหน้าชื่อ\n";
        }
        if ($('#name_th').val() == "") {
            text_warning += " - ชื่อ\n";
        }
        if ($('#surname_th').val() == "") {
            text_warning += " - นามสกุล\n";
        }
        if ($('#gender1').is(':checked') === false && $('#gender2').is(':checked') === false ) {
         if(action == ""){
             text_warning += " - เพศ\n";
         }
        }
        if ($('#section').val() == "") {
            text_warning += " - หน่วยงาน/แผนก ที่สังกัด\n";
        }
//        if ($('#address').val() == "") {
//            text_warning += " - ที่อยู่\n";
//        }
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
                    window.location.href=base_url+$('#action_to').val();
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

function get_list_text(id_from, id_to){
    $('#'+id_to).val($('#'+id_from+' :selected').text());
}

function check_username(value){
    if(value!=''){
        block_ui();
        var url = base_url+'admin/users/check_username/'+value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            if(data!=''){
                $('#username_confirm_text').html('ไม่สามารถใช้ username นี้ได้');
                $('#username').focus();
                $.unblockUI();
            }else{
                $('#username_confirm_text').html('');
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
