<?php
/**
 * This file define functions and paths to deal with the panier fonctionality.
 * The panier is stored in a php session, it is available for every user (authentificated or not).
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('products.php');
include_once('../connect.php');
$dbh = $connect;

$panier = &$_SESSION['panier']; // look at panier_clear when changing;

if (! isset($panier))
	$panier = array();


/**
 * Add a product to the panier
 * if the product is already in the panier, increase the number of product
 * 
 * @param id the id of the product to add
 * @param nb how many product to add
 */
function panier_add($id, $nb=1) {
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

/**
 * Remove a product from the panier
 * 
 * @param id the id of the product to remove
 */
function panier_remove($id) {
	global $panier;
	foreach ($panier as $key => $item) {
		if ($item['id'] == $id)
			unset($panier[$key]);
	}
}

/**
 * Remove every product from the panier.
 */
function panier_clear() {
	$_SESSION['panier'] = array();
}

/**
 * Get the list of products in the panier.
 *
 * @return an array [[['product'] -> ['id' -> 1, 'name'-> 'toto', ...], ['nb'] -> 2], ...]
 */
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

/**
 * Get the total price and the number of items in the panier.
 *
 * @return an array ['nb' -> 3, 'price' -> 45]
 */
function panier_get_info() {
	$prod = panier_get_products();
	$ret = array();
	$ret['nb'] = array_reduce($prod, function ($c, $p) {return $c + $p['nb'];}, 0);
	$ret['price'] = array_reduce($prod, function ($c, $p) {return $c + ($p['nb'] * $p['product']['price']);}, 0);
	return $ret;
}

/**
 * Path to add an item to the panier
 */
if (isset($_POST['panier_add'])) {
	panier_add((int)$_POST['panier_item_id'], (int)$_POST['panier_qty']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

/**
 * Path to remove an item from the panier
 */
if (isset($_POST['panier_remove'])) {
	panier_remove((int)$_POST['panier_item_id']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

/**
 * Path to clear all item from the panier
 */
if (isset($_POST['panier_clear'])) {
	panier_clear();
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
?>
