
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>板橋高中午餐系統</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/animate.css" rel="stylesheet">
        <link href="../css/detail_theme.css" rel="stylesheet">
        <link href="../css/theme.css" rel="stylesheet">	
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../script/jquery-1.10.2.min.js"></script> 
		<script src="../script/bootstrap.min.js"></script>
        <script src="../script/jquery-cookie.js"></script>
        <script src="../script/date.js"></script>
        <script src="../script/orders/make_order.js"></script>
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
						<div style="height:80px;"> <h1>顯示餐點</h1> </div>
                        
                        
                        <div class="title">
                            <div class="inner-title">
                                <label>餐點詳細內容</label>
                            </div>
                        </div>
                        
                        
						<hr class="special"/>
                        <div class="info">
                            <div class="index2">
                                <label>餐點編號:</label>
                            </div>
                            <div class="value2">
                                <label id="dish_id">5487</label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>餐點名稱:</label>
                            </div>
                            <div class="value2">
                                <label id="dish_name">美味蟹堡</label>
                            </div>
                        </div>
                        <hr /><div class="info">
                            <div class="index2">
                                <label>餐點要價:</label>
                            </div>
                            <div class="value2">
                                <label id="dish_cost">55$.</label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>廠商編號:</label>
                            </div>
                            <div class="value2">
                                <label id="factory_id">5269</label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>廠商名稱:</label>
                            </div>
                            <div class="value2">
                                <label id="factory_name">蟹寶王</label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>使用者編號:</label>
                            </div>
                            <div class="value2">
                                <label id="user_id"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>使用者名稱:</label>
                            </div>
                            <div class="value2">
                                <label id="user_name"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>班級編號:</label>
                            </div>
                            <div class="value2">
                                <label id="class_no"></label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>繳錢期限:</label>
                            </div>
                            <div class="value2">
                                <label id="payment_deadline">*限當日</label>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>取餐時間:</label>
                            </div>
                            <div class="value2">
                                <input id="recv_time" style="float:right;margin-top:2px;" type="time" value="12:05"/>
                            </div>
                        </div>
                        <hr />
                        <div class="info">
                            <div class="index2">
                                <label>我要點餐:</label>
                            </div>
                            <div id="submit" class="value2 clickable">
                                <label>點餐</label>
                            </div>
                        </div>
                        <hr />
                        
                        <div style="height:80px;display:none;" id="msg_container"> <h1 id="msg" style="color:red;font-weight:thick;"></h1> </div>
                        <div style="height:40px;"></div>
                        <div class="notify" id="msg_container"> 
                            <h5>(#) 若取餐時間是在中午十二點前後十分鐘，建議在上午十點前向班上代訂繳錢。</h5> 
                            <h5>(#) 若有多次訂購而未繳款，將會被系統列入看管名單，您可以將點錯的訂單取消掉。</h5> 
                        </div>
				</div>
			</div>
		  </div>
          <div style="height: 30px;"></div>
          <iframe id="order_criteria" src="../fragment/reverse_button.php" frameborder="0" scrolling="no" class="criteria" style="height:150px;"></iframe>
		</div>

	</body>
</html>