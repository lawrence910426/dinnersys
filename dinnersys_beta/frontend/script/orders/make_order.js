$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) return null;
    else return decodeURI(results[1]);
}

function get_timestamp(yr ,mth ,day ,hr ,mi ,sec) {
    yr -= 1970;
    var fix = (yr - 2) / 4 - 1;
    var sum = yr * 365 * 24 * 60 * 60;
    sum += mth 
}

function init() {
    var user = $.parseJSON(window.localStorage.login_data);
    var uid = user['id'];
    var uname = user['name'];
    var class_no = user['class_no'];
    $("#user_id").text(uid);
    $("#user_name").text(uname);
    $("#class_no").text(class_no);
}

function show_msg_anim() {
    $("#msg_container").css('display' ,'block');
        $("#msg_container").removeClass("animated bounceIn")
        setTimeout(
            function(){ 
                $("#msg_container").addClass("animated bounceIn")
            },30
        );
}

function make_order(did) {
        var recv_time = $("#recv_time").val();
        var esti_recv = "";
        
        show_msg_anim();
        $.get("../../backend/backend.php?cmd=get_datetime", function( data ) {
            if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
            var json = $.parseJSON(data);
            var tmp = [];
            json.forEach(function(value){
                var key = Object.keys(value)[0];
                var content = value[key];
                tmp[key] = content;
            });
            
            var myDate = new Date();
            var infor = {
                day:    myDate.getDate(),
                month:  myDate.getMonth() + 1,
                year:   myDate.getFullYear().toString(),
            };
            infor['month'] = (infor['month'] < 10 ? '0' + infor['month'] : infor['month'].toString());
            infor['day'] = (infor['day'] < 10 ? '0' + infor['day'] : infor['day'].toString());
            
            esti_recv = infor['year'] + '/' + infor['month'] + '/' + infor['day'] + '-' +  recv_time + ':00';
        })
        
        .done(function(){
        $.get("../../backend/backend.php?cmd=make_order&dish_id=" + did + "&time=" + esti_recv , function( data ) {
            if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
            var result = parseInt(data);
            if(isNaN(result))
                $("#msg").text(data);
            else
                $("#msg").text("點餐編號: " + data);
        });});
}


$(document).ready(function(){
    var dish_array = $.parseJSON(window.localStorage.dish_data);
    
    if($.urlParam('type') != 'custom') {
        var id = $.urlParam('dish_id');

        var dish = dish_array[id];
        
        var did = id;
        var dname = dish['dish_name'];
        var dcost = dish['dish_cost'];
        
        var fid = dish['factory']['id'];
        var fname = dish['factory']['name'];
        
        $("#dish_id").text(did);
        $("#dish_name").text(dname);
        $("#dish_cost").text(dcost);
        
        $("#factory_id").text(fid);
        $("#factory_name").text(fname);
        
        if(fid == 2) $("#recv_time").val("08:00");
        
        $("#submit").click(function(){
           make_order(did);
        });
    }
    init();
});

