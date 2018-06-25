<?php
require_once('DB.php');
class Cart extends DB
{
    private $data = [];
    private $result ;
    private $subtotal = [];
    private $transactions = [];

    function list()
    {
      $sql = "SELECT * FROM cart c JOIN products p ON c.product_id=p.id JOIN users u ON c.user_id=u.email WHERE u.email='{$this->data['uemail']}'" ;
      $this->query($sql);
      $cproducts = [] ;
      while($product = $this->toObject())
      {
        $cproducts[] = $product ;
      }
      return $cproducts;
    }
    
    function itemsno()
    {
      $sql = "SELECT * FROM cart c JOIN products p ON c.product_id=p.id JOIN users u ON c.user_id=u.email WHERE u.email='{$this->data['uemail']}'" ;
      $row = $this->query($sql);
      return $row->num_rows;
    }


    function __get($name)
    {
      return  $this->data[$name] ;
    }

    function __set($name,$val)
    {
      $this->data[$name] = $val ;
    }

    function removefromcart($id,$user)
    {
        $transactions[] = "UPDATE products SET in_stock=1 WHERE id='$id';"; 
        $transactions[] = "DELETE FROM cart WHERE product_id = $id AND user_id = '$user';";
        return $this->transact($transactions) ;
    }

    function carttotal()
    {
      foreach($this->list() as $p):
        $this->subtotal[] = $p->price;
      endforeach;
      if(count($this->subtotal) > 0)
      {
        return array_sum($this->subtotal);
      }else{
        return 0;
      }
    }
}


?>