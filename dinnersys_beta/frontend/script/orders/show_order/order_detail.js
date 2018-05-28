$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) return null;
    else return decodeURI(results[1]);
}

var index = 0;
var did = $.urlParam("dish_id").toString();
var order_array;
if(did == 'custom') order_array = JSON.parse(window.localStorage.order_array)['custom'];
else order_array = JSON.parse(window.localStorage.order_array)['data'][did];

var status_adapt = {'false' : '未付款' ,'true' : '已付款'};
var paid_adapt = {'false' : '付款' ,'true' : '取消付款'};
var css_adapt = {'false' : 'unpaid' ,'true' : 'paid'};

var json = $.parseJSON(window.localStorage.login_data);
var opers = new Object(); 
$.each(json['valid_oper'], function(index ,value) {
    var tmp = Object.keys(value)[0];
    opers[tmp] = true;
});

function show_infor(new_index){
    if(!(0 <= new_index && new_index < order_array.length)) return;
    index = new_index;
    
    var order = order_array[index];
    if(index == 0) $("#previous_container").css("display" ,"none");
    else $("#previous_container").css("display" ,"block");
    if(index == order_array.length - 1) $("#next_container").css("display" ,"none");
    else $("#next_container").css("display" ,"block");
    if(order_array.length == 1) $("#jump_container").css("display" ,"none");
    else $("#jump_container").css("display" ,"block");
    
    $("#order_index").text("第 " + (index + 1) + " 筆訂單");
    $("#oid").text(order['id']);
    $("#esti_recv").text(order['recv_date'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    
    $("#delete").removeClass().addClass("value2");
    if(order['payment'][1]['paid'] === "true" || 
        order['payment'][2]['paid'] === "true" || 
        order['payment'][3]['paid'] === "true") {
        $("#inner_delete").text("*已經付款");
    } else {
        $("#delete").addClass("clickable");
        $("#inner_delete").text("刪除訂單");
        $("#delete").off('click').click(function(){
            delete_checkrecv("delete")   
        });
    }
    
    $("#check_recv").removeClass().addClass("value2");
    if(order['payment'][3]['paid'] === "true") {
        $("#check_recv").addClass("clickable");
        $("#inner_check_recv").text("確認取貨");
        $("#check_recv").off('click').click(function(){
            delete_checkrecv("check_recv")   
        });
    } else {
        $("#inner_check_recv").text("廠商未收錢");
    }
    
    $("#uid").text(order['user']['id']);
    $("#uname").text(order['user']['name']);
    $("#cid").text(order['user']['class_no']);
    
    $("#did").text(order['dish']['dish_id']);
    $("#dname").text(order['dish']['dish_name']);
    $("#dcost").text(order['dish']['dish_cost'] + '$.');
    $("#factory").text(order['dish']['factory']['name']);
    
    $("#dm_status").text(status_adapt[order['payment'][1]['paid']]);
    $("#dm_status").parent().removeClass().addClass("value2").addClass(css_adapt[order['payment'][1]['paid']]);
    $("#dm_lower_bound").text(order['payment'][1]['able_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    $("#dm_upper_bound").text(order['payment'][1]['freeze_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    if(order['payment'][1]['paid_dt'] === "") $("#dm_paid_time").text("尚未付款");
    else $("#dm_paid_time").text(order['payment'][1]['paid_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    $("#dm_charge").text(order['payment'][1]['charge'] + "$.");
    if(opers['payment_dm']) {
        $("#container_dm_payment").css("display" ,"block");
        if(moment().isBetween(order['payment'][1]['able_dt'] ,order['payment'][1]['freeze_dt'])) {
            $("#dm_payment").removeClass().addClass("value2").addClass("clickable");
            $("#inner_dm_payment").text(paid_adapt[order['payment'][1]['paid']]);
            $("#dm_payment").off('click').click(function(){
                do_payment($(this).attr('id') ,order['payment'][1]['paid']);
            });
        } else {
            $("#inner_dm_payment").text("*時效已過");
            $("#dm_payment").removeClass().addClass("value2");
            $("#dm_payment").off('click');
        }
    } else {
        $("#container_dm_payment").css("display" ,"none");
    }
    
    $("#cafet_status").text(status_adapt[order['payment'][2]['paid']]);
    $("#cafet_status").parent().removeClass().addClass("value2").addClass(css_adapt[order['payment'][2]['paid']]);
    $("#cafet_lower_bound").text(order['payment'][2]['able_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    $("#cafet_upper_bound").text(order['payment'][2]['freeze_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    if(order['payment'][2]['paid_dt'] === "") $("#cafet_paid_time").text("尚未付款");
    else $("#cafet_paid_time").text(order['payment'][2]['paid_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    $("#cafet_charge").text(order['payment'][2]['charge'] + "$.");
    if(opers['payment_cafet']) {
        $("#container_cafet_payment").css("display" ,"block");
        if(moment().isBetween(order['payment'][2]['able_dt'] ,order['payment'][2]['freeze_dt'])) {
            $("#cafet_payment").removeClass().addClass("value2").addClass("clickable");
            $("#inner_cafet_payment").text(paid_adapt[order['payment'][2]['paid']]);
            $("#cafet_payment").off('click').click(function(){
                do_payment($(this).attr('id') ,order['payment'][2]['paid']);
            });
        } else {
            $("#inner_cafet_payment").text("*時效已過");
            $("#cafet_payment").removeClass().addClass("value2");
            $("#cafet_payment").off('click');
        }
    } else {
        $("#container_cafet_payment").css("display" ,"none");
    }
    
    $("#facto_status").text(status_adapt[order['payment'][3]['paid']]);
    $("#facto_status").parent().removeClass().addClass("value2").addClass(css_adapt[order['payment'][3]['paid']]);
    $("#facto_lower_bound").text(order['payment'][3]['able_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    $("#facto_upper_bound").text(order['payment'][3]['freeze_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    if(order['payment'][3]['paid_dt'] === "") $("#facto_paid_time").text("尚未付款");
    else $("#facto_paid_time").text(order['payment'][3]['paid_dt'].match(/[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/));
    $("#facto_charge").text(order['payment'][3]['charge'] + "$.");
    if(opers['payment_facto']) {
        $("#container_facto_payment").css("display" ,"block");
        if(moment().isBetween(order['payment'][3]['able_dt'] ,order['payment'][3]['freeze_dt'])) {
            $("#facto_payment").removeClass().addClass("value2").addClass("clickable");
            $("#inner_facto_payment").text(paid_adapt[order['payment'][3]['paid']]);
            $("#facto_payment").off('click').click(function(){
                do_payment($(this).attr('id') ,order['payment'][3]['paid']);
            });
        } else {
            $("#inner_facto_payment").text("*時效已過");
            $("#facto_payment").removeClass().addClass("value2");
            $("#facto_payment").off('click');
        }
    } else {
        $("#container_facto_payment").css("display" ,"none");
    }
}

function delete_checkrecv(type) {
    var url = "";
    var failure_msg = "";
    var success_code = "";
    
    if(type == "check_recv") {
        url = "../../backend/backend.php?cmd=check_recv&order_id=" + order_array[index]['id'];
        failure_msg = "無法確認取款";
        success_code = "Successfully checked receive.";
    }
    if(type == "delete") {
        url = "../../backend/backend.php?cmd=delete_order&order_id=" + order_array[index]['id'];
        failure_msg = "無法刪除點單";
        success_code = "Succesfully deleted order.";
    } 
    
    $.get(url, function(data){
        if(data == success_code) {
            order_array.splice(index ,1);
            if(order_array.length == 0) {
                window.history.back();
            } else {
                if(index == order_array.length) show_infor(index - 1);
                else show_infor(index);
            }
        } else {
            $("#msg_container").css("display" ,"block");
            $("#msg").text(failure_msg);
        }
    });
}

function do_payment(type ,target) {
    var url = "";
    var failure_msg = "";
    var success_code = "Successfully set payment.";
    var not_target = (target == "true" ? "false" : "true");
    var adapt = {"dm_payment" : 1 ,"cafet_payment" : 2 ,"facto_payment" : 3};
    
    if(type == "dm_payment") {
        url = "../../backend/backend.php?cmd=payment_dm&order_id=" + order_array[index]['id'] + "&target=" + not_target;
        failure_msg = "無法設定代訂的付款狀態";
    }
    if(type == "cafet_payment") {
        url = "../../backend/backend.php?cmd=payment_cafet&order_id=" + order_array[index]['id'] + "&target=" + not_target;
        failure_msg = "無法設定合作社的付款狀態";
    }
    if(type == "facto_payment") {
        url = "../../backend/backend.php?cmd=payment_facto&order_id=" + order_array[index]['id'] + "&target=" + not_target;
        failure_msg = "無法設定廠商的付款狀態";
    }
    
    $.get(url, function(data){
        if(data == success_code) {
            order_array[index]['payment'][adapt[type]]['paid'] = not_target;
            order_array[index]['payment'][adapt[type]]['paid_dt'] = (not_target == "true" ? moment().format("MM-DD HH:mm") : "");
            show_infor(index);
        } else {
            $("#msg_container").css("display" ,"block");
            $("#msg").text(failure_msg);
        }
    });
}


$(document).ready(function(){
    show_infor(0);
    $("#previous").click(function(){
        show_infor(index - 1);
    });
    $("#next").click(function(){
        show_infor(index + 1);
    });
    $("#jump").on('keypress', function(e) {
        if (e.which != 13) return;
        e.preventDefault();
        var tmp = parseInt($("#jump").val()); 
        if(isNaN(tmp)) return;
        show_infor(tmp - 1);
    });
});