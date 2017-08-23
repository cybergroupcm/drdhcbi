var jwt = Cookies.get("api_token");
var base_url = $('#base_url').attr('class');
$( document ).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });

    //start ปฏิทิน
    $('.datepickerstart').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });

    $('.datepickerend').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        clearBtn: true,
        language: "th-th",
        autoclose: true,
        thaiyear: true,
        todayHighlight: true
    });

    $('.datepicker').each(function(){
        $(this).datepicker('update', $(this).val());
    });
    $('.datepickerstart').each(function(){
        $(this).datepicker('update', $(this).val());
    });
    $('.datepickerend').each(function(){
        $(this).datepicker('update', $(this).val());
    });

    $('.datepickerstart').on('changeDate', function(){
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

    $("#btSearch").click(function() {
        $("#form_search").submit();
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


$(document).ready(function() {
    var table = $('#example1').DataTable({
        "order": [[ 1, "desc" ]],
        "columnDefs": [
            { "targets": [0,6], "orderable": false },
            { "targets": [0,6],"searchable": false }
        ],
        "language": {
            "search": "ค้นหา:",
            "info": "เรื่องที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ เรื่อง",
            "infoEmpty":"Showing 0 to 0 of 0 entries",
            "zeroRecords":"ไม่พบเรื่องที่ค้นหา",
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
} );

function getFileData(keyin_id){
    $.post(  base_url+'file_search/show_file/'+keyin_id , function( data ) {
        $( "#show_file_space" ).html('');
        $( "#show_file_space" ).html(data);
    });
}
