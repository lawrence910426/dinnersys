function make_ingre(id ,name ,cost) {
    var data = '<div class="info"><div class="index"><label>' +
        name + ' ' + cost + '$.' + 
        '</label></div>' +
        '<div id="' + id + '" class="selectable"><label>加料</label></div></div><hr />';
    return data;
}

function init_menu() {
    $.get("../../backend/backend.php?cmd=show_menu&factory_id=4", function( data ) {
        if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
        $.cookie('menu_data', data);
        var json = $.parseJSON(data);
        json.forEach(function(value){
            var name = value['dish_name'];
            var price = value['dish_cost'];
            var id = value['dish_id'];
            menu_array[id] = value;
            $("#ingres").append(make_ingre(id ,name ,price));
        });
        
        $('.selectable').click( function(data) {
            var id = $(this).attr('id'); 
            var text = $(this).children('label').text();
            if(text == "已加料") {
                $(this).removeClass('selected');
                $(this).children('label').text("加料");
                price_sum -= parseInt(menu_array[id]['dish_cost']);
                menu_array[id]['selected'] = false;
            } else {
                $(this).addClass('selected');
                $(this).children('label').text("已加料");
                price_sum += parseInt(menu_array[id]['dish_cost']);
                menu_array[id]['selected'] = true;
            }
            $("#dish_cost").text(price_sum + '$.');
        });
    });
}


var price_sum = 0;
var menu_array = [];


$( document ).ready(function(){
    init();
    init_menu();
    $("#submit").click(function(){
        var criteria = "";
        menu_array.forEach(function(value){
            if(value['selected'] === true) 
                criteria += ("&id[]=" + value['dish_id']);
        });
        
        $.get("../../backend/backend.php?cmd=get_custom_dish_id" + criteria, function( data ) {
            if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
            var did = parseInt(data); 
            if(isNaN(did)){
                show_msg_anim();
                $("#msg").text("請先選取你想要的料");
            } else {
                make_order(did);
            }
        });
    });
});


