<?php
$admin = true;

include_once('../connect.php');
$dbh = $connect;

$r_product_select_image = $dbh->prepare('select picture from products where id=:id_produit');

if (isset($_GET['id'])) {
	$id = urldecode($_GET['id']);
	$r_product_select_image->bindParam(':id_produit', $id);
	$r_product_select_image->execute();
	$rep = $r_product_select_image->fetch();
	
	if (isset($rep['picture'])) {
		$img = $rep['picture'];
		$len = strlen($img);
		if ($len > 0) {
			header('Content-Type: image/png');
			header('Content-Length: '.$len);
			header('Cache-Control: private, max-age=600');
			echo $img;
		} else {
			header('HTTP/1.0 404 Not Found');
		}
	} else {
		header('HTTP/1.0 500 Internal Server Error');
	}	
} else {
	header('HTTP/1.0 400 Bad Request');
}
