<?php
session_start();
if(!isset($_SESSION['user']))
{
header('Location: signin.php');
exit;
}
	require_once("../lib/Category.php");
	require_once("../lib/Product.php");
	$msg = "" ;
	$prod = new Product();
	$category = new Category();
	if(isset($_POST['submit']))
	{
		$product = new Product ;
		$product->name = $_POST['name'] ;
		$product->description = $_POST['description'];
		$product->price = $_POST['price'] ;
		$product->category_id = $_POST['category_id'];
		$product->in_stock = isset($_POST['in_stock']) ? 1 : 0  ;
		if($product->insert())
		{
			$msg = "product added to database" ;
		}else{
			$msg= "some problem occured" ;
		}
	}
	include_once('layout/admin_header.php');
?>
 <h2 class="form_title">Add Product</h2>


	<nav>
	 <ul>
		 <li><a href="product_add.php">Add Product</a></li>
		 <li><a href="product_list.php">View All Products</a></li>
	 </ul>
	</nav>
<div class="col-xs-6 col-xs-offset-3" style="border:3px solid #3e8f3e; padding:3em; margin-top:1em; margin-bottom:1em; border-radius:10px">

<form method="post">
<?= $msg ; ?>
	<div class="form-group">
		<label for="name">Product Name</label>
		<input type="text" name="name" id="name" />
	</div>

	<div class="form-group">
		<label for="description">Product Description</label>
		<textarea row="40" cols="50" name="description" id="description"></textarea>
	</div>

	<div class="form-group">
		<label for="price">Product Price</label>
		<input type="number" name="price" id="price" />
	</div>

	<div class="form-group">
		<label for="category_id">Product Category</label>
		<select name="category_id" id="category_id">
				<option value="NULL">None</option>
				<?php
				foreach($category->list() as $cat ) :
					?>
					<option value="<?= $cat->id ;?>"><?= $cat->name ;?></option>
					<?php
				endforeach;
					?>
		</select>
	</div>

	<div class="form-group">
		<label for="price">Is in stock ?</label>
		<input type="checkbox" name="in_stock" checked="true" />
	</div>

	<div class="form-group">
		<input type="submit" name="submit" value="Add Product" />
	</div>

</form>

</div>

<?php
	include_once('layout/admin_footer.php');
?>
