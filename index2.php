<?php
session_start();

require_once("lib/Product.php");
require_once('lib/User.php');
require_once('lib/Cart.php');
require_once('lib/Category.php');

$cart = new Cart();
$product = new Product();
$dbc = new Category();
$search = "";

if(isset($_GET['search']))
{
$search = $_GET["search"];
}

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
		<?php if(!empty($msg)){ ?>
		<p><?=$msg ?></p>
		<?php
		}?>
	</div>
</section>


<nav class="navbar row">
      <!-- Brand and toggle get grouped for better mobile display -->

        <?php
			$objcs = $dbc->list();
			$categ = "";
        ?>
		<ul class="nav navbar-nav nav-pills">
			<li role="presentation"><a>Displaying : <?php
         if(isset($_GET['categ']) && !empty($_GET['categ']))
         { 
           $categ=$_GET['categ'];
           foreach($objcs as $catg):
            if($catg->id==$categ){
              $ccname = $catg->name;
              echo $ccname;
            }
           endforeach;
         }else{
           echo "All items";
         }?></a></li>
				</ul>
        <ul class="nav navbar-nav navbar-right">
				<li><a href="#">Change category :</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">-Select- <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php foreach($objcs as $cat): ?>
              <li><a href="http://localhost/ecom/index2.php?categ=<?=$cat->id?>"><?=$cat->name ?></a></li>
              <?php endforeach; ?>
              <!-- <li role="separator" class="divider"></li> -->
            </ul>
          </li>
        </ul>
  </nav>

<nav class="navbar row">
	<div class="col-sm-offset-5">
	<ul class="nav nav-pills navbar-left">
		<li role="presentation"><a href="cartview.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart (<?php if(isset($_SESSION['user'])){ echo $cart->itemsno(); }else{ echo '0';}?>)</a></li>
		<li role="presentation"><a href="index2.php">All Products</a></li>
	</ul>
	</div>
</nav>
<input type="hidden" id="auth" value="">

<h1><?php //print_r($product->pagination(2)); ?></h1>

<?php 
$limit = 1;
if (isset($_GET["page"])) {
	$page = $_GET["page"]; 
}else{ 
	$page=1; 
};
$start_from = ($page-1) * $limit;

?>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Product</th>
			<th>Price</th>
			<th>Added Date</th>
			<th>Description</th>
			<th>Action</th>
	</thead>
	<tbody>
	<?php

	foreach($product->listrine($categ, $start_from, $limit, $search) as $p) :
	echo "<tr onclick=singleprod(". $p->id .");><td></td>";
	echo "<td><h3>$p->name </h3> ";
	echo "<img class='image-responsive' src='uploads/$p->filename' style='height:100px;' alt='Image' /></td>";
	echo "<td>$p->price</td>";
	echo "<td>". date("F j, Y",$p->created). "</td>";
	echo "<td>". $p->description . "</td>";
	echo "<td><div>";
	?>
	<form method="post">
		<input type="hidden" name="product_id" value="<?=$p->id;?>" />
		<input type="hidden" name="user_em" value="<?=$user_id;?>" />
		<?php if($p->in_stock == 1)
		{?>
		<input class='btn btn-success' type="submit" value="Add to Cart" name="addcart" />
		<?php
		}else{?>
		<input class='btn btn-warning' type="submit" value="Out of stock" disabled="disabled"/>
		<?php
		}?>
	</form>
	<?php
	echo "</div></td></tr>";
	endforeach ;
	?>
	</tbody>
</table>

<?php
if(isset($_GET['page'])){ $pno=$_GET['page']; }else{$pno=1;}
$tr = $product->pagination($limit,$categ,$search);
?>
<nav aria-label="Page navigation">
<ul class="pagination">
	<li class="<?php if(!isset($pno) || $pno<=1){ echo 'disabled';};?>">
	<?php
	if(isset($pno) && $pno>1)
	{
	$prev=$pno;
	?>
	<a href="index2.php?page=<?=$prev-1;?>&amp;categ=<?=$categ?>" aria-label="Previous">
	<?php }?>
		<span aria-hidden="true">&laquo;</span>
	</a>
	</li>
<?php for ($i=1; $i<=$tr; $i++){ ?>
	<li><a href="index2.php?page=<?=$i?>&amp;categ=<?=$categ?>"><?=$i?></a></li>
<?php };?>
	<li class="<?php if($tr<2 || $pno>=$tr){ echo 'disabled';};?>">
	<?php
	if(isset($pno) && $pno<$tr)
	{
	$nxt=$pno;
	?>
	<a href="index2.php?page=<?=$nxt+1;?>&amp;categ=<?=$categ?>" aria-label="Next">
	<?php }?>
		<span aria-hidden="true">&raquo;</span>
	</a>
	</li>
</ul>
</nav>


<?php
include_once('admin/layout/admin_footer.php');
?>