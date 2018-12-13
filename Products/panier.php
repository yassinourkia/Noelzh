<?php
/**
 * This file define functions and paths to deal with the panier fonctionality.
 * The panier is stored in a php session, it is available for every user (authentificated or not).
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../Products/products.php');
include_once('../connect.php');
require_once('../web/csrf.php');
$dbh = $connect;

$panier = &$_SESSION['panier']; // look at panier_clear when changing;
$panier_items_cache = &$_SESSION['panier_items_cache'];

if (! isset($panier))
	$panier = array();

if (! isset($panier_items_cache))
	$panier_items_cache = array('time' => 0, 'data' => array());

/**
 * Add a product to the panier
 * if the product is already in the panier, increase the number of product
 * 
 * @param id the id of the product to add
 * @param nb how many product to add
 */
function panier_add($id, $nb=1) {
	global $panier;
	global $panier_items_cache;
	$found = false;
	
	foreach ($panier as $key => $item) {
		if ($item['id'] == $id) {
			$panier[$key]['nb'] += $nb;
			$found = true;
		}
	}
	if ($found == false)
		$panier[] = array('id' => $id, 'nb' => $nb);
	
	$panier_items_cache['time'] = 0; // invalidate the cache
}

/**
 * Remove a product from the panier
 * 
 * @param id the id of the product to remove
 */
function panier_remove($id) {
	global $panier;
	global $panier_items_cache;
	foreach ($panier as $key => $item) {
		if ($item['id'] == $id)
			unset($panier[$key]);
	}
	$panier_items_cache['time'] = 0; // invalidate the cache
}

/**
 * Remove every product from the panier.
 */
function panier_clear() {
	global $panier_items_cache;
	$_SESSION['panier'] = array();
	$panier_items_cache['time'] = 0; // invalidate the cache
}

/**
 * Get the list of product id in the panier
 * 
 * @return an array [[['id'] => 1 , ['nb'] => 4], ...]
 */
function panier_get() {
	global $panier;
	return $panier;
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
 * Get the list of products in the panier, from the cache
 * The cache is in the session an is valid for 15 minutes.
 * It is invalidated by add, del, clear actions on the panier.
 *
 * @return an array [[['product'] -> ['id' -> 1, 'name'-> 'toto', ...], ['nb'] -> 2], ...]
 */
function panier_get_products_cached() {
	global $panier_items_cache;
	if ($panier_items_cache['time'] + 900 <= time()) {//invalid
		$panier_items_cache['data'] = panier_get_products();
		$panier_items_cache['time'] = time();
	}
	return $panier_items_cache['data'];
}

/**
 * Get the total price and the number of items in the panier.
 *
 * @return an array ['nb' -> 3, 'price' -> 45]
 */
function panier_get_info($cache=true) {
	if ($cache) {
		$prod = panier_get_products_cached();
	} else {
		$prod = panier_get_products();
	}
	$ret = array();
	$ret['nb'] = array_reduce($prod, function ($c, $p) {return $c + $p['nb'];}, 0);
	$ret['price'] = array_reduce($prod, function ($c, $p) {return $c + ($p['nb'] * $p['product']['price']);}, 0);
	return $ret;
}

/**
 * Path to add an item to the panier
 */
if (isset($_POST['panier_add'])) {
	if (! check_csrf_token($_POST)) exit("csrf");
	panier_add((int)$_POST['panier_item_id'], (int)$_POST['panier_qty']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

/**
 * Path to remove an item from the panier
 */
if (isset($_POST['panier_remove'])) {
	if (! check_csrf_token($_POST)) exit("csrf");
	panier_remove((int)$_POST['panier_item_id']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

/**
 * Path to clear all item from the panier
 */
if (isset($_POST['panier_clear'])) {
	if (! check_csrf_token($_POST)) exit("csrf");
	panier_clear();
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
?>
