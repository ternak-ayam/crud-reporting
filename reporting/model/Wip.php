<?php
require_once('../config/database.php');
class WIP extends Database
{
    function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "connection to database failed : " . mysqli_connect_error();
        }
    }

    function allWIP()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM wip");
		return $data;
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

	function addWIP($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE wip SET qty=qty+$qty WHERE id=$id ");
	}

	function sendWIP($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE wip SET qty=qty-$qty WHERE id=$id ");
	}

	function insertWIPLog($id, $qty,$op, $origin,$destination,$status)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO wip_log (wip_id,qty,operator,status,log_date,origin,destination) VALUES ('$id','$qty','$op','$status','$date','$origin','$destination')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

	////////////////////Model FOR REPORT/////////////////////////////////////
	function WIPReport($start, $end)
	{
		$query = "SELECT * FROM wip_log WHERE status='finished' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

	function WIPDefectWS1($start, $end){
		$query = "SELECT SUM(qty) FROM wip_log WHERE status='finished' AND origin='Workstation 1' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM wip_log WHERE status='arrival' AND origin='Workstation 1' AND destination='Workstation 3' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$product = mysqli_fetch_row($data2);
		$ws3 = mysqli_fetch_row($data);
		$defect = $product[0]-$ws3[0];
		return $defect;
	}

	function WIPDefectWS2($start, $end){
		$query = "SELECT SUM(qty) FROM wip_log WHERE status='finished' AND origin='Workstation 2' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM wip_log WHERE status='arrival' AND origin='Workstation 2' AND destination='Workstation 3' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$product = mysqli_fetch_row($data2);
		$ws3 = mysqli_fetch_row($data);
		$defect = $product[0]-$ws3[0];
		return $defect;
	}

}
