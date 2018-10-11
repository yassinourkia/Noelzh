<?php
$admin = true;

include_once('../connect.php');
$dbh = $connect;

$r_product_random_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description, p.picture from product p order by rand() limit 4');
$r_product_nocat_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description, p.picture from product p where p.id not in (select id_p from a_product_category)');
$r_product_cat_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description, p.picture from product p inner join a_product_category a on a.id_p=p.id where a.name_c=:cat');
$r_product_insert = $dbh->prepare('insert into product (name, price, quantity, size, description, picture) values (:nom, :prix, :quantite, :taille, :description, :image)');
$r_product_delete = $dbh->prepare('delete from product where id=:id');

function random_products() {
	global $r_product_random_list;
	$r_product_random_list->execute();
	return $r_product_random_list->fetchAll();
}

if ($admin && isset($_POST['nom_produit'])) {
	$nom = $_POST['nom_produit'];
	$prix = (int) $_POST['prix'];
	$taille = $_POST['taille'];
	$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 0;
	$description = trim($_POST['description']);
	$image = file_get_contents ($_FILES['image']['tmp_name']);
	$r_product_insert->bindParam(':nom', $nom);
	$r_product_insert->bindParam(':prix', $prix, PDO::PARAM_INT);
	$r_product_insert->bindParam(':quantite', $quantite);
	$r_product_insert->bindParam(':taille', $taille);
	$r_product_insert->bindParam(':description', $description);
	$r_product_insert->bindParam(':image', $image);
	$r_product_insert->execute();
}

if ($admin && isset($_POST['id_p_supprimer'])) {
	$id = $_POST['id_p_supprimer'];
	$r_product_delete->bindParam(':id', $id);
	$r_product_delete->execute();
}

if (isset($_GET['n'])) {
	$name = urldecode($_GET['n']);
	$r_product_cat_list->bindParam(':cat', $name);
	$r_product_cat_list->execute();
	$products = $r_product_cat_list->fetchAll();
} else {
	$r_product_nocat_list->execute();
	$products = $r_product_nocat_list->fetchAll();
}
?>
