<?php
require_once('header.php');
require_once('../Products/panier.php');

$pan = panier_get_info();
$pan_products = panier_get_products();
$logged = isset($_SESSION['user_id']);
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active">Panier</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--cart-items-->
	<div class="cart-items">
		<div class="container">
			<h3 class="wow fadeInUp animated" data-wow-delay=".5s">Mon Panier  (<?=$pan['nb']?>)</h3>
			<?php foreach ($pan_products as $item): ?> 
			<div class="cart-header wow fadeInUp animated" data-wow-delay=".5s">
				<form method="post" action="../Products/panier.php">
					<input type="hidden" name="panier_item_id" value="<?=urlencode($item['product']['id'])?>">
					<input type="submit" name="panier_remove" class="alert-close" value=""/>
				</form>
				<div class="cart-sec simpleCart_shelfItem">
					<div class="cart-item cyc">
						<a href="single.php?pid=<?=$item['product']['id']?>"><img src="../Products/image.php?id=<?=urlencode($item['product']['id'])?>" class="img-responsive"/></a>
					</div>
					<div class="cart-item-info">
						<h4><a href="single.php?pid=<?=$item['product']['id']?>"><?=$item['product']['name']?></a></h4>
						<ul class="qty">
							<li><p>Prix unitaire: <?=$item['product']['price']?> €</p></li>
							<li><p>Quantité : <?=$item['nb']?></p></li>
							<li><p>Livraison GRATUITE</p></li>
						</ul>
						<h4><span>Prix: <?=$item['product']['price'] * $item['nb']?> €</span></h4>
						<div class="delivery">
							<span>Livrer dans la semaine</span>
							<div class="clearfix"></div>
						</div>	
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php endforeach; ?>
			<?php if (count($pan_products) == 0): ?>
				<h4>Votre panier est vide</h4>
			<?php else: ?>
			<div class="fadeInUp animated" data-wow-delay=".5s">
				<h3><span>Prix total: <?=$pan['price']?> €</span></h3>
				<input class="btn btn-info" value="Passer commande" <?=$logged ? '':'disabled'?>/>
				<?php if (! $logged){ echo '<span>Créez vous un compte ou connectez vous pour passer commande</span>'; } ?>
			</div>
			<?php endif;?>
		</div>
	</div>
	<!--//cart-items-->	
<?php
require_once('footer.php');
?>
