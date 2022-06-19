<?php
require_once('../config/database.php');
class Product extends Database
{
    function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "connection to database failed : " . mysqli_connect_error();
        }
    }

    function allProduct()
	{
		$data = mysqli_query($this->connection, "SELECT * FROM product");
		return $data;
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

    function addProduct($id, $qty)
	{
		$query = mysqli_query($this->connection, "UPDATE product SET qty=qty+$qty WHERE id=$id ");
	}

    function insertProductLog($id, $qty, $origin,$destination,$status,$op)
	{
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO product_log (product_id,qty,operator,status,log_date,origin,destination) VALUES ('$id','$qty','$op','$status','$date','$origin','$destination')";
		if (!$this->connection->query($query)) {
			echo ("Error description: " . $this->connection->error);
		}
	}

    ////////////////////Model FOR REPORT/////////////////////////////////////
	function productReport($id, $start, $end)
	{
		$query = "SELECT * FROM product_log WHERE status='finished' AND product_id='$id' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

    function ProductionRate($id, $start, $end){
		$query = "SELECT SUM(qty) FROM product_log WHERE status='finished' AND product_id='$id' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT qty FROM product_log WHERE status='finished' AND product_id='$id' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$sum = mysqli_num_rows($data2);
		$product = mysqli_fetch_row($data);
		return $product[0]/$sum;
	}

    function WIPRate($id,$start, $end){
		$query = "SELECT SUM(qty) FROM product_log WHERE status='finished' AND product_id='$id' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM wip_log WHERE status='finished' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$product = mysqli_fetch_row($data);
		$wip = mysqli_fetch_row($data2);
		$rate = $product[0]/$wip[0];
		return $rate;
	}

    function productDefect($id,$start, $end){
		$query = "SELECT SUM(qty) FROM product_log WHERE status='finished' AND product_id='$id' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data = mysqli_query($this->connection, $query);

		$query2 = "SELECT SUM(qty) FROM product_log WHERE status='arrival' AND origin='Workstation 3' AND destination='Production' AND DATE(log_date) BETWEEN '$start' AND '$end' ";
		$data2 = mysqli_query($this->connection, $query2);

		$product = mysqli_fetch_row($data2);
		$ws3 = mysqli_fetch_row($data);
		$defect = $product[0]-$ws3[0];
		return $defect;
	}

    function productValues(){
		$query = "SELECT *,(qty*selling_price) as total,(cogs*qty) as total_cogs,((qty*selling_price)-(cogs*qty)) as margin FROM product";
		$data = mysqli_query($this->connection, $query);
		return $data;
	}

    function totalProductValues(){
		$query = "SELECT sum(qty*selling_price) FROM product";
		$data = mysqli_query($this->connection, $query);
		$total = mysqli_fetch_row($data);
		return $total[0];
	}
}
