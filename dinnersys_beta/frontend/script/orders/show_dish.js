function make_dish(id ,name ,cost ,count) {
    var data = '<div class="info"><div class="index2"><label>' +
        name + ' (' + count + ')' + '</label></div><div class="value2 clickable" id="' + id + '">' +
        '<label>' + cost + '$.</label></div></div> <hr />';
    return data;
}

function show_custom_dish(count) {
    var data = '<div class="info"><div class="index2"><label>' +
        '自訂套餐' + ' (' + count + ')' + '</label></div><div id="custom" class="value2 clickable">' +
        '<label>' + '點餐' + '</label></div></div> <hr />';
    return data;
}

function make_factory(id ,name ,start ,end ,prepare){
    var data = '<div class="title"><div class="inner-title"><label>' + name + '</label>' + 
        '<label style="font-size:15px;margin-top:15px;float:right;margin-right:10px;">(' + start + '->' + end + ')+' + prepare +
        '</label></div></div><hr class="special"/>'
    return data;
}

function make_data(factory_array)
{
    for(var key in factory_array['data']) {
        var facto = factory_array['data'][key];

        var begin = facto['factory']['begin'];          begin = begin.split(":")[0];
        var end = facto['factory']['end'];              end = end.split(":")[0];
        var prepare = facto['factory']['prepare'];      prepare = prepare.split(":")[1];
        

        if(facto['factory']['id'] === "4") {
            $("#data").append(make_factory(4 ,"關東煮" ,begin ,end ,prepare));
            $("#data").append(show_custom_dish(facto['order_count']));
        } else {    
            var fid = facto['factory']['id'];
            var fname = facto['factory']['name'];
            $("#data").append(make_factory(fid ,fname ,begin ,end ,prepare));
            
            for(var dish_key in facto['dish']) {
                var dish = facto['dish'][dish_key];
                $("#data").append(make_dish(dish['dish_id'] ,dish['dish_name'] ,dish['dish_cost'] ,dish['order_count']));
            }
        }
    }
        
    $(".clickable").click(function(data){
        var id = $(this).attr('id');
        if(id === 'custom') {
            window.location = 'make_custom_order.php?type=custom';
        } else {
            window.location = 'make_order.php?dish_id=' + id;
        }
    });
}

categorize_dish(make_data);