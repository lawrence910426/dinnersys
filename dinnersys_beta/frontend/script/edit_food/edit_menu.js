$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) return null;
    else return decodeURI(results[1]);
}

function make_item(value){
    var data = '<tr><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td></tr>' + 
        '<tr><td>' + value['dish_id'] + '</td><td>' + value['factory']['name'] + '</td><td><input name="' + value['dish_id'] + '_name" type="text" value="' + value['dish_name']  + 
        '" /></td><td><input name="' + value['dish_id'] + '_cost" type="text" value="' + value['dish_cost'] + '" /></td>' +
        '<td><input name="' + value['dish_id'] + '_dishable" type="checkbox" ' + (value['dish_able'] == "true" ? 'checked="checked"' : "") + '>可為餐點</td>' +
        '<td><input name="' + value['dish_id'] + '_ingreable" type="checkbox" ' + (value['ingre_able'] == "true" ? 'checked="checked"' : "") + '>可為原料</td>' +
        '<td><input name="' + value['dish_id'] + '_idle" type="checkbox" ' + (value['is_idle'] == "true" ? 'checked="checked"' : "") + '>暫不供應</td>' +
        '<td><button id="' + value['dish_id'] + '_submit">確認更改</button></td></tr>';
    return data;
}

function update(){
    var url = "../../backend/backend.php?cmd=show_menu";
    var factory = $.urlParam('factory');
    if(factory != null) url += "&factory_id=" + factory;
    
    $.get(url ,function(data){
        var json = JSON.parse(data);;
        for(var key in json) {
            $("#data").append(make_item(json[key]));
            $("#" + json[key]['dish_id'] + "_submit").click(function(){
                var id = $(this).attr('id').split('_')[0];
                
                var dname = $("input[name='" + id + "_name'").val();
                var cost = $("input[name='" + id + "_cost'").val();
                
                var vege = $("input[name='" + id + "_vegetable'").is(':checked');
                var dishable = $("input[name='" + id + "_dishable'").is(':checked');
                var ingreable = $("input[name='" + id + "_ingreable'").is(':checked');
                var idle = $("input[name='" + id + "_idle'").is(':checked');
                
                var update_url = "../../backend/backend.php?cmd=update_menu&id=" + id +
                    "&name=" + dname + 
                    "&charge=" + cost +
                    "&vege=" + (vege ? "PURE" : "MEAT") +
                    "&dish_able=" + dishable + 
                    "&ingre_able=" + ingreable +
                    "&idle=" + idle; 
                
                $.get(update_url ,function(data){
                    if(data != "Successfully updated food.") 
                        alert(" 無法更新原料\n" + data);
                    update();
                })
            });
        } 
    });
}
$(document).ready(function(){
    update();
});