<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>板橋高中午餐系統</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/animate.css" rel="stylesheet">
        <link href="../css/major_theme.css" rel="stylesheet">
		<link href="../css/theme.css" rel="stylesheet">			<!-- cover some part of login_theme.css -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../script/jquery-1.10.2.min.js"></script>
        <script src="../script/date.js"></script> 
		<script src="../script/bootstrap.min.js"></script>
        <script src="../script/jquery-cookie.js"></script>
        <script src="../script/orders/order_criteria.js"></script>
	</head>
    <body>
        <div class="content inner-content animated bounceIn" style="background:#63d6ff"> 
            <div class="login-logo"> </div>
            
            <div style="height:20px;"></div>
            <div id="folder" class="item" style="display: block;"> 
    			<div class="item-img-container"><img class="item-img" src="../images/arrow.png" align="center"/></div>
    			<div class="item-text-container"><p> 篩選條件 </p></div>
    		</div>
            <div style="height:20px;"></div>
            
            <div id="content" style="display: none;">
                <div id="time_criteria">
                    <div class="title">
                        <div class="inner-title">
                            <label>時間篩選</label>
                        </div>
                    </div> <hr class="special"/>
                    <div class="group-radio">
                        <form style="display:block;margin-left:15px;">
                            <label>
                                <input name="time_criteria" type="radio" value="today" class="refresh" /> 今天
                            </label>
                            <label>
                                <input name="time_criteria" type="radio" value="week" class="refresh" /> 本週
                            </label>
                            <label>
                                <input name="time_criteria" type="radio" value="all" checked="checked" class="refresh" /> 不限制
                            </label>
                        </form>
                    </div>
                </div>
                
                
                <div id="payment_criteria">
                    <div class="title">
                        <div class="inner-title">
                            <label>繳款篩選</label>
                        </div>
                    </div> <hr class="special"/>
                    <div class="info">
                        <div class="index">
                            <label>代訂金流狀態:</label>
                        </div>
                    </div>
                    <div class="group-radio">
                        <form style="display:block;margin-left:15px;">
                            <label>
                                <input name="dm_paid" type="radio" value="paid" /> 已付
                            </label>
                            <label>
                                <input name="dm_paid" type="radio" value="unpaid" /> 未付
                            </label>
                            <label>
                                <input name="dm_paid" type="radio" value="all" checked="checked"/> 不限制
                            </label>
                        </form>
                    </div>                
                    
                    <hr /><div class="info">
                        <div class="index">
                            <label>合作社金流狀態:</label>
                        </div>
                    </div>
                    <div class="group-radio">
                        <form style="display:block;margin-left:15px;">
                            <label>
                                <input name="cafet_paid" type="radio" value="paid" /> 已付
                            </label>
                            <label>
                                <input name="cafet_paid" type="radio" value="unpaid" /> 未付
                            </label>
                            <label>
                                <input name="cafet_paid" type="radio" value="all" checked="checked"/> 不限制
                            </label>
                        </form>
                    </div>       
                    
                    <hr /><div class="info">
                        <div class="index">
                            <label>廠商金流狀態:</label>
                        </div>
                    </div>
                    <div class="group-radio">
                        <form style="display:block;margin-left:15px;">
                            <label>
                                <input name="facto_paid" type="radio" value="paid" /> 已付
                            </label>
                            <label>
                                <input name="facto_paid" type="radio" value="unpaid" /> 未付
                            </label>
                            <label>
                                <input name="facto_paid" type="radio" value="all" checked="checked"/> 不限制
                            </label>
                        </form>
                    </div>       
                </div>
    
                <div id="factory_criteria">
                    <div class="title">
                        <div class="inner-title">
                            <label>廠商篩選</label>
                        </div>
                    </div> <hr class="special"/>
                    
                    <form id="factory_select">
                        <div id="factories">
                            <!-- javascript will insert data here -->
                            <div class="info">
                                <div class="index" style="width:60%;">
                                    <label>選擇所有廠商</label>
                                </div>
                                 <div class="value" style="width:30%;">
                                    <label style="margin-right:5px;"><input type="radio" name="factory" value="all" checked="checked"/> 不限制 </label>
                                </div>
                            </div>
                            
                        </div>  
                    </form>
                </div>
            </div>
      </div>
    </body>
</html>