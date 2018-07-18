
<form name="cart" method="post" action="">
<input type="text" placeholder="Enter the products for e.g ABCDABAA" value="" name="products"/><input type="submit" value="submit" name="submit"/>
</form>

<?php
   if(isset($_POST) && !empty($_POST['products'])) {
     
   
    $products = $_POST['products'];
    $input_products = rtrim($products);
    $total = 0;
    $input_array = str_split($input_products, 1);
    $counts = array_count_values($input_array);
    $products = array(
    'A'=>array('1'=>2.00, '4'=>7.00),
    'B'=>array('1'=>12.00),
    'C'=>array('1'=>1.25, '6'=>6.00),
    'D'=>array('1'=>0.15)
    );
    foreach($counts as $code=>$amount) {
        echo "Product Code : " . $code . "<bR>";
        if(isset($products[$code]) && count($products[$code]) > 1) {
            $groupUnit = max(array_keys($products[$code]));
            $subtotal = intval($amount / $groupUnit) * $products[$code][$groupUnit] + fmod($amount, $groupUnit) * $products[$code]['1'];
            $total += $subtotal; 
        }
        elseif (isset($products[$code])) {
            $subtotal = $amount * $products[$code]['1'];
            $total += $subtotal;
        }
        echo "subtotal: " . $subtotal . "<bR>";
    }
    echo 'Final Total: $' . number_format($total, 2). "<bR>"; 
   }
?>