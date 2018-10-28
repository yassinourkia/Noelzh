<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin = isset($_SESSION['admin_id']) ? $_SESSION['admin_id']: false;

include_once('../connect.php');
$dbh = $connect;

$r_categorie_list = $dbh->prepare('select c.name, count(id_products) as n_members from a_products_categories a right join categories c on c.id=a.id_categories group by c.name');


/**
 * Get the categories of a product
 * 
 * @param id a product id (int)
 * @return an array ['cat1', 'cat2', ...]
 */
function get_categories($id) {
	global $dbh;
	$r_categorie_list_for_product = $dbh->prepare('select c.name from a_products_categories a inner join categories c on c.id=a.id_categories where a.id_products=:id');
	$r_categorie_list_for_product->bindParam(':id', $id);
	$r_categorie_list_for_product->execute();
	return array_keys($r_categorie_list_for_product->fetchAll(PDO::FETCH_GROUP));
}

/**
 * Get all categories
 *
 * @return an array ['cat1', 'cat1subcat1', 'cat1subcat2', ...]
 */
function get_raw_categories() {
	global $r_categorie_list;
	$r_categorie_list->execute();
	return $r_categorie_list->fetchAll();
}

/**
 * Get all categories in a tree representation
 * 
 * @return an array ['cat1' -> ['subcat1', 'subcat2'], 'cat2' -> [], ...]
 */
function get_header_categories() {
	global $r_categorie_list;
	$r_categorie_list->execute();
	$groups_raw = $r_categorie_list->fetchAll();

	$groups = [];

	foreach ($groups_raw as $gr) {
		$cal = explode('§', $gr['name']);
		if (count($cal) == 2){
			if (! isset($groups[$cal[0]]))
				$groups[$cal[0]] = array();
			array_push($groups[$cal[0]], $cal[1]);
		} else {
			if (! isset($groups[$cal[0]]))
				$groups[$cal[0]] = array();
		}
	}
	return $groups;
}

/**
 * Path to delete a category
 */
if ($admin && isset($_POST['nom_supprimer'])) {
	$r_categorie_delete = $dbh->prepare('delete from categories where name=:nom');
	$nom = base64_decode($_POST['nom_supprimer']);
	$r_categorie_delete->bindParam(':nom', $nom);
	$res = $r_categorie_delete->execute();
	if (! $res) {
		echo 'Impossible de supprimer '.$nom;
	} else {
		echo 'Supprimer '.$nom;
		header('Location: ../web');
	}
}

/**
 * Path to add a category
 */
if ($admin && isset($_POST['nom_ajout'])) {
	$r_categorie_insert = $dbh->prepare('insert into categories (name) values (:nom)');
	$nom = $_POST['nom_ajout'];
	$r_categorie_insert->bindParam(':nom', $nom);
	$r_categorie_insert->execute();
	header('Location: ../web');
}
?>
