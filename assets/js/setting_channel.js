$( document ).ready(function() {

});

function bt_delete(id) {
    swal({title: "คุณต้องการจะลบข้อมูลหรือไม่?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่, ต้องการจะลบข้อมูล!",
            cancelButtonText: "ไม่",
            closeOnConfirm: false},
        function () {
            var  link = $('#base_url').attr("class")+"setting_channel/dashboard";
            window.location = link;
        });
}


