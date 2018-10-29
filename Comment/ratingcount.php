<?php
	require_once '../connect.php';
	function getCountComment($id)
	{
		global $connect;
		$stmt = $connect->query("SELECT count(*)  as count, avg(rating) as avg FROM ratings where id_products = ".$id);
		$row = $stmt->fetch();
		return  $row['count'];
	}
	function getAvgRating($id)
	{
		global $connect;
		$stmt = $connect->query("SELECT avg(rating) as avg FROM ratings where id_products = ".$id);
		$row = $stmt->fetch();
		return  round($row['avg']);
	}
	

?>