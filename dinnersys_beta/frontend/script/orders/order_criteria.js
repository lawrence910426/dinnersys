var data = [];
var status = 1;

$(document).ready(function(){
    $.getJSON("../../backend/backend.php?cmd=show_factory" ,function(json) {
        $.each(json ,function(index, value){
            var ui_obj = '<hr /><div class="info"><div class="index" style="width:60%;"><label>' + value['name'] + 
                '<label></div><div class="value" style="width:30%;"><label style="margin-right:5px;"><input type="radio" name="factory" value="' + value['id'] +
                '" /> 選擇 </label></div></div>';
            $("#factories").append(ui_obj);
        });
    }).done(function(){
    $.getJSON("../../backend/backend.php?cmd=get_datetime", function(json) {
        $.each(json ,function(index ,value){
            var key = Object.keys(value)[0];
            data[key] = value[key];
        });
    });});
    
    $("#folder").click(function(){
        if(status == 0) {
            $("#content").css("display" ,"none");
            parent.folder_criteria(status);
            status = 1;
        } else {
            $("#content").css("display" ,"block");
            parent.folder_criteria(status);
            status = 0;
        }
    });
});

function get_criteria() {
    
    var lower_bound;
    var upper_bound;
    
    var dm;
    var cafet;
    var facto;
    
    var factory;
    
    switch($("input[name='time_criteria']:checked").val()) {
        case 'today':
            lower_bound = moment().format("YYYY/MM/DD") + '-00:00:00';
            upper_bound = moment().format("YYYY/MM/DD") + '-23:59:59';
        break;
        case 'week':
            lower_bound = data['Monday'];
            upper_bound = data['Sunday'].split('-')[0] + '-23:59:59';
        break;
        case 'all':
            lower_bound = upper_bound = undefined;
        break; 
    }
    
    switch($("input[name='dm_paid']:checked").val()) {
        case 'paid': dm = 'true'; break;
        case 'unpaid': dm = 'false'; break;
        case 'all': dm = undefined; break;
    }
    
    switch($("input[name='cafet_paid']:checked").val()) {
        case 'paid': cafet = 'true'; break;
        case 'unpaid': cafet = 'false'; break;
        case 'all': cafet = undefined; break;
    }
    
    switch($("input[name='facto_paid']:checked").val()) {
        case 'paid': facto = 'true'; break;
        case 'unpaid': facto = 'false'; break;
        case 'all': facto = undefined; break;
    }
    
    factory = ($("input[name='factory']:checked").val() === 'all' ? undefined : $("input[name='factory']:checked").val());
    
    var result = (lower_bound === undefined ? '' : '&esti_start=' + lower_bound) + 
        (upper_bound === undefined ? '' : '&esti_end=' + upper_bound) + 
        
        (dm === undefined ? '' : '&dm=' + dm) + 
        (cafet === undefined ? '' : '&cafet=' + cafet) + 
        (facto === undefined ? '' : '&facto=' + facto) + 
        
        (factory === undefined ? '' : '&factory_id=' + factory);
    
    return result;
}