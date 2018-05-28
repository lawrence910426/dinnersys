function get_string(array) {
    var str = ""; var tmp = new Object();
    for(var key in array) {
        if(tmp[array[key]] == undefined) tmp[array[key]] = 1;
        else tmp[array[key]] += 1;
    } 
    
    for(var key in tmp) {
        var short_name = key;
        var numberize = parseInt(key);
        if(!isNaN(numberize)) short_name = (numberize % 100).toString();
        
        if(tmp[key] == 1) str += (short_name + '.');
        else str += (short_name + '(' + tmp[key] + ').');
    }
    return str;
}

function make_dish(value ,show_person) {
    var data = ""; 
    if(show_person) {
        var all = get_string(value['all_user']);
        data += '<div class="info"><div class="index"><label>' +
            value['dish_name'] + ' (' + value['dish_cost'] + '$.)' + '</label></div><div class="value clickable" id="' + value['dish_id'] + '">' +
            '<label>' + value['order_count'] + '份</label></div></div>';
        if(all != "") {
            data += '<div class="person_bar"><label>全部: ' + all +
                '<br />未付: ' + get_string(value['dm_unpaid']) + '</label></div>';
        }
        data += "<hr />";
    } else {
        data = '<div class="info"><div class="index"><label>' +
            value['dish_name'] + ' (' + value['dish_cost'] + '$.)' + '</label></div><div class="value clickable" id="' + value['dish_id'] + '">' +
            '<label>' + value['order_count'] + '份</label></div></div> <hr />';
    }
    return data;
}

function show_custom_dish(value ,show_person) {
    var data = ""; 
    if(show_person) {
        var all = get_string(value['all_user']);
        data += '<div class="info"><div class="index"><label>' +
            '自訂套餐' + '</label></div><div id="custom" class="value clickable">' +
            '<label> ' + value['order_count'] + '份' + '</label></div></div>';
        if(all != "") {
            data += '<div class="person_bar"><label>全部: ' + all +
                '<br />未付: ' + get_string(value['dm_unpaid']) + '</label></div>';
        }
        data += "<hr />";
    } else {
        data = '<div class="info"><div class="index"><label>' +
            '自訂套餐' + '</label></div><div id="custom" class="value clickable">' +
            '<label>' + value['order_count'] + '份' + '</label></div></div>';
    }
    return data;
}

function make_factory(id ,name ,start ,end ,prepare){
    var data = '<div class="title"><div class="inner-title"><label>' + name + '</label>' +
        '</div></div><hr class="special"/>'
    return data;
}

function make_data(factory_array)
{
    $("#money_sum").text(factory_array['charge_sum'] + '$.');
    $("#order_sum").text(factory_array['order_count'] + '份.');
    for(var key in factory_array['data']) {
        var facto = factory_array['data'][key];

        var begin = facto['factory']['begin'];          begin = begin.split(":")[0];
        var end = facto['factory']['end'];              end = end.split(":")[0];
        var prepare = facto['factory']['prepare'];      prepare = prepare.split(":")[1];
        

        if(facto['factory']['id'] === "4") {
            $("#data").append(make_factory(4 ,"關東煮" ,begin ,end ,prepare));
            $("#data").append(show_custom_dish(facto ,$.urlParam("criteria") == "class"));
            $("#custom").click(function(){
                if($(this).text() == "0份") return;
                window.location = 'order_detail.php?dish_id=' + $(this).attr('id');
            });
        } else {    
            var fid = facto['factory']['id'];
            var fname = facto['factory']['name'];
            $("#data").append(make_factory(fid ,fname ,begin ,end ,prepare));
            
            for(var dish_key in facto['dish']) {
                var dish = facto['dish'][dish_key];
                $("#data").append(make_dish(dish ,$.urlParam("criteria") == "class"));
                $("#" + dish['dish_id']).click(function(){
                    if($(this).text() == "0份") return;
                    window.location = 'order_detail.php?dish_id=' + $(this).attr('id');
                });
            }
        }
    }
}
