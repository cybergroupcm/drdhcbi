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
        }else if($('#user_complain_2').is(':checked') === true){
            if($('#complainter_name').val() == ""){
                text_warning += " - ชื่อผู้ร้องทุกข์\n";
            }
        }
        
        var complaint_type = 0;
        $(".complaint_type").each(function(index) {
            if($(this).is(':checked') === true){
                complaint_type++;
            }
        });
        if(complaint_type == 0){
            text_warning += " - ประเภทเรื่องร้องทุกข์หลัก\n";
        }
        
        var complainant = 0;
        $(".complainant").each(function(index) {
            if($(this).is(':checked') === true){
                complainant++;
            }
        });
        if(complainant == 0){
            text_warning += " - หน่วยงานหรือผู้ถูกร้องเรียนร้องทุกข์\n";
        }
        
        if ($('#place_happen').val() == "") {
            text_warning += " - สถานที่เกิดเหตุ\n";
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
        if ($('#case_event').val() == "") {
            text_warning += " - เหตุการณ์/พฤติการณ์\n";
        }
        
        var desire = 0;
        $(".desire").each(function(index) {
            if($(this).is(':checked') === true){
                desire++;
            }
        });
        if(desire == 0){
            text_warning += " - ความประสงค์ในการดำเนินการ\n";
        }
        
        
        if (text_warning != "") {
            swal("กรุณาระบุข้อมูลต่อไปนี้", text_warning, "warning");
            return false;
        }
    }
    function checkFile(){
        var x = document.getElementById("myFile");
        var txt = "";
        if ('files' in x) {
            var j=1;
            for (var i = 0; i < x.files.length; i++) {
                var file = x.files[i];
                if(parseInt(file.size)>1048576){
                    txt += "ไม่สามารถแนบไฟล์ " + file.name + " ได้เนื่องจากไฟล์มีขนาดใหญ่เกินไป<br>";
                }else{
                    txt += "<br><strong>" + (j) + ". file</strong><br>";
                    if ('name' in file) {
                        txt += "name: " + file.name + "<br>";
                    }
                    if ('size' in file) {
                        txt += "size: " + file.size + " bytes <br>";
                    }
                    j++;
                }
            }
        }
        console.log(x.files);
        document.getElementById("checkFile").innerHTML = txt;
    }
    
    function changeUserComplain(){
        if($('#user_complain_1').is(':checked') === true){
            $('#user_complain_detail').hide();
        }else{
            $('#user_complain_detail').show();
        }
    }
    
    function add_file(){
    
    }

    $(document).ready(function () {
        $('.datepicker').datepicker({
            language: 'th',
            thaiyear: true
        });
    });