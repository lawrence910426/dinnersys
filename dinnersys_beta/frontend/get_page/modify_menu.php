<html>
    <head>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" type="text/css" href="../frontend/css/theme.css" />
    </head>
    <body>
        <div class="content">
            <table style="width:100%"> 
                <tr> 
                    <th>餐點名稱</th> <th>餐點要價</th> <th>更改按鈕</th>
                </tr>
                
                <?php
                    $menu = unserialize($_SESSION['menu']);
                    $counter = -1;
                    foreach($menu as $value)
                    {
                        if(++$counter == 5)
                        {
                            echo
                            '<tr>
                                <td> <h3>----------</h3> </td> 
                                <td> <h3>----------</h3> </td> 
                                <td> <h3>----------</h3> </td> 
                            </tr>';
                            $counter = 0;
                        }
                        echo
                        '<form action="backend.php?">
                            <tr>
                                <td> <input name="dish_name" size="10" type="text" value="' . $value->name . '" /> </td> 
                                <td> <input name="dish_charge" size="5" type="text" value="' . $value->charge . '" /> </td> 
                                <td> <input type="submit" value="更改" /> </td>
                            </tr>
                            <input type="hidden" name="dish_id" value="' . $value->dish_id . '" />
                            <input type="hidden" name="cmd" value="update_menu" />
                        </form>';
                    }
                ?>
                
            </table>
        </div>
        <hr />
        <div class="content" style="height:25px;">
            <a href="../frontend/get_page/check_clear_menu.php" style="float:left;font-size:20px"> 清除菜單    </a>
            <a href="../frontend/index.php" style="float:right;font-size:20px"> 回到首頁    </a>
        </div>
    </body>
</html>