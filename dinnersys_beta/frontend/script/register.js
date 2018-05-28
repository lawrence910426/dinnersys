function register()
{
    var name = $("#name").val();
    var phone = $("#phone_num").val();
    var gender = $('input[name=gen]:checked').val();
    var vege = $('input[name=vege]:checked').val();
    var email = $("#email").val();
    var login_id = $("#login_id").val();
    var pswd = $("#password").val();
    var re_pswd = $("#re_password").val();
    
    if(pswd != re_pswd)
    {
        $("#error_msg").text("密碼不一樣");
        return;
    }
    
    var get_str = "?cmd=register&user_name=" + encodeURIComponent(name) +
        "&phone_number=" + phone + 
        "&gen=" + gender + 
        "&is_vege=" + vege + 
        "&email=" + email + 
        "&login_id=" + login_id + 
        "&password=" + pswd;
    
    $.get("../../backend/backend.php" + get_str, function( data ) {
        if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);

        if(data === 'Succesfully registered user.')
        {
            $("#error_msg").text("註冊成功");
            setTimeout(function(){ 
                window.location = '../login.php';
            },1000);
        }
        else if(data === 'repeated login id')
            $("#error_msg").text("帳號重複");
        else
            $("#error_msg").text("請確認格式");
            
        $("#error_msg").removeClass("animated bounceIn")
        setTimeout(function(){ 
            $("#error_msg").addClass("animated bounceIn")
        },30);
    });
}