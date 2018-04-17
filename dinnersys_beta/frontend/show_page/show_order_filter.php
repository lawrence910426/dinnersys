<?php
$sum = 0;$paid_sum = 0; $factory_paid_sum = 0;
foreach($orders as $ord)
{
    $sum += $ord->dish->charge;
    if($ord->paid) $paid_sum += $ord->dish->charge;
    if($ord->factory_paid) $factory_paid_sum += $ord->dish->charge;
}

$fragment_width = 50;
if($prev['admin'] || $prev['factory']) $fragment_width += 90 + 90;
?>

<div class="content" style="height: <?php echo $fragment_width . 'px' ?>;width=100%">
    <div style="height:50px;width: 100%">
        
        <?php 
            if($prev['admin'] || $prev['dinnerman']) echo '<p style="margin-top:10px;margin-left:10px;float:left;font-size:20px">Σ全部: ' . $sum . ' </p>';
            if($prev['admin'] || $prev['dinnerman']) echo '<p style="margin-top:10px;margin-right:10px;float:right;font-size:20px">Σ學生已付: ' . $paid_sum . '</p>';
            if($prev['admin'] || $prev['factory']) echo '<p style="margin-top:10px;float:center;font-size:20px">Σ合作社已收:' . $factory_paid_sum . '</p>'; 
        ?>
    </div>
    
    <?php
        if($prev['admin'] || $prev['factory'])
        {
            echo '<div style="height: 90px;width: 100%">
                <p style="margin-bottom:10px;float:center;font-size:20px" >目前查看的班級</p>
                <select style="margin-bottom:10px;margin-left:10px;float:center;font-size:20px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">';
            $class_no = $_REQUEST['class_no'];
            if($class_no == -1 || $class_no == null) $class_no = unserialize($_SESSION['user'])->class_no;
            for($i = 101;$i != 121;$i++)
                echo 
                    '<option '  . 
                    ($class_no == $i ? 'selected="selected" ' : '') .
                    'value="backend.php?cmd=' . ($show_order ? 'show_order' : 'show_class_order') .
                    '&payment_filter=nothing&date_filter=week&person_filter=specific_class&type=junk&plugin=no&class_no=' . $i . '">' . $i . '</option>';                   
            echo '</select> </div>';
            
            echo '<div style="height: 90px;width: 100%">
                    <button style="margin-bottom:10px;float:center;font-size:20px" onclick="location.href = \'backend.php?cmd=factory_payment&class_no=' . $class_no . '\';">合作社確認付款</button>
                  </div>';
        }
    ?> 
    
    </div>
<hr />
<div class="content" style="height: 40px;width=100%">
    <p style="margin-top:0px;float:left;font-size:20px;color:red;">   必須先繳款，合作社才能拿到訂單。</p>
    <a href="../frontend/index.php" style="margin-top:0px;float:right;font-size:20px"> 回到首頁    </a>
</div>
<hr />