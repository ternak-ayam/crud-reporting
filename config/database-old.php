<?php
class database
{

	var $host = "mysql";
	var $username = "root";
	var $password = "root";
	var $database = "apsi2022_noob_rev";
	var $connection = "";

	function __construct()
	{
		$this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		if (mysqli_connect_errno()) {
			echo "connection to database failed : " . mysqli_connect_error();
		}
	}

	function checkLogin($user, $pass)
	{
		$data = mysqli_query($this->connection, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
		return mysqli_num_rows($data);
	}

	function findUser($user, $pass)
	{
		$query = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
		$data = mysqli_query($this->connection, $query);
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
		return mysqli_fetch_assoc($data);
	}

	function allProduct()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM product");
		return $data;
	}

	function allWIP()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM wip");
		return $data;
	}

	function allMaterial()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM raw_material");
		return $data;
	}

	function showRawMaterial()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM raw_material");
		while ($row = mysqli_fetch_array($data)) {
			$hasil[] = $row;
		}
		return $hasil;
	}

	function addMaterial($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE raw_material SET qty=qty+$qty WHERE id=$id ");
	}

	function sendMaterial($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE raw_material SET qty=qty-$qty WHERE id=$id ");
	}

	function insertProduct($name, $qty, $cogs, $sp)
	{
		$query = "insert into product (name,qty,cogs,selling_price) values('$name',$qty,$cogs,$sp)";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function getProduct($id)
	{
		$query = "SELECT * FROM product WHERE id='$id' ";
		$data = mysqli_query($this->connection, $query);
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
		return mysqli_fetch_assoc($data);
	}

	function editProduct($id, $name, $qty, $cogs, $sp)
	{
		$query = mysqli_query($this->connection, "UPDATE product SET qty=$qty,name='$name',cogs=$cogs,selling_price=$sp WHERE id=$id ");
	}

	function deleteProduct($id)
	{
		$query = mysqli_query($this->connection, "DELETE FROM product WHERE id=$id ");
	}

	function insertWIP($name, $qty)
	{
		$query = "insert into wip (name,qty) values('$name',$qty)";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function insertWIPDetail($id, $material_id, $qty)
	{
		$query = "insert into wip_detail (wip_id,raw_material_id,qty) values($id,$material_id,$qty)";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function editWIPDetail($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE wip_detail SET qty=$qty WHERE id=$id ");
	}

	function editWIP($id, $name, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE wip SET qty=$qty,name='$name' WHERE id=$id ");
	}

	function deleteWIP($id)
	{
		$query = mysqli_query($this->connection, "DELETE FROM wip WHERE id=$id ");
	}

	function deleteWIPDetail($id)
	{
		$query = mysqli_query($this->connection, "DELETE FROM wip_detail WHERE id=$id ");
	}

	function getWIP($id)
	{
		$query = "SELECT * FROM wip WHERE id='$id' ";
		$data = mysqli_query($this->connection, $query);
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
		return mysqli_fetch_assoc($data);
	}

	function getWIPDetail($id)
	{
		$query = "SELECT * FROM wip_detail WHERE id='$id' ";
		$data = mysqli_query($this->connection, $query);
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
		return mysqli_fetch_assoc($data);
	}

	function insertMaterial($name, $qty, $price)
	{
		$query = "insert into raw_material (name,qty,price) values('$name',$qty,$price)";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function getMaterial($id)
	{
		$query = "SELECT * FROM raw_material WHERE id='$id' ";
		$data = mysqli_query($this->connection, $query);
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
		return mysqli_fetch_assoc($data);
	}

	function editMaterial($id, $name, $qty, $price)
	{
		$query = mysqli_query($this->connection, "UPDATE raw_material SET qty=$qty,name='$name',price=$price WHERE id=$id ");
	}

	function deleteMaterial($id)
	{
		$query = mysqli_query($this->connection, "DELETE FROM raw_material WHERE id=$id ");
	}

	function insertMaterialLog($id, $qty, $op, $status)
	{
		$date = date("Y-m-d H:i:s");
		$query = "insert into raw_material_log (raw_material_id,qty,operator_name,status,trans_date) values($id,$qty,'$op','$status','$date')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function insertWorkstationArrival($id, $ws, $qty, $op)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO ws_arrival (workstation,raw_material_id,qty,trans_date,operator_name) VALUES ('$ws',$id,$qty,'$date','$op')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}
	function insertWorkstationWIP($id, $ws, $qty, $op)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO ws_wip (workstation,wip_id,qty,trans_date,operator_name) VALUES ('$ws',$id,$qty,'$date','$op')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function insertWorkstationDeparture($id, $ws, $qty, $op)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO ws_departure (workstation,product_id,qty,trans_date,operator_name) VALUES ('$ws',$id,$qty,'$date','$op')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	function addWIP($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE wip SET qty=qty+$qty WHERE id=$id ");
	}

	function addProduct($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE product SET qty=qty+$qty WHERE id=$id ");
	}
	function sendProduct($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE product SET qty=qty-$qty WHERE id=$id ");
	}

	function detailWIP($id = null)
	{
		if ($id == null) {
			$query = "SELECT a.*,b.name as wip_name,c.name as material_name FROM wip_detail a JOIN wip b ON a.wip_id=b.id JOIN raw_material c ON a.raw_material_id=c.id";
		} else {
			$query = "SELECT a.*,b.name as wip_name,c.name as material_name FROM wip_detail a JOIN wip b ON a.wip_id=b.id JOIN raw_material c ON a.raw_material_id=c.id WHERE a.wip_id=$id ";
		}
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

	function insertProductArrival($id, $qty, $op)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO product_log (product_id,qty,operator_name,status,trans_date) VALUES ('$id','$qty','$op','arrival','$date')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}
	function insertProductDeparture($id, $qty, $op)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO product_log (product_id,qty,operator_name,status,trans_date) VALUES ('$id','$qty','$op','departure','$date')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	////////////////////Model FOR REPORT/////////////////////////////////////
	function productReport($id, $start, $end)
	{
		$query = "SELECT * FROM product_log WHERE status='arrival' AND product_id='$id' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

	function ProductionRate($id, $start, $end){
		$query = "SELECT SUM(qty) FROM product_log WHERE status='arrival' AND product_id='$id' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT qty FROM product_log WHERE status='arrival' AND product_id='$id' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$sum = mysqli_num_rows($data2);
		$product = mysqli_fetch_row($data);
		return $product[0]/$sum;
	}

	function WIPRate($id,$start, $end){
		$query = "SELECT SUM(qty) FROM product_log WHERE status='arrival' AND product_id='$id' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM ws_wip WHERE DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$product = mysqli_fetch_row($data);
		$wip = mysqli_fetch_row($data2);
		$rate = $product[0]/$wip[0];
		return $rate;
	}

	function productDefect($id,$start, $end){
		$query = "SELECT SUM(qty) FROM product_log WHERE status='arrival' AND product_id='$id' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS3' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$product = mysqli_fetch_row($data);
		$ws3 = mysqli_fetch_row($data2);
		$defect = $product[0]-$ws3[0];
		return $defect;
	}

	// function WS1Defect($id,$start, $end){
	// 	$query = "SELECT SUM(qty) FROM product_log WHERE status='arrival' AND product_id='$id' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
	// 	$data = mysqli_query($this->connection, $query);

	// 	$query2 = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS1' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
	// 	$data2 = mysqli_query($this->connection, $query);

	// 	$query3 = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS2' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
	// 	$data3 = mysqli_query($this->connection, $query);

	// 	$query4 = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS3' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
	// 	$data4 = mysqli_query($this->connection, $query);

	// 	$product = mysqli_fetch_row($data);
	// 	$ws1 = mysqli_fetch_row($data2);
	// 	$ws3 = mysqli_fetch_row($data3);
	// 	$ws3 = mysqli_fetch_row($data4);
	// }

	function WS2Defect($start, $end){
		$query = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS1' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS2' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);


		$ws1 = mysqli_fetch_row($data);
		$ws2 = mysqli_fetch_row($data2);
		$defect = $ws2[0]-$ws1[0];
		return $defect;
	}

	function WS3Defect($start, $end){
		$query = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS2' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM ws_wip WHERE workstation='WS3' AND DATE(trans_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$ws2 = mysqli_fetch_row($data);
		$ws3 = mysqli_fetch_row($data2);
		$defect = $ws3[0]-$ws2[0];
		return $defect;
	}

	function totalInventoryValues(){
		$query = "SELECT *,(qty*price) as total FROM raw_material";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

	function totalProductValues(){
		$query = "SELECT *,(qty*selling_price) as total,(cogs*qty) as total_cogs,((qty*selling_price)-(cogs*qty)) as margin FROM product";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}
}
