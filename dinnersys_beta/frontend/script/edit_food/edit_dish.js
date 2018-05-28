$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) return null;
    else return decodeURI(results[1]);
}

var ingres;

function make_item(value) {
    var data = '<tr><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td><td><hr style="width:100%"/></td></tr>' +
        '<tr><td>' + value['dish_id'] + '</td><td id="' + value['dish_id'] + '_name">' + value['dish_name'] + '</td><td id="' + value['dish_id'] +'_chargesum">' + value['dish_cost'] + '$.</td>' +
        '<td><input name="' + value['dish_id'] + '" type="checkbox" ' +
        (value['is_idle'] == "1" ? 'checked="checked"' : "") + '/>是否閒置</td>';
    data += get_ingres(value);
    return data + '<td><button name="submit" id="' + value['dish_id'] + '">確認更改</button></td></tr>';
    
}

function get_ingres(dish_value) {
    var data = "";
    for(var i = 0;i != 10;i++) {
        var item = '<td><select id="' + dish_value['dish_id'] + '_' + i + '_menu">';
        for(var key in ingres) {
            var menu_value = ingres[key];
            
            if(dish_value['ingre'][i] == menu_value['dish_id'])
                option = '<option selected="selected" value="' + menu_value['dish_id'] + '">' + menu_value['dish_name'] + '(' + menu_value['dish_cost'] + '$.)</option>';
            else
                option = '<option value="' + menu_value['dish_id'] + '">' + menu_value['dish_name'] + '(' + menu_value['dish_cost'] + '$.)</option>';
            
            item += option;  
        }
        item += "</select></td>";
        
        data += item;
    }
    return data;
}

var dish_array = [];
var menu_array;
var label_string = "<tr><th>餐點編號</th><th>餐點名稱</th><th>餐點總價</th><th>是否顯示</th><th>原料 1</th><th>原料 2</th><th>原料 3</th><th>原料 4</th><th>原料 5</th><th>原料 6</th><th>原料 7</th><th>原料 8</th><th>原料 9</th><th>原料 10</th><td>確認更改</td></tr>";

function update() {
    var dish_url = "../../backend/backend.php?cmd=show_dish&is_custom=false";
    var menu_url = "../../backend/backend.php?cmd=show_menu";
    var factory = $.urlParam("factory");
    if(factory != null) {
        dish_url += "&factory_id=" + factory;
        menu_url += "&factory_id=" + factory;
    }
    
    $("#data").empty();
    $("#data").append(label_string);
    
    $.get(menu_url ,function(data){
        ingres = JSON.parse(data);
        for(var key in ingres) {
            if(ingres[key]['is_idle'] == "true")
                delete ingres[key];
        }
        ingres.push({"dish_id" : "-1" ,"dish_name" : "(無)" ,"dish_cost" : "0"});
        menu_array = ingres;
    }).done(function(){
    $.get(dish_url ,function(data){
        var json = JSON.parse(data);
        for(var key in json) {
            var value = json[key];
            
            var tmp_ingre = new Object();
            for(var key2 in value['ingre']) {
                tmp_ingre[key2] = value['ingre'][key2][key2];       //"ingre" : [{"0":"1"},{"1":""},{"2":""}]
                if(tmp_ingre[key2] == "") tmp_ingre[key2] = "-1";
            }
            value['ingre'] = tmp_ingre;
            
            $("#data").append(make_item(value));
            
            dish_array.push(value);
        } 
    }).done(function(){
        $("button[name='submit']").click(function(){
            update_server_dish($(this).attr('id'));
            update();
        });    
    })});
}


function update_server_dish(id) {
    var data = [];
    var is_idle = $("input[name='" + id + "'").is(':checked');
    for(var i = 0;i != 10;i++) {
        var value = $("#" + id + '_' + i + '_menu').val();
        if(value != "-1") data.push(value);
    }
    
    var base_url = "../../backend/backend.php?cmd=update_dish&id=" + id + "&is_idle=" + is_idle;
    for(var key in data) {
        base_url += "&ingres[]=" + data[key];
    }
    
    $.get(base_url ,function(data){
        if(data != "Successfully updated food.")
            alert("更改菜單失敗");
    });
}

$(document).ready(function(){
    update();
});