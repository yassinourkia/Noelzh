<?php
	require_once '../connect.php';
	$stmt2 = $connect->query("SELECT count(*)  as count FROM ratings  ");
		$row = $stmt2->fetch();
		echo $row['count'];
?>