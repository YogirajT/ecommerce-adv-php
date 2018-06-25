<?php
  require_once('DB.php');
  class Category extends DB
  {
      function insert($name,$parent= 'NULL')
      {
          $sql = "INSERT INTO categories VALUES(NULL,'$name',$parent)";
          return $this->query($sql);
      }

      function list()
      {
        $sql = "SELECT * FROM categories " ;
        $this->query($sql);
        $categories = [] ;
        while($cat = $this->toObject())
        {
          $categories[] = $cat ;
        }
        return $categories ;
      }

      function delete($id)
      {
          $sql = "DELETE FROM categories WHERE id = $id" ;
          return $this->query($sql) ;
      }
  }
?>
