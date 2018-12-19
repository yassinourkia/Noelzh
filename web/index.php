<?php
require_once('header.php');
require_once('../Products/products.php');
?>
	<!--banner-->
	<div class="banner">
		<div class="container">
			<div class="banner-text">			
				<div class="col-sm-5 banner-left wow fadeInLeft animated" data-wow-delay=".5s">			
					<h2>Notre collection</h2>
					<h3>Bientôt</h3>
					<h4>Nos nouveautés</h4>
					<div class="count main-row">
						<ul id="example">
							<li><span class="hours">00</span><p class="hours_text">Heures</p></li>
							<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
							<li><span class="seconds">00</span><p class="seconds_text">Secondes</p></li>
						</ul>
							<div class="clearfix"> </div>
							<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
							<script type="text/javascript">
								$('#example').countdown({
									date: '12/24/2020 15:59:59',
									offset: -8,
									day: 'Day',
									days: 'Days'
								}, function () {
									alert('Done!');
								});
							</script>
					</div>

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>			
	<!--//banner-->
	<!--gallery-->
	<div class="gallery">
		<div class="container">
			<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
				<h3 class="title">Nos<span> suggestions</span></h3>
				<p>Une collection des meilleurs produits pour Noël</p>
			</div>
			
			<div class="gallery-info">
				<?php foreach (random_products() as $num => $p) : ?>
				<div class="col-md-3 gallery-grid gallery-grid<?php if ($num > 0){ echo $num; }?> wow flipInY animated" data-wow-delay=".5s">
					<a href="single.php?pid=<?=$p['id']?>"><img src="../Products/image.php?id=<?=urlencode($p['id'])?>" class="img-responsive"/></a>
					<div class="gallery-text simpleCart_shelfItem">
						<h5><a class="name" href="single.php?pid=<?=$p['id']?>"><?=htmlspecialchars($p['name'], ENT_QUOTES)?></a></h5>
						<p><span class="item_price"><?=htmlspecialchars($p['price'], ENT_QUOTES)?> €</span></p>
						<h4 class="sizes">Taille: <a href="#"><?=htmlspecialchars($p['size'], ENT_QUOTES)?></a> </h4>
						<ul>
							<li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li>
							<li><a class="item_add" href="#"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
							<li><a href="#"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--//gallery-->
<?php
require_once('footer.php');
?>
