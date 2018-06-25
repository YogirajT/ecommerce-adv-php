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
		<?php if(!isset($_SESSION['user'])){ ?>
		<p><a class="btn btn-lg btn-success" href="#" role="button">Get started today!</a></p>
		<?php } ?>
		<?php if(!empty($msg)): ?>
		<p><?=$msg ?></p>
		<?php
		endif;?>
	</div>
</section>

<nav class="navbar">
		<ul class="nav nav-pills navbar-right">
			<li role="presentation"><a href="cartview.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart (<?php if(isset($_SESSION['user'])){ echo $cart->itemsno(); }else{ echo '0';}?>)</a></li>
		</ul>
</nav>
<input type="hidden" id="auth" value="">

<h2>Latest Additions</h2>

<div class="row is-flex">
<?php
foreach($product->listtop("DESC",3) as $p) :
?>
	<div class="col-sm-4">
		<div class="thumbnail" onclick="singleprod(<?=$p->id; ?>);">
			<img class='image-responsive' src='uploads/<?=$p->filename; ?>' style='height:100px;' alt="Image" />
			<h3 style="margin:10px; text-align:center">Rs.<?=$p->price; ?></h3>
			<div class="caption">
				<h3><?=$p->name; ?></h3>
				<p><?=substr($p->description, 0, 150); ?>...</p>
				<p>
					<form method="post">
					<input type="hidden" name="product_id" value="<?=$p->id;?>" />
					<input type="hidden" name="user_em" value="<?=$user_id;?>" />
					<?php if($p->in_stock == 1)
					{?>
					<input class='btn btn-success btn-abs' type="submit" value="Add to Cart" name="addcart" />
					<?php
					}else{?>
					<input class='btn btn-warning btn-abs' type="submit" value="Out of stock" disabled="disabled"/>
					<?php
					}?>
					</form>
				</p>
			</div>
		</div>
	</div>
<?php
endforeach ;
?>
</div>

<nav class="navbar">
		<ul class="nav nav-btn navbar-right">
			<li role="presentation"><a href="index2.php">Browse all Products <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></a></li>
		</ul>
</nav>

<?php
include_once('admin/layout/admin_footer.php');
?>