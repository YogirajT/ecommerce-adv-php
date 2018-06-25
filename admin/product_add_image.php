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
  if(isset($_FILES['image']) && $_FILES['image']['error']==0)
  {
    $path = pathinfo($_FILES['image']['name']);
    $ext = $path['extension'];
    $unique = uniqid() . "." . $ext ;
    move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/$unique");
    if($prod->saveImage($_GET['id'],$unique))
    {
      $msg = "Image added to product" ;
    }else {
      $msg = "Difficulty in adding image" ;
    }
  }
  include_once('layout/admin_header.php');
?>
 <h2 class="form_title">Add Product Image</h2>


  <nav>
   <ul>
     <li><a href="product_add.php">Add Product</a></li>
     <li><a href="product_list.php">View All Products</a></li>
   </ul>
  </nav>

<div class="col-xs-6 col-xs-offset-3" style="border:3px solid #3e8f3e; padding:3em; margin-top:1em; margin-bottom:1em; border-radius:10px">
  <form method="post" enctype="multipart/form-data">
  <?= $msg ; ?>
    <div class="form-group">
      <label for="image">Product Image</label>
      <input type="file" name="image" id="image" />
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="Upload Image" />
    </div>

  </form>
</div>

<?php
  include_once('layout/admin_footer.php');
?>
