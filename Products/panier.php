<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$admin = isset($_SESSION['admin_id']) ? $_SESSION['admin_id']: false;


require_once('products.php');
include_once('../connect.php');
$dbh = $connect;

$panier = &$_SESSION['panier']; // look at panier_clear when changing;

if (! isset($panier))
	$panier = array();


function panier_add($id, $nb) {
	global $panier;
	$found = false;
	
	foreach ($panier as $key => $item) {
		if ($item['id'] == $id) {
			$panier[$key]['nb'] += $nb;
			$found = true;
		}
	}
	if ($found == false)
		$panier[] = array('id' => $id, 'nb' => $nb);
}

function panier_remove($id) {
	global $panier;
	foreach ($panier as $key => $item) {
		if ($item['id'] == $id)
			unset($panier[$key]);
	}
}

function panier_clear() {
	$_SESSION['panier'] = array();
}

function panier_get_products() {
	global $panier;
	$ret = array();
	foreach ($panier as $product) {
		$p = array('product' => product($product['id']),
				   'nb'      => $product['nb']);
		$ret[] = $p;
	}
	return $ret;
}

function panier_get_info() {
	$prod = panier_get_products();
	$ret = array();
	$ret['nb'] = array_reduce($prod, function ($c, $p) {return $c + $p['nb'];}, 0);
	$ret['price'] = array_reduce($prod, function ($c, $p) {return $c + ($p['nb'] * $p['product']['price']);}, 0);
	return $ret;
}

if (isset($_POST['panier_add'])) {
	panier_add((int)$_POST['panier_item_id'], (int)$_POST['panier_qty']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

if (isset($_POST['panier_clear'])) {
	panier_clear();
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
/*
print_r(panier_get_products());
echo '<br/>';
print_r(panier_get_info());
*/
?>
