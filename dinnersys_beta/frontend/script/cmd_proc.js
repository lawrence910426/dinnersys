var id_fid_adapt = {"-8" :"2" ,
    "-7" :"4" ,
    "-6" :"1" ,
    "-5" :"3"
};


$(document).ready(function(){
    var now = Math.floor(Date.now() / 1000);
    if(now - window.localStorage.login_date > 3600) {
        window.localStorage.clear();
        window.location.replace('login.php');
    }
    
    var json = $.parseJSON(window.localStorage.login_data);
    var fid = id_fid_adapt[json['id']];
    
    var opers = [];
    $.each(json['valid_oper'], function(index ,value) {
        var tmp = Object.keys(value)[0];
        opers[tmp] = true;
    });
    
    if(opers['make_order'] && opers['show_menu'] && opers['show_dish'] 
        && opers['get_custom_dish_id'] && opers['select_self'] )
        $('#get_menu').css('display' ,'block');   
    
    if(opers['select_self'] && opers['show_menu'] && opers['show_dish']
        && opers['delete_order'] && opers['check_recv'])
        $('#get_self_order').css('display' ,'block');
    
    
    if(opers['select_class'] && opers['show_menu'] && opers['show_dish']
        && opers['payment_dm'])
        $('#get_class_order').css('display' ,'block');
    
    if(opers['select_other'] && opers['show_menu'] && opers['show_dish']
        && (opers['payment_cafet'] || opers['payment_cafet']))
        $('#get_selected_order').css('display' ,'block');
        
        
    if(opers['show_menu'] && opers['update_menu'])
        $('#update_ingre').css('display' ,'block');
        
    if(opers['show_dish'] && opers['update_dish'])
        $('#update_menu').css('display' ,'block');
        
    
    if(opers['change_password'])
        $('#change_pswd').css('display' ,'block');
        
    if(opers['register'])
        $('#new_account').css('display' ,'block');
        
    if(opers['logout'])
        $('#logout').css('display' ,'block');
    
    $("#update_ingre").click(function(){
        window.location = "pages/edit_menu.php" + (fid == null ? "" : "?factory=" + fid); 
    });
    $("#update_menu").click(function(){
        window.location = "./pages/edit_dish.php" + (fid == null ? "" : "?factory=" + fid); 
    });
});

function logout()
{
	$.get( "../backend/backend.php?cmd=logout", function( data ) {
	    window.localStorage.clear();
		window.location = "login.php";
	});
}