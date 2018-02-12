<?php header('Location: ' . $_SERVER["HTTP_REFERER"]) ?>




<!--

<html>
    <body>
        <h3> 本次繳款資訊 </h3> <br /> <br />
        <?php unserialize($_SESSION['recipt'])->show_order(); ?> <br /> <br />
        <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>"> 回到上一頁... </a> <br /> <br />
        <a href="../frontend/"> 回到首頁... </a> <br /> <br />
    </body>
</html>