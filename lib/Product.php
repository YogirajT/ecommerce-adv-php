<?php
require_once('DB.php');
class Product extends DB
{
	private $data = [] ;
	private $filename ;
	private $transactions=[];


	function __get($name)
	{
		return  $this->data[$name] ;
	}

	function __set($name,$val)
	{
		$this->data[$name] = $val ;
	}

	function insert()
	{
		$now = time();
		$sql = "INSERT INTO products VALUES(NULL,'{$this->data['name']}','$this->description',$this->price,$this->category_id,'$this->in_stock',$now,$now)";
		return $this->query($sql) ;
	}

	function __call($name,$args){

		$sql = "SELECT *, pi.id as piid, p.id as id FROM products p LEFT JOIN product_images pi ON p.id=pi.product_id";
		//print_r($args);
		switch(count($args)) {
			case 0:
				$sql .= "";
				break;
			case 1:
				$sql .= " WHERE p.id={$args[0]}";
				break;
			case 2:
				$sql .= " ORDER BY updated {$args[0]} LIMIT {$args[1]}";
				break;
			case 3:
				if(!empty($args[0])){
				$sql .= " WHERE p.category_id = {$args[0]} LIMIT {$args[1]}, {$args[2]}";
				}else{
				$sql .= " LIMIT {$args[1]}, {$args[2]}";
				}
				break;
			case 4:
				if(!empty($args[0])){
				$sql .= " WHERE p.category_id = {$args[0]} AND p.name LIKE '%{$args[3]}%' LIMIT {$args[1]}, {$args[2]} ";
				}else{
				$sql .= " WHERE p.name LIKE '%{$args[3]}%' LIMIT {$args[1]}, {$args[2]} ";
				}
				break;
			break;
			default:
				$sql .= "";
		}
		//echo $sql;
		$this->query($sql);
		return $this->list();
	}

	function pagination($limit,$cat,$search){

		if(!empty($cat)){
			$sql = "SELECT COUNT(id) as total FROM products p WHERE p.name LIKE '%$search%' AND category_id=$cat";
		}else{
		$sql = "SELECT COUNT(id) as total FROM products p WHERE p.name LIKE '%$search%'";
		}
		echo $sql;
		$arr_objs = [];
		$this->query($sql);
		while($row = $this->toObject())
        {
            array_push($arr_objs, $row);
        }
		$total_records = $arr_objs[0]->total ;
		$total_pages = ceil($total_records / $limit);
		return $total_pages;
	}

	function list()
	{
		$products = [] ;
		while($product = $this->toObject())
		{
			$products[] = $product ;
		}
		return $products;
	}

	function saveImage($pid,$image)
	{
		$sql = "INSERT INTO product_images VALUES (NULL,$pid, '$image')";
		return $this->query($sql) ;
	}

	function delete($id)
	{
		$sql = "DELETE FROM products WHERE id = $id" ;
		return $this->query($sql) ;
	}

	function addtocart($id,$user)
	{
		$transactions[] = "UPDATE products SET in_stock=0 WHERE id='$id';"; 
		$transactions[] = "INSERT INTO cart VALUES(null,'$id','$user');";
		return $this->transact($transactions) ;
	}
}
?>
