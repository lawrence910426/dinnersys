var last_criteria = '';
var adapt = 
{   
    '&class=true' : '' ,
    '&person=true' : '' ,
    
    'cmd=' : '命令約束: ' ,
    '&cafet=' : '合作社付款: ' ,
    '&facto=' : '廠商付款: ' ,
    '&dm=' : '代訂付款: ' ,
    'select_self' : '選取自己 <br>',
    'select_class' : '選取本班 <br>',
    'select_other' : '選取全校 <br>',
    'true' : '已付 <br>' ,
    'false' : '未付 <br>' ,
    '&esti_start=' : '時間上界: ' ,
    '&esti_end=' : '時間下界: '
};
var grade_adapt = {'1' : '高一' , '2' : '高二' ,  '3' : '高三'};

function make_show_criteria(criteria) {
    var show_criteria = criteria.split('?')[1];
        
    show_criteria = show_criteria.replace(/-[0-9]{2}:[0-9]{2}:[0-9]{2}/g ,'<br>');
    
    var uid = show_criteria.match(/&uid=[0-9]{1,}/); 
    if(uid != null) uid = uid.toString().replace("&uid=" ,'');        
    show_criteria = show_criteria.replace(/&uid=[0-9]{1,}/ ,'使用者編號: ' + uid + '<br>');
    
    var cid = show_criteria.match(/&class_no=[0-9]{1,}/); 
    if(cid != null) cid = cid.toString().replace("&class_no=" ,'');
    show_criteria = show_criteria.replace(/&class_no=[0-9]{1,}/ ,'班級編號: ' + cid + '<br>');                
    
    var fid = show_criteria.match(/&factory_id=[0-9]/); 
    if(fid != null) fid = fid.toString().replace("&factory_id=" ,'');
    show_criteria = show_criteria.replace(/&factory_id=[0-9]/ ,'廠商編號: ' + fid + '<br>');    
    
    var grade = show_criteria.match(/&grade=[0-9]/); 
    if(grade != null) grade = grade.toString().replace("&grade=" ,'');
    show_criteria = show_criteria.replace(/&grade=[0-9]/ ,'年級: ' + grade_adapt[grade] + '<br>');    
    
    for(var index in adapt) 
        show_criteria = show_criteria.split(index).join(adapt[index]);
        
    return show_criteria;
}

function update(){
    var criteria = "../../backend/backend.php?cmd=select_self";
    
    switch($.urlParam("criteria")) {
        case "self":
            criteria = "../../backend/backend.php?cmd=select_self";
            $("#order_criteria").css("display" ,"block");
            $("#extended_criteria").css("display" ,"none");
            break;
        case "class":
            criteria = "../../backend/backend.php?cmd=select_class";
            $("#order_criteria").css("display" ,"block");
            $("#extended_criteria").css("display" ,"none");
            break;
        case "whole":
            criteria = "../../backend/backend.php?cmd=select_other";
            $("#order_criteria").css("display" ,"block");
            $("#extended_criteria").css("display" ,"blcok");
            break;
    }
    
    criteria += $('#order_criteria')[0].contentWindow.get_criteria() +
        $('#extended_criteria')[0].contentWindow.get_criteria();
        
    if(last_criteria != criteria) {
        $("#data").empty();
        categorize_dish(make_data ,criteria);
        last_criteria = criteria; 
        
        $("#show_criteria").empty();
        $("#show_criteria").append(make_show_criteria(criteria));
    }
    
    setTimeout(update, 1000);
}