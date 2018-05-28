function login()
{
    var uid = $("#id").val();
    var pswd = $("#password").val();
    $.get("../backend/backend.php?cmd=login&id=" + uid + "&password=" + pswd + "&device_id=website", function( data ) {
        try {
            if (data.charCodeAt(0) === 0xFEFF) data = data.substr(1);
            var json = $.parseJSON(data); 
            window.localStorage.login_date = Math.floor(Date.now() / 1000);
            window.localStorage.login_data = data; 
            window.location = 'index.php';
        }
        catch(err) {
            $("#error_msg").text("錯誤的帳號密碼");
            $("#error_msg").removeClass("animated bounceIn")
            setTimeout(
                function(){ 
                    $("#error_msg").addClass("animated bounceIn")
                }
                ,30
            );
        }
    });
}