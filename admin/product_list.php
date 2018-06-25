<?php
session_start();
if(!isset($_SESSION['user']))
{
header('Location: signin.php');
exit;
}
require_once("../lib/Product.php");
$product = new Product();
$msg = "";
if(isset($_POST['submit']))
{
	$product_id = $_POST['product_id'] ;
	if($product->delete($product_id))
	{
	$msg = "Product deleted" ;
	}else{
	$msg = "Product not deleted";
	}
}
include_once('layout/admin_header.php');
?>
<h2 class="form_title jumbotron">List of All Products</h2>

<nav>
<div class="nav-container">
	<ul class="nav nav-tabs">
	<li><a href="product_add.php">Add Product</a></li>
	<li><a href="product_list.php">View All Products</a></li>
	</ul>
</div>
</nav>



<?= $msg ; ?>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Sr no.</th>
			<th>Product</th>
			<th>Price</th>
			<th>Added Date</th>
			<th>Description</th>
			<th>Action</th>

		<tr>
	</thead>
	<tbody>
	<?php

	foreach($product->listasdas() as $p) :
	echo "<tr><td></td>";
	echo "<td><h3> $p->name </h3> ";
	echo "<img class='image-responsive' src='../uploads/$p->filename' style='height:100px;' /></td>";
	echo "<td>$p->price</td>";
	echo "<td>". date("F j, Y",$p->created). "</td>";
	echo "<td>". $p->description . "</td>";
	echo "<td><div><a class='btn btn-primary' href='product_add_image.php?id=$p->id'>Add Image</a>";
	?>
	<form method="post">
		<input type="hidden" name="product_id" value="<?=$p->id;?>" />
		<input class='btn btn-danger' type="submit" value="Delete" name="submit" />
	</form>
	<?php
	echo "</div></td><tr>";
	endforeach ;
	?>

	</tbody>
</table>

<?php
include_once('layout/admin_footer.php');
?>
