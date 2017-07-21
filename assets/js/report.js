var base_url = $('#base_url').attr('class');
$( document ).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน


    //start ปฏิทิน
    $('.datepickerstart').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    });

    $('.datepickerend').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    });

    $('.datepickerstart').on('changeDate', function(){
        //var dateMin = $(this).val();
        var arrDateMin= $(this).val().split('/');
        var dateMin = parseInt(arrDateMin[0])+'/'+parseInt(arrDateMin[1])+'/'+parseInt((arrDateMin[2]-543));
        $('.datepickerend').datepicker('setStartDate', dateMin);
    });
    $('.datepickerend').on('changeDate', function(){
        var arrDateMax= $(this).val().split('/');
        var dateMax =parseInt(arrDateMax[0])+'/'+parseInt(arrDateMax[1])+'/'+parseInt((arrDateMax[2]-543));
        $('.datepickerstart').datepicker('setEndDate', dateMax);
    });
    //end ปฏิทิน

    $("#btSearchType").click(function() {
        var base_url = $('#base_url').attr('class');
        var year = $("#year").val();
        var complain_type_id = $("#complain_type_id").val();
        var partid = $("#partid").val();
        var province_id = $("#province_id").val();
        var district_id = $("#district_id").val();
        var address_id = $("#address_id").val();
        window.location.href=base_url+'report/report_statistic_by_type?year='+year+'&complain_type_id='+complain_type_id+'&partid='+partid+'&province_id='+province_id+'&district_id='+district_id+'&address_id='+address_id;
    });

    $("#btClearType").click(function() {
        var base_url = $('#base_url').attr('class');
        window.location.href=base_url+'report/report_statistic_by_type';
    });

    $("#btSearchStatus").click(function() {
        var base_url = $('#base_url').attr('class');
        var year = $("#year").val();
        var current_status_id = $("#current_status_id").val();
        var partid = $("#partid").val();
        var province_id = $("#province_id").val();
        var district_id = $("#district_id").val();
        var address_id = $("#address_id").val();
        window.location.href=base_url+'report/report_statistic_by_status?year='+year+'&current_status_id='+current_status_id+'&partid='+partid+'&province_id='+province_id+'&district_id='+district_id+'&address_id='+address_id;
    });

    $("#btClearStatus").click(function() {
        var base_url = $('#base_url').attr('class');
        window.location.href=base_url+'report/report_statistic_by_status';
    });
});
function thaidateformat(d,long) {
    var gD = new Date(d);
    var thmonthCut = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
    var thmonthLong = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
    if(long == 'S'){
        thmonth = thmonthCut;
    }else{
        thmonth =  thmonthLong;
    }
    return gD.getDate() + ' ' + thmonth[gD.getMonth()] + ' ' + (gD.getFullYear() + 543);
}

function get_district(value,defaule_value){
    var base_url = $('#base_url').attr('class');
    if(value!=''){
        var province_code = value.substring(0, 3);
        var url = base_url+'complaint/get_district_list/Aumpur/'+province_code+'/'+defaule_value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#district_span').html(data);
            var subdistrict = '';
            subdistrict += '<select name="address_id" class="form-control" id="address_id">';
            subdistrict += '<option value="">กรุณาเลือก</option>';
            subdistrict += '</select>';
            $('#subdistrict_span').html(subdistrict);
        });
    }
}

function get_subdistrict(value,defaule_value){
    var base_url = $('#base_url').attr('class');
    if(value!=''){
        var district_code = value.substring(0, 4);
        var url = base_url+'complaint/get_district_list/Tamboon/'+district_code+'/'+defaule_value;  //the url to call
        $.post(url, {data: ''}, function (data) {
            $('#subdistrict_span').html(data);
        });
    }
}


