
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>板橋高中午餐系統</title>
		<!-- Bootstrap -->
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/animate.css" rel="stylesheet">
		<link href="./css/login_theme.css" rel="stylesheet">
		<link href="./css/theme.css" rel="stylesheet">			<!-- cover some part of login_theme.css -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="./script/jquery-1.10.2.min.js"></script> 
		<script src="./script/bootstrap.min.js"></script>
        <script src="./script/jquery-cookie.js"></script>
        <script src="./script/login.js"></script>
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
						<div class="login-logo">
							<a> <img src="./images/logo.png" alt="伺服器錯誤"></a>
						</div>
						
						<div class="login-form">
							<div>
                                <label id="error_msg" style="color:red;font-size:30px;"></label>
								<input id="id" class="login-input1" type="text" name="id" placeholder="帳號 ex. [2018_11707]" />
								<input id="password" type="password" class="login-input1" name="password" placeholder="密碼 ex. 1234" />
								<label>
									<input type="checkbox" name="keep" value="1" />記住此登入帳號
								</label>               
								<div id="login">
                                    <input type="submit" id="btn-submit" value="登入" class="btn btn-login" onclick="login()"/>
                                </div>
                                <input type="hidden" name="dev_id" value="website" />
                                <label style="color:red;">*每班的50號是班級代訂</label>
							</div>
						</div>
                        
                        <hr />
                        
						<div id="new_account" class="item" onclick="window.location='pages/register_page.php';" style="display: block;"> 
							<div class="item-img-container">
								<img class="item-img" src="./images/arrow.png" align="center"/>
							</div>
							<div class="item-text-container">
								<p> 註冊 </p>
							</div>
						</div>
					</div>      
				</div>
			</div>
		  </div>
		</div>

	</body>
</html>