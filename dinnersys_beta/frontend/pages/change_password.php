
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
        <script src="../script/change_pswd.js"></script>
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
                            <label style="color:black;font-size:30px;"> 請輸入你的密碼 </label> <br />
                            <label id="error_msg" style="color:red;font-size:30px;"></label>
                            <hr />
                            
                            <label style="color:black;font-size:15px;"> 密碼只允許大小寫英文數字底線及空白 </label> <br />
                            <input id="old" class="login-input1" type="password" placeholder="舊密碼" />
                            <input id="new" class="login-input1" type="password" placeholder="新密碼" />
							
						</div>
                        
                        <hr />
                        
						<div id="new_account" class="item" style="display: block;"> 
							<div class="item-img-container">
								<img class="item-img" src="../images/arrow.png" align="center"/>
							</div>
							<div class="item-text-container">
								<p> 確認更改 </p>
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