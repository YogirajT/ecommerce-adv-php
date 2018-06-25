<?php
session_start();
if(!isset($_SESSION['user']))
{
header('Location: signin.php');
exit;
}
$msg = "" ;
  require_once("../lib/Category.php");
  $category = new Category();
  if(isset($_POST['submit']))
  {
    $name = $_POST['cat_name'] ;
    $parent = $_POST['parent_cat'] ;
    if($category->insert($name,$parent))
    {
      $msg = "category inserted" ;
    }else{
      $msg = "some problem" ;
    }

  }
  include_once('layout/admin_header.php');
?>
 <h2 class="form_title">Add Category</h2>


  <nav>
   <ul>
     <li><a href="category_add.php">Add Category</a></li>
     <li><a href="category_list.php">View All Categories</a></li>
   </ul>
  </nav>
  
<div class="col-xs-6 col-xs-offset-3" style="border:3px solid #3e8f3e; padding:3em; margin-top:1em; margin-bottom:1em; border-radius:10px">

  <form method="post">
  <?= $msg ; ?>
    <div class="form-group">
      <label for="cat_name">Category Name</label>
      <input type="text" name="cat_name" id="cat_name" />
    </div>

    <div class="form-group">
      <label for="parent_cat">Parent Category</label>
      <select name="parent_cat" id="parent_cat">
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
      <input type="submit" name="submit" value="Add Category" />
    </div>

  </form>

</div>

<?php
  include_once('layout/admin_footer.php');
?>
