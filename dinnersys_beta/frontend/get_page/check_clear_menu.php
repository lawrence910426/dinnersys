<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/theme.css" />
    </head>
    <body>
        <div class="content">
            <h3> 你確定要清空菜單嗎? </h3> <br /> <br /> <br />
            <a href="../../backend/backend.php?cmd=clear_menu"> 是的，請刪除 </a> <br /> <br />
            <a href="<?php echo $_SERVER["HTTP_REFERER"];?>"> 不是，返回上一頁 </a>
        </div>
    </body>
</html>