<?php
session_start();

require_once('lib/Cart.php');

if(isset($_POST['rmcart']))
{
    $cart = new Cart();
    $id = $_POST['product_id'];
    $user = $_POST['user_em'];
    $cart->removefromcart($id,$user);
    
}
header('Location: cartview.php');
exit;
?>

?>