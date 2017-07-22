$(document).ready(function() {
    var table = $('#usertable').DataTable({
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "targets": [-1,4], "orderable": false },
            { "targets": [-1,4],"searchable": false }
        ],
        "language": {
            "search": "ค้นหา:",
            "info": "รายการที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
            "infoEmpty":"Showing 0 to 0 of 0 entries",
            "zeroRecords":"ไม่พบรายการที่ค้นหา",
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
});