$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) return null;
    else return decodeURI(results[1]);
}

$(document).ready(function(){
    var both_finish = 0;
    document.getElementById("order_criteria").onload = function(){
        if(++both_finish == 2) update();
        $("#order_criteria")[0].contentWindow.status;
    };
    document.getElementById("extended_criteria").onload = function(){
        if(++both_finish == 2) update();
    };
    
    var json = $.parseJSON(window.localStorage.login_data);
    
    var opers = [];
    $.each(json['valid_oper'], function(index ,value) {
        var tmp = Object.keys(value)[0];
        opers[tmp] = true;
    });
    
    if(opers['payment_dm']) {
      $("#container_dm_payment").css('display' ,'block');  
      $("#container_dm_payment").click(function(){
            do_all_payment($(this).attr('id'));
      });
    } 
    if(opers['payment_cafet']) {
        $("#container_cafet_payment").css('display' ,'block');
        $("#container_cafet_payment").click(function(){
            do_all_payment($(this).attr('id'));
      });
    }
    if(opers['payment_facto']) {
        $("#container_facto_payment").css('display' ,'block');
        $("#container_facto_payment").click(function(){
            do_all_payment($(this).attr('id'));
      }); 
    }
});

function do_all_payment(type) {
    if(confirm(' 你確定要將頁面中所有的點單設為已付嗎?\n 確認後將無法回復。')) {
        var base_url = "";
        switch(type) {
            case "container_dm_payment":
                base_url = "../../backend/backend.php?cmd=payment_dm&target=true&order_id=";
                break;
            case "container_cafet_payment":
                base_url = "../../backend/backend.php?cmd=payment_cafet&target=true&order_id=";
                break;
            case "container_facto_payment":
                base_url = "../../backend/backend.php?cmd=payment_facto&target=true&order_id=";
                break;
        }
        
        var raw_array = JSON.parse(window.localStorage.raw_array);
        for(var key in raw_array) {
            $.get(base_url + raw_array[key]['id'], function(data){  });     //we don't give a fuck about what backend returns. just fucking do it.
        }
    } 
}

function folder_criteria(status) {
    $("#order_criteria").removeAttr("style").
        css("height" ,(status == 0 ? "150px" : "1000px"));
}

function folder_extend(status) {
    $("#extended_criteria").removeAttr("style").
        css("height" ,(status == 0 ? "150px" : "600px"));
}

