
<html>
    <body>
    
        <h3>你已經點餐成功</h3> <br />  <br />
    
        <?php unserialize($_SESSION['order'])->show_order() ?> <br /> <br />
        
        <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>"> 回到上一頁... </a> <br /> <br />
        <a href="../frontend/"> 回到首頁... </a> <br /> <br /> 
    
    
    </body>
</html>