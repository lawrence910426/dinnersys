<html>
    <body>
        <form action="../backend/backend.php">
            <h3>請輸入你的座號 ex.[11707]</h3>
            <input type="text" id="id" name="id"/>
            
            <br />
            <h3>請輸入你的密碼 ex.[1234] ps.預設密碼是1234</h3>
            <input type="text" id="password" name="password"/>
            
            <br />
            
            <input type="submit" value="login"/>
            
            <input type="hidden" value="login" name="cmd" id="login"/>
        </form>
    </body>
</html>