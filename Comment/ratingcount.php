<?php
	require_once '../connect.php';
	function getCountComment($id)
	{
		global $connect;
		$req = $connect->prepare("SELECT count(*)  as count, avg(rating) as avg FROM ratings where id_products = :id");
		$req->bindParam(":id", $id);
		$req->execute();
		$row = $req->fetch();
		return  $row['count'];
	}
	function getAvgRating($id)
	{
		global $connect;
		$req = $connect->prepare("SELECT avg(rating) as avg FROM ratings where id_products = :id");
		$req->bindParam(":id", $id);
		$req->execute();
		$row = $req->fetch();
		return  round($row['avg']);
	}
	

?>