function get_criteria() {
    var uid = $("#uid").val();
    var cid = $("#cid").val();
    var grade = $("input[name='grade']:checked").val();
    var user_class = $("input[name='focus']:checked").val();
    
    return (uid === '' ? '' : '&uid=' + uid) + 
        (cid === '' ? '' : '&class_no=' + cid) + 
        (grade === 'all' ? '' : '&grade=' + grade) + 
        (uid == "" ? "" : 
            (user_class === 'person' ? '&person=true' : '&class=true'));
}

var status = 1;
$(document).ready(function(){
    $("#folder").click(function(){
        if(status == 0) {
            $("#content").css("display" ,"none");
            parent.folder_extend(status);
            status = 1;
        } else {
            $("#content").css("display" ,"block");
            parent.folder_extend(status);
            status = 0;
        }
    });
});