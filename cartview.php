<?php
session_start();

require_once("lib/Product.php");
require_once('lib/User.php');
require_once('lib/Cart.php');

$cart = new Cart();
if(isset($_SESSION['user']))
{
	$user_id = $_SESSION['user'];
	$cart->uemail = $_SESSION['user'];
}


if(isset($_POST['login']))
{
	$user = new User();
	$user->email = $_POST['email'] ;
	$user->password = $_POST['password'] ;
	if(!$user->error and $user->login())
	{
		$_SESSION['user'] = $user->email ;
		header('Location:index.php');exit;
	}else {
		echo "<div class='error'>Invalid username or password</div>" ;
	}
}
include_once('layout/admin_header.php');



$product = new Product();

$msg = "";
if(isset($_POST['addcart']) && isset($_SESSION['user']))
{
	$product_id = $_POST['product_id'] ;
	if($product->addtocart($product_id,$user_id))
	{
		$msg = "Product added to cart!" ;
	}else{
		$msg = "Something went wrong";
	}
}
elseif(isset($_POST['addcart']) && !isset($_SESSION['user'])){
	$msg = "Please sign in to purchase items";
}
?>

<section class="unfixed">
	<!-- Jumbotron -->
	<div class="jumbotron">
		<img src="./img/weblogo.png" alt="logo" class="img-responsive" id="logo1"/>
		<p></p>
		<p>Your cart has <?php if(isset($_SESSION['user'])){ echo $cart->itemsno(); }else{ echo '';}?> item/s waiting for checkout!</p>
		<?php if(!empty($msg)){ ?>
		<p><?=$msg ?></p>
		<?php
		}?>
	</div>
</section>


<input type="hidden" id="auth" value="">

<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cross" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel" style="font-size:1.5em">tech auctions</h4>
            </div>
            <div class="modal-body">
				<form action="" method="POST">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="abc@email.com">
						<div class="error"><?php if(isset($user->error['email'])) echo $user->error['email']; ?></div>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="password">
						<div class="error"><?php if(isset($user->error['password'])) echo $user->error['password']; ?></div>
					</div>
					<div class="form-group">
						<p class="help-block"><a href="mypage.html">Don't have an account? Sign up!</a></p>
					</div>
					<button type="submit" class="btn btn-default btn-default1" name="login" style="width:100%;">Sign In</button>
				</form>
            </div>
        </div>
    </div>
</div>

<?php if(isset($_SESSION['user']))
{ ?>

<div class="row">
	<table class="table table-striped table-hover" style="text-align: center; margin:auto; width:70%;">
		<thead>
			<tr>
				<th>#</th>
				<th>Product</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php

		foreach($cart->list() as $p) :
		echo "<tr><td></td>";
		echo "<td><h3> $p->name </h3></td> ";
		//echo "<img class='image-responsive' src='uploads/$p->filename' style='height:100px;' /></td>";
		echo "<td>$p->price</td>";
		echo "<td><div>";
		?>
		<form action="removecart.php" method="post">
			<input type="hidden" name="product_id" value="<?=$p->product_id;?>" />
			<input type="hidden" name="user_em" value="<?=$user_id;?>" />
			<input class='btn btn-sm btn-danger' type="submit" value="Remove from cart" name="rmcart" />
		</form>
		<?php
		echo "</div></td></tr>";
		endforeach;
		?>
		<tr>
			<th>&nbsp;</th>
			<th style="text-align:center;">Grand Total</th>
			<th style="text-align:center;" class="GT"><?php echo $cart->carttotal(); ?></th>
			<th style="text-align:center;"><a>Proceed to Checkout</a></th>
		</tr>
		</tbody>
	</table>
</div>
<?php
}else{ echo "<h1 style='text-align:center;'>Sign-in to view Shopping cart</h1>";} ?>

<nav class="navbar">
		<ul class="nav nav-btn navbar-right">
			<li role="presentation"><a href="index2.php"><span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span> Back to all Products</a></li>
		</ul>
</nav>

<?php
include_once('admin/layout/admin_footer.php');
?>