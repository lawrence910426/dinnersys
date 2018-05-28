function categorize_dish(ui_func ,url = "../../backend/backend.php?cmd=select_self") {
    var factory_array = new Object();
    var dish_array = new Object();
    var order_array = new Object();
    var raw_array = [];
    
    $( document ).ready(function(){
        $.get("../../backend/backend.php?cmd=show_dish", function( data ) {
            if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
            var json = $.parseJSON(data);
            factory_array['data'] = new Object();
            $.each(json, function(index ,value) {
                var id = value['dish_id'];
                var factory_id = value['factory']['id'];
                if(value['is_idle'] === '1') return;
                dish_array[id] = value;
                
                if(factory_array['data'][factory_id] == undefined) {
                    factory_array['data'][factory_id] = new Object();
                    factory_array['data'][factory_id]['dish'] = new Object();
                }
                
                factory_array['order_count'] = 0;
                factory_array['charge_sum'] = 0;
                factory_array['data'][factory_id]['order_count'] = 0;
                factory_array['data'][factory_id]['charge_sum'] = 0;
                factory_array['data'][factory_id]['dish'][id] = value;
                factory_array['data'][factory_id]['dish'][id]['order_count'] = 0;
                factory_array['data'][factory_id]['dish'][id]['charge_sum'] = 0;
                
                factory_array['data'][factory_id]['all_user'] = [];
                factory_array['data'][factory_id]['dm_unpaid'] = [];
                factory_array['data'][factory_id]['dm_paid'] = [];
                factory_array['data'][factory_id]['dish'][id]['all_user'] = [];
                factory_array['data'][factory_id]['dish'][id]['dm_unpaid'] = [];
                factory_array['data'][factory_id]['dish'][id]['dm_paid'] = [];
                
                if(order_array['data'] == undefined) order_array['data'] = new Object();
                order_array['data'][id] = [];
                order_array['custom'] = [];
            });
            window.localStorage.dish_data = JSON.stringify(dish_array);
        })
        
        .done(function(){
            $.get(url, function( data ) {
                if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
                var json = $.parseJSON(data);
                $.each(json, function(index ,value) {
                    var facto_id = value['dish']['factory']['id'];
                    var dish_id = value['dish']['dish_id'];
                    
                    factory_array['order_count'] += 1;
                    factory_array['charge_sum'] += parseInt(value['dish']['dish_cost']);
                    factory_array['data'][facto_id]['order_count'] += 1;
                    factory_array['data'][facto_id]['charge_sum'] += parseInt(value['dish']['dish_cost']);
                    factory_array['data'][facto_id]['dish'][dish_id]['order_count'] += 1;
                    factory_array['data'][facto_id]['dish'][dish_id]['charge_sum'] += parseInt(value['dish']['dish_cost']);
                    
                    factory_array['data'][facto_id]['all_user'].push(value['user']['name']);
                    factory_array['data'][facto_id]['dish'][dish_id]['all_user'].push(value['user']['name']);
                    if(value['payment'][1]['paid'] === 'true') {
                        factory_array['data'][facto_id]['dm_paid'].push(value['user']['name']);
                        factory_array['data'][facto_id]['dish'][dish_id]['dm_paid'].push(value['user']['name']);
                    } else {
                        factory_array['data'][facto_id]['dm_unpaid'].push(value['user']['name']);
                        factory_array['data'][facto_id]['dish'][dish_id]['dm_unpaid'].push(value['user']['name']);
                    }
                    
                    order_array['data'][dish_id].push(value);
                    if(facto_id == 4) order_array['custom'].push(value);
                    
                    raw_array.push(value);
                });
                window.localStorage.order_array = JSON.stringify(order_array);
                window.localStorage.raw_array = JSON.stringify(raw_array);
        
        }).done(function(){
            
            $.get("../../backend/backend.php?cmd=show_factory", function( data ) {
                if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
                var json = $.parseJSON(data);
                $.each(json, function(index ,value) {
                    var fid = value['id'];
                    factory_array['data'][fid]['factory'] = new Object();
                    factory_array['data'][fid]['factory']['id'] = fid;
                    factory_array['data'][fid]['factory']['name'] = value['name'];
                    factory_array['data'][fid]['factory']['begin'] = value['lower_bound'];
                    factory_array['data'][fid]['factory']['end'] = value['upper_bound'];
                    factory_array['data'][fid]['factory']['prepare'] = value['prepare_time'];
                });
        
        }).done(function(){
            window.localStorage.factory_array = JSON.stringify(factory_array);
            ui_func(factory_array);
        })})});
    });
}