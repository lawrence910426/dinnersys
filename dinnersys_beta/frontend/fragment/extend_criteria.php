<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>板橋高中午餐系統</title>
		<!-- Bootstrap -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/animate.css" rel="stylesheet">
        <link href="../css/major_theme.css" rel="stylesheet">
		<link href="../css/theme.css" rel="stylesheet">			<!-- cover some part of login_theme.css -->
        <link href="../css/major_theme.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../script/jquery-1.10.2.min.js"></script> 
		<script src="../script/bootstrap.min.js"></script>
        <script src="../script/jquery-cookie.js"></script>
        <script src="../script/orders/extend_criteria.js"></script>
	</head>
    <body>
                        
                        
        <div class="content inner-content animated bounceIn" style="background:#63d6ff"> 
            <div class="login-logo"> </div>
            
            <div style="height:20px;"></div>
            <div id="folder" class="item" style="display: block;"> 
    			<div class="item-img-container"><img class="item-img" src="../images/arrow.png" align="center"/></div>
        			<div class="item-text-container"><p> 進階篩選條件 </p></div>
        		</div>
            <div style="height:20px;"></div>
            
            <div id="content" style="display: none;">
                <form>
                    <div class="title">
                        <div class="inner-title">
                            <label>進階篩選條件</label>
                        </div>
                    </div> <hr class="special"/>
                    <div class="info">
                        <div class="index2 index_number">
                            <label>使用者編號</label>
                        </div>
                        <div class="value2 value_number">
                            <label><input id="uid" type="number" placeholder="留白不限制"/></label>
                        </div>
                    </div> <hr />
                    <div class="info">
                        <div class="index">
                            <label>針對使用者查詢:</label>
                        </div>
                    </div> 
                    <div class="group-radio">
                        <form style="display:block;">
                            <label><input style="margin-left:15px;" name="focus" type="radio" value="person" checked="checked" />針對個人</label>
                            <label><input style="margin-left:15px;" name="focus" type="radio" value="class" />針對該班級</label>
                        </form>
                    </div> 
                    <hr />
                
                    <div class="info">
                        <div class="index2 index_number">
                            <label>班級編號</label>
                        </div>
                        <div class="value2 value_number">
                            <label><input id="cid" type="number" placeholder="留白不限制"/></label>
                        </div>
                    </div> <hr />
                    
                    
                </form>
                
                <div class="info">
                    <div class="index"><label>選擇年級:</label></div>
                </div> <hr />
                <div class="group-radio" style="width:90%">
                        <form style="display:block;margin-left:15px;">
                            <label>
                                <input name="grade" type="radio" value="1" /> 高一
                            </label>
                            <label>
                                <input name="grade" type="radio" value="2" /> 高二
                            </label>
                            <label>
                                <input name="grade" type="radio" value="3"/> 高三
                            </label>
                            <label>
                                <input name="grade" type="radio" value="all" checked="checked"/> 不限制
                            </label>
                        </form>
                </div>       
                <hr />
            </div>
                                
                            
    </body>
</html>