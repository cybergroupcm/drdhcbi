/**
 * Created by JetBrains PhpStorm.
 * User: Top
 * Date: 3/9/17 AD
 * Time: 3:27 PM
 * To change this template use File | Settings | File Templates.
 */
$(function () {

    $('#jstree_div').bind("loaded.jstree", function (event, data) {
            $(this).jstree("open_all");
           // console.log(data);
            setTimeout(function(){
                var user_org = $('#jsfields').val();
                if(user_org){
                    user_org = user_org.split(',');
                    user_org.forEach(function (value) {
                        $('#'+value+'_anchor').addClass(' jstree-clicked ');
                    });
                }
            }, 3000);
        })
        .jstree({
            "checkbox" : {
                "keep_selected_style" : false
            },
            "plugins" : [ "checkbox" ]
        });

});

function save(){
    var checked_ids = [];
    var checked_js = $('#jstree_div').jstree('get_checked',null,true);
    checked_js.forEach(function (value) {
        checked_ids.push(value);
    });

    document.getElementById('jsfields').value = checked_ids.join(",");
}

