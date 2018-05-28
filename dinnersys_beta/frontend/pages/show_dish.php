
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>板橋高中午餐系統</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/animate.css" rel="stylesheet">
        <link href="../css/major_theme.css" rel="stylesheet">
		<link href="../css/theme.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../script/jquery-1.10.2.min.js"></script> 
		<script src="../script/bootstrap.min.js"></script>
        <script src="../script/jquery-cookie.js"></script>
		<script src="../script/orders/categorize.js"></script>
        <script src="../script/orders/show_dish.js"></script>
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
                        <div style="height:20px;"></div>
						<div style="height:80px;"> <h1>顯示菜單</h1> </div>
                        
                        <div id="data">
                        
                        </div>
				    </div>
                    <div style="height: 30px;"></div>
                    <iframe id="order_criteria" src="../fragment/reverse_button.php" frameborder="0" scrolling="no" class="criteria" style="height:150px;"></iframe>
                    
			     </div>
            </div>
		</div>

	</body>
</html>