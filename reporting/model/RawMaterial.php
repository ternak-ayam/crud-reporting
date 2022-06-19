<?php
require_once('../config/database.php');
class RawMaterial extends Database
{
	function __construct()
	{
		$this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		if (mysqli_connect_errno()) {
			echo "connection to database failed : " . mysqli_connect_error();
		}
	}

	function allRawMaterial()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM raw_material");
		return $data;
	}

	function insertRawMaterial($name, $qty, $price)
	{
		$query = "insert into raw_material (name,qty,price) values('$name',$qty,$price)";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function getRawMaterial($id)
	{
		$query = "SELECT * FROM raw_material WHERE id='$id' ";
		$data = mysqli_query($this->connection, $query);
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
		return mysqli_fetch_assoc($data);
	}

	function editRawMaterial($id, $name, $qty, $price)
	{
		$query = mysqli_query($this->connection, "UPDATE raw_material SET qty=$qty,name='$name',price=$price WHERE id=$id ");
	}

	function deleteRawMaterial($id)
	{
		$query = mysqli_query($this->connection, "DELETE FROM raw_material WHERE id=$id ");
	}

	function addRawMaterial($id, $qty)
	{
		$query="UPDATE raw_material SET qty=qty+$qty WHERE id=$id ";
		$data = mysqli_query($this->connection, $query);
	}

	function sendRawMaterial($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE raw_material SET qty=qty-$qty WHERE id=$id ");
	}

	function insertRawMaterialLog($id, $qty, $op,$origin,$destination, $status)
	{
		$date = date("Y-m-d H:i:s");
		$query = "insert into raw_material_log (raw_material_id,qty,operator,status,log_date,origin,destination) values($id,$qty,'$op','$status','$date','$origin','$destination')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function rawMaterialValues(){
		$query = "SELECT *,(qty*price) as total FROM raw_material";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

	function totalRawMaterialValues(){
		$query = "SELECT sum(qty*price) as total FROM raw_material";
		$data = mysqli_query($this->connection, $query);
		$total = mysqli_fetch_row($data);
		return $total[0];
	}
}
