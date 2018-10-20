<?php
require_once('header.php');
require('../Products/products.php');
require('../Products/groups.php');
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active">Produits</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-9 product-model-sec">
	<?php foreach ($products as $key => $product): ?>
				<div class="product-grids <?php if (($key+1) % 3 == 2) echo 'product-grids-mdl'; ?> simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".5s">
					<div class="new-top">
						<a href="single.php?pid=<?=$product['id']?>"><img src="../Products/image.php?id=<?=urlencode($product['id'])?>" class="img-responsive"/></a>
						<div class="new-text">
							<ul>
								<li><a href="single.php?pid=<?=$product['id']?>">Voir les details </a></li>
								<li><input type="number" class="item_quantity" min="1" value="1"></li>
								<li><a class="item_add" href="">Ajouter au chariot</a></li>
							</ul>
						</div>
					</div>
					<div class="new-bottom">
						<h5><a class="name" href="single.php?pid=<?=$product['id']?>"><?=htmlspecialchars($product['name'])?></a></h5>
						<div class="rating">
							<span class="on">☆</span>
							<span class="on">☆</span>
							<span class="on">☆</span>
							<span class="on">☆</span>
							<span>☆</span>
						</div>
						<div class="ofr">
							<p><span class="item_size"><?=htmlspecialchars($product['size'])?></span></p>
							<p><span class="item_price"><?=htmlspecialchars($product['price'])?> €</span></p>
							<?php if ($admin): ?>
								<form method="post">
									<input type="hidden" name="id_p_supprimer" value="<?=$product['id']?>"/>
									<input type="submit" class="btn btn-danger" value="X"/>
							</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
	<?php endforeach; ?>
			</div>
			<div class="col-md-3 rsidebar">
				<div class="rsidebar-top">
					<div class="slider-left">
						<h4>Filter par prix</h4>
						<input type="text" id="amount"/>
						<div id="slider-range"></div>
						<!---->
						<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range" ).slider({
										range: true,
										min: 0,
										max: 100,
										values: [ 0, 100 ],
										slide: function( event, ui ) {  $( "#amount" ).val( "€" + ui.values[ 0 ] + " - €" + ui.values[ 1 ] );
										}
							 });
							$( "#amount" ).val( "€" + $( "#slider-range" ).slider( "values", 0 ) + " - €" + $( "#slider-range" ).slider( "values", 1 ) );

							});//]]>  
						</script>
						<script type="text/javascript" src="js/jquery-ui.js"></script>
						<!---->
					</div>
					<div class="sidebar-row">
						<h4>DISCOUNTS</h4>
						<div class="row row1">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>70% - 60% (5)</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>50% - 40% (7)</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (2)</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (5)</label>
						</div>
					</div>
					<div class="sidebar-row">
						<h4>Couleur</h4>
						<div class="row row1 scroll-pane">
							<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Blanc</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rose</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Or</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Argent</label>
						</div>
					</div>			 
				</div>
				<!--
				<div class="gallery-grid ">
					<h6>YOU MAY ALSO LIKE</h6>
					<a href="single.php"><img src="images/b1.png" class="img-responsive" alt=""/></a>
					<div class="gallery-text simpleCart_shelfItem">
						<h5><a class="name" href="single.php">Full Sleeves Romper</a></h5>
						<p><span class="item_price">60$</span></p>
						<h4 class="sizes">Sizes: <a href="#"> s</a> - <a href="#">m</a> - <a href="#">l</a> - <a href="#">xl</a> </h4>
						<ul>
							<li><a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li>
							<li><a class="item_add" href="#"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
							<li><a href="#"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
						</ul>
					</div>
				</div>
				-->
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//products-->
<?php
require_once('footer.php');
?>
