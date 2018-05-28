
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
        <script src="../script/orders/show_order/order_detail.js"></script>
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
                            <div class="inner-title"><label>控制點單</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>第幾筆點單</label></div>
                            <div class="value2"><label id="order_index">第 -1 筆點單</label></div>
                        </div><hr />
                        
                        <div id="previous_container">
                            <div class="info">
                                <div class="index2"><label>往前一筆</label></div>
                                <div id="previous" class="value2 clickable"><label>往前一筆訂單</label></div>
                            </div><hr />
                        </div>
                        
                        <div id="next_container">
                            <div class="info">
                                <div class="index2"><label>往後一筆</label></div>
                                <div id="next" class="value2 clickable"><label>往後一筆訂單</label></div>
                            </div><hr />
                        </div>
                        
                        <div id="jump_container" >
                            <div class="info">
                                <div class="index2"><label>跳至某筆</label></div>
                                <div class="value2 clickable"><input id="jump" style="width:95%;float:right;margin-right:2px;margin-top:2px;" type="text" placeholder="按下enter跳至該筆" /></div>
                            </div><hr />
                        </div>
                        
                        <div class="title">
                            <div class="inner-title"><label>點單內容</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>點單編號</label></div>
                            <div class="value2"><label id="oid">5487</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>送達時間</label></div>
                            <div class="value2"><label id="esti_recv">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>刪除訂單</label></div>
                            <div id="delete" class="value2 clickable"><label id="inner_delete">刪除</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>確認取貨</label></div>
                            <div id="check_recv" class="value2 clickable"><label id="inner_check_recv">確認</label></div>
                        </div><hr />
                        
                        
                        <div class="title">
                            <div class="inner-title"><label>使用者資訊</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>使用者編號</label></div>
                            <div class="value2"><label id="uid">5487</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>使用者名稱</label></div>
                            <div class="value2"><label id="uname">8787</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>班級編號</label></div>
                            <div class="value2"><label id="cid">-1</label></div>
                        </div><hr />
                        
                        
                        <div class="title">
                            <div class="inner-title"><label>餐點資訊</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>餐點編號</label></div>
                            <div class="value2"><label id="did">5487</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>餐點名稱</label></div>
                            <div class="value2"><label id="dname">Krabby Patty.</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>餐點要價</label></div>
                            <div class="value2"><label id="dcost">-1$.</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>製作廠商</label></div>
                            <div class="value2"><label id="factory" >Krusty Krab</label></div>
                        </div><hr />
                        
                        
                        <div class="title">
                            <div class="inner-title"><label>代訂付款資訊</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>付款狀態</label></div>
                            <div class="value2"><label id="dm_status">who knows.</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2" style="width:45%"><label>允許付款時間</label></div>
                            <div class="value2"><label id="dm_lower_bound">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2" style="width:45%"><label>禁止付款時間</label></div>
                            <div class="value2"><label id="dm_upper_bound">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>付款時間</label></div>
                            <div class="value2"><label id="dm_paid_time">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>金額</label></div>
                            <div class="value2"><label id="dm_charge">-1$. </label></div>
                        </div><hr />
                        
                        <div id="container_dm_payment">
                            <div class="info">
                                <div class="index2"><label>付款</label></div>
                                <div id="dm_payment" class="value2 clickable"><label id="inner_dm_payment">付款</label></div>
                            </div><hr />
                        </div>
                        
                        
                        <div class="title">
                            <div class="inner-title"><label>合作社付款資訊</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>付款狀態</label></div>
                            <div class="value2"><label id="cafet_status">who knows.</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2" style="width:45%"><label>允許付款時間</label></div>
                            <div class="value2"><label id="cafet_lower_bound">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2" style="width:45%"><label>禁止付款時間</label></div>
                            <div class="value2"><label id="cafet_upper_bound">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>付款時間</label></div>
                            <div class="value2"><label id="cafet_paid_time">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>金額</label></div>
                            <div class="value2"><label id="cafet_charge">-1$.</label></div>
                        </div><hr />
                        
                        <div id="container_cafet_payment">
                            <div class="info">
                                <div class="index2"><label>付款</label></div>
                                <div id="cafet_payment" class="value2 clickable"><label id="inner_cafet_payment">付款</label></div>
                            </div><hr />
                        </div>
                        
                        
                        
                        <div class="title">
                            <div class="inner-title"><label>廠商付款資訊</label></div>
                        </div><hr class="special"/>
                        
                        <div class="info">
                            <div class="index2"><label>付款狀態</label></div>
                            <div class="value2"><label id="facto_status">who knows.</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2" style="width:45%"><label>允許付款時間</label></div>
                            <div class="value2"><label id="facto_lower_bound">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2" style="width:45%"><label>禁止付款時間</label></div>
                            <div class="value2"><label id="facto_upper_bound">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>付款時間</label></div>
                            <div class="value2"><label id="facto_paid_time">04/26-54:87</label></div>
                        </div><hr />
                        
                        <div class="info">
                            <div class="index2"><label>金額</label></div>
                            <div class="value2"><label id="facto_charge">-1$.</label></div>
                        </div><hr />
                        
                        <div id="container_facto_payment">
                            <div class="info">
                                <div class="index2"><label>付款</label></div>
                                <div id="facto_payment" class="value2 clickable"><label id="inner_facto_payment">付款</label></div>
                            </div><hr />
                        </div>
                        
                        
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