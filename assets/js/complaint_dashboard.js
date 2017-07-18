var jwt = Cookies.get("api_token");
$( document ).ready(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayBtn: true,
        language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
        thaiyear: true              //Set เป็นปี พ.ศ.
    });
    //datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    $(".datepicker").prop('readonly', 'readonly');


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

    $('#bt_add').click(function(){
        var  link = $('#base_url').attr("class")+"complaint/key_in";
        window.location = link;
    });

    $(document).on("click", ".open-received", function () {
        var req_id = $(this).data('id');
        getDataReceived(req_id);
    });

    $(document).on("click", ".open-send", function () {
        var req_id = $(this).data('id');
        getDataSend(req_id);
    });

    $(document).on("click", ".open-result", function () {
        var id = $(this).data('id');
        $('#keyin_id_result').val(id);
        var url = $('#base_url').attr("class")+"complaint/getDataResult/"+id;
        $.ajax({
            method: "GET",
            url: url,
            async:false
        }).done(function (result) {
            var dataReceived = JSON.parse(result);
            console.log(dataReceived.result);
            if (dataReceived.result != null) {
                $('#result_detail').val(dataReceived.result.result_detail);
                if (dataReceived.result_date != '0000-00-00') {
                    var result_date = dataReceived.result.result_date.split('-');
                    $('#result_date').val(result_date[2] + '/' + result_date[1] + '/' + (parseInt(result_date[0]) + 543));
                }
                $('#result_id').val(dataReceived.result.result_id);
                var result_attach_file = dataReceived.result_attach_file;
                $('#checkFile').html('');
                for (var key in result_attach_file) {
                    console.log(result_attach_file[key]);
                    txt_append = "<div id='file_" + result_attach_file[key].file_id + "'>name : <a href='" + $('#base_url').attr("class") + "upload/result_attach_file/" + result_attach_file[key].file_system_name + "' target='_blank'>" + result_attach_file[key].file_name + "</a><br>";
                    txt_append += "<input type='button' class='btn btn-danger' onclick=\"delete_result_file('" + result_attach_file[key].file_id + "', '" + result_attach_file[key].file_system_name + "')\" value='ลบ'></div>";
                    $('#checkFile').append(txt_append);
                }
            }
        });

        var url = $('#base_url').attr("class")+"complaint/getDataReceived/"+id;
        $.ajax({
            method: "GET",
            url: url,
            async:false
        }).done(function (result) {
            var  dataReceived = JSON.parse(result);
            if(dataReceived.current_status_id == '4'){
                if(!$('#save_result_status').prop('checked')) {
                    $("#save_result_status").prop("checked", true);
                }
            }else{
                if($('#save_result_status').prop('checked')) {
                    $("#save_result_status").prop("checked", false);
                }
            }
        });
    });

    $("#btFilter").click(function() {
        $("#form_filter").submit();
    });

    $("#btSearch").click(function() {
        $("#form_search").submit();
    });
});

function getDataReceived(id){
    var url = $('#base_url').attr("class")+"complaint/getDataReceived/"+id;
    $.ajax({
        method: "GET",
        url: url,
        async:false
    }).done(function (result) {
        var  dataReceived = JSON.parse(result);
        $('#keyin_id').val(dataReceived.keyin_id);
        $('#complain_no').val(dataReceived.complain_no);
        $('#text_complain_no').html(dataReceived.complain_no);
        $('#complain_name').val(dataReceived.complain_name);
        $('#text_complain_name').html(dataReceived.complain_name);
        $('#recipient').val(dataReceived.recipient);
        $('#text_recipient').html(dataReceived.recipient);
        if((dataReceived.doc_receive_date != '') && (dataReceived.doc_receive_date != '0000-00-00')) {
            $('#doc_receive_date').val(dataReceived.doc_receive_date);
            $('#text_doc_receive_date').html(thaidateformat(dataReceived.doc_receive_date));
        }else{
            $('#text_doc_receive_date').html('-');
        }

        if((dataReceived.receive_date != '') && (dataReceived.receive_date != '0000-00-00') && (dataReceived.receive_date != null)) {
            var arr_receive_date = dataReceived.receive_date.split('-');
            var receive_date_eng = arr_receive_date[2]+'/'+arr_receive_date[1]+'/'+arr_receive_date[0];
            $('#receive_date').datepicker("setDate", receive_date_eng);  //กำหนดวัน
        }else{
            $('#receive_date').datepicker("setDate", "");
        }

        if(dataReceived.current_status_id == '2' || dataReceived.current_status_id == '3'){
            if(!$('#receive_status').prop('checked')) {
                $("#receive_status").prop("checked", true);
            }
        }else{
            if($('#receive_status').prop('checked')) {
                $("#receive_status").prop("checked", false);
            }
        }
    });
}

function getDataSend(id){
    $('#keyin_id_send').val(id);
    var url = $('#base_url').attr("class")+"complaint/getDataSend/"+id;
    $.ajax({
        method: "GET",
        url: url,
        async:false
    }).done(function (result) {
        var  dataSend = JSON.parse(result);
        if((dataSend.reply_date != '') && (dataSend.reply_date != '0000-00-00') && (dataSend.reply_date != null)) {
            var arr_reply_date = dataSend.reply_date.split('-');
            var reply_date_eng = arr_reply_date[2]+'/'+arr_reply_date[1]+'/'+arr_reply_date[0];
            $('#reply_date').datepicker("setDate", reply_date_eng);  //กำหนดวัน
        }else{
            $('#reply_date').datepicker("setDate", "");
        }

        if((dataSend.send_org_date != '') && (dataSend.send_org_date != '0000-00-00') && (dataSend.send_org_date != null)) {
            var arr_send_org_date = dataSend.send_org_date.split('-');
            var send_org_date_eng = arr_send_org_date[2]+'/'+arr_send_org_date[1]+'/'+arr_send_org_date[0];
            $('#send_org_date').datepicker("setDate", send_org_date_eng);  //กำหนดวัน
        }else{
            $('#send_org_date').datepicker("setDate", "");
        }

        var send_org_id = dataSend.send_org_id;

        if(send_org_id != '' && send_org_id != '0') {
            if (send_org_id == '2') {
                $('input[name=send_org_parent][value="2"]').prop('checked', true);
            } else {
                $('input[name=send_org_parent][value="1"]').prop('checked', true);
                $('#send_org_id option[value=' + send_org_id + ']').prop('selected', 'selected');
            }
        }else{
            $('#send_org_id option[value=""]').prop('selected', 'selected');
        }

        if(dataSend.current_status_id == '3'){
            if(!$('#send_status').prop('checked')) {
                $("#send_status").prop("checked", true);
            }
        }else{
            if($('#send_status').prop('checked')) {
                $("#send_status").prop("checked", false);
            }
        }
    });
}

function bt_delete(id) {
    var base_url = $('#base_url').attr('class');
    swal({
            title: "คุณต้องการจะลบข้อมูลหรือไม่?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่, ต้องการจะลบข้อมูล!",
            cancelButtonText: "ไม่",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                type: 'DELETE', //GET, POST, PUT
                url: base_url+'api/complaint/key_in/'+id, //the url to call
                async:false,
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
                            window.location.href=base_url+'complaint/dashboard';
                        }
                    });

            }).fail(function (err) {
                swal("ลบข้อมูลไม่สำเร็จ", "", "error");
            });
        });
}

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

var file_count = 0;
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
                var file_show = '<span id="show_file_'+id+'">'+txt+'<input type="button" class="btn btn-danger" value="ลบ" onclick="delete_new_file(\''+id+'\')"></span><hr>';
            }
        }
    }

    $('#checkFile').append(file_show);
    //document.getElementById("checkFile").innerHTML = txt;
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
    $('#example1 tbody>tr').on('click', 'td.open', function () {
        var id = table.row( this ).id();
        var href = base_url+'complaint/view_detail/'+id;
        window.location.href = href;
    } );
} );

