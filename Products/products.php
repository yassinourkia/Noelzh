<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin = isset($_SESSION['admin_id']) ? $_SESSION['admin_id']: false;

require_once('groups.php');

include_once('../connect.php');
require_once('../web/csrf.php');
$dbh = $connect;


/**
 * Create a list of random products
 * 
 * @param nb number of products to select
 * @return an array [[0] -> ['name'->'Truc', 'price'->'24.3', 'quantity'->'4', size->'M', 'descritpion'->'Mon ...'], ...]
 */
function random_products($nb = 4) {
	global $dbh;
	$r_product_random_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description from products p where p.quantity >= 0 order by rand() limit :nb');
	$r_product_random_list->bindParam(':nb', $nb);
	$r_product_random_list->execute();
	return $r_product_random_list->fetchAll();
}

/**
 * Get a particular product
 * 
 * @param id product id 
 * @return  an array ['name'->'Truc', 'price'->'24.3', 'quantity'->'4', size->'M', 'descritpion'->'Mon ...']
 */
function product($id) {
	global $dbh;
	$r_product_select = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description from products p where p.id=:id_produit');
	$r_product_select->bindParam(':id_produit', $id, PDO::PARAM_INT);
	$r_product_select->execute();
	return $r_product_select->fetch();
}


/**
 * Path to add a new product
 */
if ($admin && isset($_POST['nom_produit']) && !isset($_POST['mod_id'])) {
	$r_product_insert = $dbh->prepare('insert into products (name, price, quantity, size, description, picture) values (:nom, :prix, :quantite, :taille, :description, :image)');
	$nom = $_POST['nom_produit'];
	$prix = (int) $_POST['prix'];
	$taille = $_POST['taille'];
	$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 1;
	$description = trim($_POST['description']);
	$image = file_get_contents ($_FILES['image']['tmp_name']);
	if($prix <= 0 || $quantite <= 0) 
		exit("Prix ou Quantité negatif ");
	$r_product_insert->bindParam(':nom', $nom);
	$r_product_insert->bindParam(':prix', $prix, PDO::PARAM_INT);
	$r_product_insert->bindParam(':quantite', $quantite);
	$r_product_insert->bindParam(':taille', $taille);
	$r_product_insert->bindParam(':description', $description);
	$r_product_insert->bindParam(':image', $image);
	$r_product_insert->execute();
	$p_id = $dbh->lastInsertId();
	
	if (isset($_POST['group'])) { // Adding the product to categories
		$r_product_add_cat = $dbh->prepare('insert into a_products_categories (id_categories, id_products) values ((select id from categories where name=:cat_name limit 1), :id_produit)');
		$cat = $_POST['group'];
		foreach ($cat as $cat_name) {
			$cn = urldecode($cat_name);
			$r_product_add_cat->bindParam(':cat_name', $cn);
			$r_product_add_cat->bindParam(':id_produit', $p_id);
			$r_product_add_cat->execute();
		}
	}
}

/**
 * Path to modify a product
 * The image is optional
 */
if ($admin && isset($_POST['nom_produit']) && isset($_POST['mod_id'])) {
	if (! check_csrf_token($_POST)) exit("csrf");
	$r_product_update = $dbh->prepare('update products set name=:nom, price=:prix, quantity=:quantite, size=:taille, description=:description, picture=:image where id=:pid');
	$r_product_update_nopic = $dbh->prepare('update products set name=:nom, price=:prix, quantity=:quantite, size=:taille, description=:description where id=:pid');
	$id = $_POST['mod_id'];
	$nom = $_POST['nom_produit'];
	$prix = (int) $_POST['prix'];
	$taille = $_POST['taille'];
	$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 1;
	$description = trim($_POST['description']);
	$prev_cat = get_categories($id);
	if($prix <= 0 || $quantite <= 0) 
		exit("Prix ou Quantité negatif ");
	if (! isset($_FILES['image']) or $_FILES['image']['tmp_name'] == '') {
		$req = $r_product_update_nopic;
	} else {
		$image = file_get_contents ($_FILES['image']['tmp_name']);
		$req = $r_product_update;
		$req->bindParam(':image', $image);	
	}
	
	$req->bindParam(':pid', $id);
	$req->bindParam(':nom', $nom);
	$req->bindParam(':prix', $prix, PDO::PARAM_INT);
	$req->bindParam(':quantite', $quantite);
	$req->bindParam(':taille', $taille);
	$req->bindParam(':description', $description);
	$req->execute();
	
	$cat = isset($_POST['group'])?$_POST['group']:array();
	$cat = array_map('urldecode', $cat);
	foreach (array_diff($cat, $prev_cat) as $cat_name) {
			$r_product_add_cat = $dbh->prepare('insert into a_products_categories (id_categories, id_products) values ((select id from categories where name=:cat_name limit 1), :id_produit)');
			$cn = $cat_name;
			$r_product_add_cat->bindParam(':cat_name', $cn);
			$r_product_add_cat->bindParam(':id_produit', $id);
			$r_product_add_cat->execute();
	}
	foreach (array_diff($prev_cat, $cat) as $cat_name) {
			$r_product_rem_cat = $dbh->prepare('delete from a_products_categories where id_categories = (select id from categories where name=:cat_name limit 1) and id_products=:id_produit');
			$cn = $cat_name;
			$r_product_rem_cat->bindParam(':cat_name', $cn);
			$r_product_rem_cat->bindParam(':id_produit', $id);
			$r_product_rem_cat->execute();
	}
	
}

/**
 * Path to delete a product
 */
if ($admin && isset($_POST['id_p_supprimer'])) {
	if (! check_csrf_token($_POST)) exit("csrf");
	$r_product_rem_cat = $dbh->prepare('delete from a_products_categories where id_categories = (select id from categories where name=:cat_name limit 1) and id_products=:id_produit');
	$id = $_POST['id_p_supprimer'];
	$prev_cat = get_categories($id);

	foreach ($prev_cat as $cat_name) { // removing the product from its categories
			$cn = $cat_name;
			$r_product_rem_cat->bindParam(':cat_name', $cn);
			$r_product_rem_cat->bindParam(':id_produit', $id);
			$r_product_rem_cat->execute();
	}
	try { // try to delete the product
		$r_product_delete = $dbh->prepare('delete from products where id=:id');
		$r_product_delete->bindParam(':id', $id);
		$r_product_delete->execute();
	} catch (Exception $e) { // The product cannot be deleted, making it unavailable
		$r_product_unavailable = $dbh->prepare('update products set quantity=-1 where id=:id');
		$r_product_unavailable->bindParam(':id', $id);
		$r_product_unavailable->execute();
	}
}

if (isset($_GET['n'])) {
	$r_product_cat_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description from products p inner join a_products_categories a on a.id_products=p.id inner join categories c on c.id=a.id_categories where c.name=:cat and p.quantity >= 0');
	$name = urldecode($_GET['n']);
	$r_product_cat_list->bindParam(':cat', $name);
	$r_product_cat_list->execute();
	$products = $r_product_cat_list->fetchAll();
} else {
	$r_product_nocat_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description from products p where p.quantity >= 0  and p.id not in (select id_products from a_products_categories)');
	$r_product_nocat_list->execute();
	$products = $r_product_nocat_list->fetchAll();
}
?>
