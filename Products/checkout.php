<?php 
include_once('panier.php');
include_once('../connect.php');
$dbh = $connect;

/**
 * (Temporary) Directly transfer a panier to an order
 */
function buy_panier() {
	global $dbh;
	$panier = panier_get();
	$panier_info = panier_get_info();
	if (count($panier) == 0) {
		echo 'pas de transaction pour vous.';
		return;
	}
	$dbh->beginTransaction();
	try {
		$r_order = $dbh->prepare('insert into orders (id_users, amount) values (:user_id, :amount)');
		$user_id = $_SESSION['user_id'];
		$panier_price = $panier_info['price'];
		$r_order->bindParam(':user_id', $user_id);
		$r_order->bindParam(':amount', $panier_price);
		$r_order->execute();
		$order_id = $dbh->lastInsertId();
		
		$r_order_add_item = $dbh->prepare('insert into a_products_orders (id_orders, id_products, quantity) values (:id_o, :id_p, :qty)');
		$r_product_qty_dec = $dbh->prepare('update products set quantity = quantity - :qty where id = :id_p');
		$r_product_qty_check = $dbh->prepare('select quantity from products where id = :id_p');

		$erreur = false;
		foreach ($panier as $p) {
			$p_product = $p['id'];
			$p_qty = $p['nb'];
			$r_order_add_item->bindParam('id_p', $p_product);
			$r_order_add_item->bindParam('id_o', $order_id);
			$r_order_add_item->bindParam('qty', $p_qty);
			$r_order_add_item->execute();
			$r_product_qty_dec->bindParam('id_p', $p_product);
			$r_product_qty_dec->bindParam('qty', $p_qty);
			$r_product_qty_dec->execute();
			$r_product_qty_check->bindParam('id_p', $p_product);
			$r_product_qty_check->execute();
			$qty = $r_product_qty_check->fetch()['quantity'];
			if ($qty < 0) {
				echo 'Le produit '.htmlspecialchars($p_product).' n\'est plus disponible en quantitée suffisante<br/>';
				echo 'Il en reste '.($p_qty + $qty).'<br/>';
				$erreur = true;
			}
		}
		if ($erreur && $dbh->inTransaction())
			$dbh->rollBack();
		if ($dbh->inTransaction() && $dbh->commit()) {
			panier_clear();
			echo 'La transaction a été enregistrée';
		} else {
			echo 'La transaction a échouée, votre commande est annulée<br/>';
		}
	} catch(Eception $e) {
		$dbh->rollBack();
	}
}

/**
 * (Temporary) Path to buy everything
 */
if (isset($_SESSION['user_id']) && isset($_GET['buy'])) {
	buy_panier();
}
?>