<?php 
class database{
	private $host;
	private $dbusername;
	private $dbpassword;
	private $dbname;

	protected function connect(){
		$this->host = 'localhost';
		$this->dbusername = 'root';
		$this->dbpassword = '';
		$this->dbname = 'php_oop_crud';

		$con = new mysqli($this->host, $this->dbusername, $this->dbpassword, $this->dbname);
		return $con;
	}

}



class query extends database{
	public function getData($table, $field='*',  $condition_arr='', $order_by_field='', $order_by_type='desc', $limit=''){
		$sql = "select $field from $table";

		if($condition_arr != ''){
			$str = ' where ';
			$c = count($condition_arr);
			$i = 1;
			foreach($condition_arr as $key=>$val){
				if($i == $c){
					$str .= "$key = '$val'";
				}else{
					$str .= "$key = '$val' and ";
				}
				$i++;
				
			}
			$sql .= "$str";
		}

		if($order_by_field != ''){
			$sql.= " order by $order_by_field $order_by_type";
		}
		if($limit != ''){
			$sql.=" limit $limit";
		}
		// To check if the sql is ok
		// die($sql);

		$result = $this->connect()->query($sql);

		if($result->num_rows > 0){
			$arr = [];
			while($row = $result->fetch_assoc()){
				$arr[] = $row;
			}
			return $arr;
		}else{
			return 0;
		}
	}

/*
	Using sql dynamically
	select $field from $table where $condition like $like order by $order_by_field $order_by_type limit $limit

	$filed -> * or name or email
	$table -> user
	$condition -> where id='2'
	$like -> 'm%'
	$order_by_field -> name
	$order_by_type -> asc or desc
	$limit -> 1 to any number
 */


	public function insertData($table, $condition_arr){
		

		if($condition_arr!=''){
			foreach($condition_arr as $key=>$val){
				$field_arr[] = $key;
				$value_arr[] = $val; 
			}
			// array to string conversion
			$field = implode(',', $field_arr);
			$value = implode("','", $value_arr);
			$value = "'".$value."'";
		}

		$sql = "insert into $table ($field) values ($value)";
		
		$result = $this->connect()->query($sql);
	}


	public function deleteData($table, $condition_arr){
		

		if($condition_arr != ''){
			$sql = "delete from $table where ";
			$c = count($condition_arr);
			$i = 1;
			foreach($condition_arr as $key=>$val){
				if($i == $c){
					$sql .= "$key = '$val'";
				}else{
					$sql .= "$key = '$val' and ";
				}
				$i++;
				
			}
		}

		$result = $this->connect()->query($sql);
	}



	public function updateData($table, $condition_arr, $where_field, $where_value){
		


		if($condition_arr != ''){
			// update query: update table_name set col1 = val1, col2 = val2, ... where condition;
			$sql = "update $table set ";
			$c = count($condition_arr);
			$i = 1;
			foreach($condition_arr as $key=>$val){
				if($i == $c){
					$sql .= "$key = '$val'";
				}else{
					$sql .= "$key = '$val' , ";
				}
				$i++;
				
			}
			$sql .= " where $where_field = $where_value";
		}

		$result = $this->connect()->query($sql);
	}


	public function get_safe_str($str){
		if($str != ''){
			return mysqli_real_escape_string($this->connect(), $str);
		}
	}

}






 ?>