
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
        <script src="../script/orders/show_order/menu_control.js"></script>
        <script src="../script/orders/show_order/criteria.js"></script>
        <script src="../script/orders/show_order/show_orders.js"></script>
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
                        <iframe id="order_criteria" src="../fragment/order_criteria.php" frameborder="0" scrolling="no" class="criteria" style="height:150px;"></iframe>
                        <iframe id="extended_criteria" src="../fragment/extend_criteria.php" frameborder="0" scrolling="no" class="criteria" style="height:150px;"></iframe>

                    
                        <div class="inner-content animated bounceIn" style="background:#63d6ff;margin-top:50px;">
                            <div class="login-logo"> </div>
                            <div style="height:20px;"></div>
                            <div style="height:80px;"> <h1>顯示點單</h1> </div>
                            
                            <div class="title">
                                <div class="inner-title"><label>各類資料、功能</label></div>
                            </div> <hr class="special"/>
                            
                            <div id="container_dm_payment" style="display: none;">
                                <div class="info">
                                    <div class="index" style="width:60%"><label>代訂全部付款</label></div>
                                    <div id="dm_payment" class="value clickable" style="width:30%"><label>全部繳款</label></div>
                                </div> <hr />
                            </div>
                            <div id="container_cafet_payment" style="display: none;">
                                <div class="info">
                                    <div class="index" style="width:60%"><label>合作社全部付款</label></div>
                                    <div id="cafet_payment" class="value clickable" style="width:30%"><label>全部繳款</label></div>
                                </div> <hr />
                            </div>
                            <div id="container_facto_payment" style="display: none;">
                                <div class="info">
                                    <div class="index" style="width:60%"><label>廠商全部付款</label></div>
                                    <div id="facto_payment" class="value clickable" style="width:30%"><label>全部繳款</label></div>
                                </div> <hr />
                            </div>
                            
                            <div class="info">
                                <div class="index" style="width:60%"><label>金額加總</label></div>
                                <div class="value" style="width:30%"><label id="money_sum"></label></div>
                            </div> <hr />
                            <div class="info">
                                <div class="index" style="width:60%"><label>訂單總數</label></div>
                                <div class="value" style="width:30%"><label id="order_sum"></label></div>
                            </div> <hr />
                            
                            <div class="info">
                                <div class="index"><label>篩選條件</label></div>
                            </div>
                            <div class="group-radio" style="height: auto;">
                                <label id="show_criteria" style="margin-left:5px;"></label>
                            </div>
                            <hr />
                            
                            <div id="data">
                                
                            </div>
                        </div> 
                        
                        <div style="height: 30px;"></div>
                        <iframe id="order_criteria" src="../fragment/reverse_button.php" frameborder="0" scrolling="no" class="criteria" style="height:150px;"></iframe>
                    </div>
                </div>
		    </div>
		</div>

	</body>
</html>