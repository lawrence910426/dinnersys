

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/animate.css" rel="stylesheet">
		<link href="./css/theme.css" rel="stylesheet">
        <script src="./script/jquery-1.10.2.min.js"></script> 
		<script src="./script/bootstrap.min.js"></script>
        <script src="./script/jquery-cookie.js"></script>
        <script src="./script/cmd_proc.js"></script>
	</head>
    
    <body>
		<div id="wrap">
			<div class="content">
				<div class="row">
					<div class="col-md-12" id="content-body">
						<div class="inner-content animated bounceIn" style="background:#63d6ff">
							<h1></h1>
							
							<div style="height:10px;"> </div>
							<div style="height:80px;">
								<h1> 午餐系統 </h1>
							</div>
							
							<div id="get_menu" class="item" onclick="window.location='pages/show_dish.php';"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 我要點餐 </p>
								</div>
							</div>
							
							<div id="get_self_order" class="item" onclick="window.location='pages/show_order.php?criteria=self';"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 我點了什麼 </p>
								</div>
							</div>
							
							<div id="get_class_order" class="item" onclick="window.location='pages/show_order.php?criteria=class';"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 全班點了什麼 </p>
								</div>
							</div>
							
							<div id="get_selected_order" class="item" onclick="window.location='pages/show_order.php?criteria=whole';"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 全校點了什麼 </p>
								</div>
							</div>
							
                            <div id="update_ingre" style="display: none;">
                                <hr />
    							<div class="item" style="display:block;"> 
    								<div class="item-img-container">
    									<img class="item-img" src="./images/arrow.png" align="center"/>
    								</div>
    								<div class="item-text-container">
    									<p> 更新原料 </p>
    								</div>
    							</div>
                            </div>
							
                            <div id="update_menu" style="display: none;">
                                <div class="item" style="display:block;"> 
    								<div class="item-img-container">
    									<img class="item-img" src="./images/arrow.png" align="center"/>
    								</div>
    								<div class="item-text-container">
    									<p> 更新菜單 </p>
    								</div>
    							</div>
                            </div>
							
							<hr />
							
							<div id="change_pswd" class="item" onclick="window.location='pages/change_password.php';"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 更改密碼 </p>
								</div>
							</div>
							
							<div id="new_account" class="item" onclick="window.location='pages/register_page.php';"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 註冊 </p>
								</div>
							</div>
							
							<div id="logout" class="item" onclick="logout();"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> 登出 </p>
								</div>
							</div>
							
							<hr />
							
							<div id="android_app" class="item" onclick="window.location='phone_app.php';" style="display:block;"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> Android App </p>
								</div>
							</div>
							
							<div id="ios_app" class="item" onclick="window.location='phone_app.php';" style="display:block;"> 
								<div class="item-img-container">
									<img class="item-img" src="./images/arrow.png" align="center"/>
								</div>
								<div class="item-text-container">
									<p> iOS App </p>
								</div>
							</div>
						</div>      	        
					</div>
				</div>
			</div>
		</div>
        

    </body>
</html>