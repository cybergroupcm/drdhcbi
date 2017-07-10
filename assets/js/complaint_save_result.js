var base_url = $('#base_url').attr('class');
$(document).ready(function () {
    $("#btSaveResult").click(function () {
        var method = 'POST';
        var jwt = Cookies.get("api_token");
        var keyin_id = $('#keyin_id_result').val();
        var result_detail = $('#result_detail').val();
        //var result_date = $('#result_date').val();
        var arr_result_date = $('#result_date').val().split('/');
        var result_date = (arr_result_date[2]-543)+'-'+arr_result_date[1]+'-'+arr_result_date[0];
        current_status_id = '4';
        update_status(keyin_id,current_status_id);
        add_result(keyin_id,result_detail,result_date);
        result_attach_file(keyin_id);
    });
});

//บันทึกสถานะ
function update_status(keyin_id,current_status_id){
    $.ajax({
        type: 'PUT', //GET, POST, PUT
        url: 'http://localhost/drdhcbi/api/complaint/key_in/'+keyin_id,  //the url to call
        data: { keyin_id: keyin_id ,current_status_id:current_status_id },     //Data sent to server
        //contentType: 'application/json',
        beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        }
    }).done(function (response) {
        alert(response);
        //Response ok. process reuslt
    }).fail(function (err) {
        alert(err);
        //Error during request
    });
}

function add_result(keyin_id,result_detail,result_date){
    $.ajax({
        type: 'PUT', //GET, POST, PUT
        url: 'http://localhost/drdhcbi/api/complaint/result/',  //the url to call
        data: { keyin_id: keyin_id , result_detail: result_detail , result_date: result_date},     //Data sent to server
        //contentType: 'application/json',
        beforeSend: function (xhr) {   //Include the bearer token in header
            xhr.setRequestHeader("Authorization", 'Bearer ' + jwt);
        }
    }).done(function (response) {
        alert(response);
        //Response ok. process reuslt
    }).fail(function (err) {
        alert(err);
        //Error during request
    });
}

//แนบไฟล์
function result_attach_file(keyin_id){
    var data = new FormData($("#form_save_result")[0]);
    $.ajax({
        method: "POST",
        url: base_url +"api/complaint/resule_file_attach/",
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (response) {
        alert(response);
        //Response ok. process reuslt
    }).fail(function (err) {
        alert(err);
        //Error during request
    });
}