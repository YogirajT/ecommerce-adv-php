<?php
session_start();
if(!isset($_SESSION['user']))
{
header('Location: signin.php');
exit;
}
  require_once("../lib/Category.php");
  $category = new Category();
  $msg = "";
  if(isset($_POST['submit']))
  {
      $cat_id = $_POST['cat_id'] ;
      if($category->delete($cat_id))
      {
        $msg = "Category deleted" ;
      }else{
        $msg = "Category not deleted";
      }
  }
  include_once('layout/admin_header.php');
?>
 <h2 class="form_title">List of All Categories</h2>

 <nav>
  <ul>
    <li><a href="category_add.php">Add Category</a></li>
    <li><a href="category_list.php">View All Categories</a></li>
  </ul>
 </nav>

<div class="col-xs-6 col-xs-offset-3" style="">
  <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Category Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?= $msg ; ?>
  <?php

  foreach($category->list() as $c) :
    echo "<tr><td></td>";
    echo "<td><h3> $c->name </h3></td> ";
  ?>
  <td>
  <form method="post">
      <input type="hidden" name="cat_id" value="<?=$c->id;?>" />
      <input type="submit" value="Delete" name="submit" />
  </form>
  </td>
  </tr>
  <?php

  endforeach ;

  ?>
  </tbody>
  </table>
</div>
<?php
  include_once('layout/admin_footer.php');
?>
