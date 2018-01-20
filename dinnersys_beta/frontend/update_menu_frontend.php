<html>
    <body>
        <form action="../backend/backend.php" method="get">
            <h3>input the dish's id.</h3>
            <input type="text" id="dish_id" name="dish_id"/>
            
            <br /><br /><br />
            <h3>input the new dish's name.</h3>
            <input type="text" id="dish_name" name="dish_name"/>
            
            <input type="submit" />
            
            <input type="hidden" name="cmd" value="update_menu"/>
        </form>
    </body>
</html>