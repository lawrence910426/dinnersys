
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>板橋高中午餐系統</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/animate.css" rel="stylesheet">
		<link href="../css/login_theme.css" rel="stylesheet">
		<link href="../css/theme.css" rel="stylesheet">			<!-- cover some part of login_theme.css -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../script/jquery-1.10.2.min.js"></script> 
		<script src="../script/bootstrap.min.js"></script>
        <script src="../script/register.js"></script>
	</head>

	<body>
		<div id="wrap">
		  <div id="header">
			<div class="container animated bounce">
				<h3> </h3>
			</div>
		  </div>
		  
		  <div class="content">
			<div class="row">
				<div class="col-md-12" id="content-body">
					<div class="inner-content animated bounceIn" style="background:#63d6ff">
						<div class="login-logo"> </div>
                        
						<div class="login-form">
                            <label style="color:black;font-size:30px;"> 請輸入你的資訊 </label> <br />
                            <label id="error_msg" style="color:red;font-size:30px;"></label>
                            <hr />
                            
							<input id="name" class="login-input1" type="text" placeholder="名字" />
                            
							<input id="phone_num" type="text" class="login-input1" placeholder="手機號碼 [09xx-xxx-xxx]" />
                            <div class="group-radio">
                                <form style="display:block;">
    								<label>
                                        <input name="gen" type="radio" value="MALE" /> 男生
                                    </label>
                                    <label>
                                        <input name="gen" type="radio" value="FEMALE" /> 女生
                                    </label>
                                    <label>
                                        <input name="gen" type="radio" value="OTHER" /> 其他
                                    </label>
                                </form>
							</div>
                            
                            
                            
                            <div class="group-radio" style="margin-top: 10px;">
                                <form style="display:block;">
    								<label>
                                        <input name="vege" type="radio" value="MEAT" /> 葷食
                                    </label>
                                    <label>
                                        <input name="vege" type="radio" value="VEGE" /> 蛋奶素
                                    </label>
                                    <label>
                                        <input name="vege" type="radio" value="PURE" /> 素食
                                    </label>
                                </form>
							</div>
                            
                            <input id="email" class="login-input1" type="email" placeholder="電子郵件" />
                            <input id="login_id" class="login-input1" type="text" placeholder="登入帳號" />
                            <input id="password" class="login-input1" type="password" placeholder="登入密碼" />
                            <input id="re_password" class="login-input1" type="password" placeholder="重新輸入密碼" />
							
						</div>
                        
                        <hr />
                        
						<div id="new_account" class="item" onclick="register();" style="display: block;"> 
							<div class="item-img-container">
								<img class="item-img" src="../images/arrow.png" align="center"/>
							</div>
							<div class="item-text-container">
								<p> 確認註冊 </p>
							</div>
						</div>
					</div>      
				</div>
			</div>
            
            <div style="height: 30px;"></div>
            <iframe id="order_criteria" src="../fragment/reverse_button.php" frameborder="0" scrolling="no" class="criteria" style="height:150px;"></iframe>
		  </div>
		</div>

	</body>
</html>