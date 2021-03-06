<?php
require_once('header.php');
require_once('../Products/products.php');
include_once('../Comment/ratingcount.php');
require_once('csrf.php');
$product = product($_GET['pid']);
if ($product != null):
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active"><?=htmlspecialchars($product['name'], ENT_QUOTES, "UTF-8")?></li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--single-page-->
	<div class="single">
		<div class="container">
			<div class="single-info">		
				<div class="col-md-6 single-top wow fadeInLeft animated" data-wow-delay=".5s">	
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="images/s1.jpg">
								<div class="thumb-image"> <img src="../Products/image.php?id=<?=urlencode($product['id'])?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 single-top-left simpleCart_shelfItem wow fadeInRight animated" data-wow-delay=".5s">
					<h3><?=htmlspecialchars($product['name'], ENT_QUOTES, "UTF-8")?></h3>
					<div class="single-rating">
						<?php
							$avg = getAvgRating($product['id']);
							for ($x = 1; $x <= $avg; $x++) {
								echo '<img src="images/star1.png" height="20px" width="20px"/>';
							}
						?>
					</div>
					<h6 class="item_price"><?=htmlspecialchars($product['price'], ENT_QUOTES, "UTF-8")?> €</h6>			
					<p><?=htmlspecialchars($product['description'], ENT_QUOTES, "UTF-8")?></p>
					<ul class="size">
						<h4>Taille</h4>
						<li><a href="#"><?=htmlspecialchars($product['size'], ENT_QUOTES, "UTF-8")?></a></li>
					</ul>
					<div class="clearfix"> </div>
					<form method="post" action="../Products/panier.php">
					<?php create_csrf_field(); ?>
					<input type="hidden" name="panier_item_id" value="<?=urlencode($product['id'])?>"/> 
					<div class="quantity">
						<p class="qty"> Quantité :  </p><input min="1" type="number" value="1" class="item_quantity" name="panier_qty">
 					</div>
					<div class="btn_form">
						<input type="submit" class="btn btn-info" name="panier_add" value="Ajouter au panier"/>
						<?php if ($admin): ?>
						<a href="adm_product.php?mod_id=<?=urlencode($product['id'])?>" class="btn btn-info">Modifier</a>
						<?php endif; ?>
					</div>
					</form>
				</div>
			   <div class="clearfix"> </div>
			</div>
			<!--collapse-tabs-->
			<div class="collpse tabs">
				<div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".5s">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  Description
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<?=htmlspecialchars($product['description'], ENT_QUOTES, "UTF-8")?>
							</div>
						</div>
					</div>
					<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".6s">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								   Informations supplémentaires
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>
					<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".7s">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Avis (<?php 
									if(!empty(getCountComment($product['id']))) echo getCountComment($product['id']); else echo 0;?>)
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel panel-default">
								<div class="panel-heading">Poster vos commentaires</div>
								  <div class="panel-body">
								  	<form method="post" action="../Comment/postcomment.php">
								  	  <div class="form-group">
									    <label for="user_name">Nom </label>
									    <input type="text" value ="<?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>" name="name" class="form-control" id="user_name" disabled />
										<input type="hidden" value="<?=$product['id']?>" name="id_products" />
									  </div>
									  
									  <div class="single-rating">
										<span class="starRating">
											<input id="rating5" type="radio" name="rating" value="5">
											<label for="rating5">5</label>
											<input id="rating4" type="radio" name="rating" value="4">
											<label for="rating4">4</label>
											<input id="rating3" type="radio" name="rating" value="3">
											<label for="rating3">3</label>
											<input id="rating2" type="radio" name="rating" value="2">
											<label for="rating2">2</label>
											<input id="rating1" type="radio" name="rating" value="1">
											<label for="rating1">1</label>
										</span>
										<p>5.00 sur 5</p>
									</div>
									  <div class="form-group">
									    <label for="exampleInputPassword1">Commentaire</label>
									    <textarea name="contenu" class="form-control" rows="3"></textarea>
									  </div>
									  <?php create_csrf_field(); ?>
									  <input type="submit" name="send" value="Envoyer" class="btn btn-primary">
									</form>
								  </div>
							</div>
							<?php  
                            	include_once("../Comment/commentlist.php");
							?>
						</div>
					</div>
					<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".8s">
						<div class="panel-heading" role="tab" id="headingFour">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									Aide
								</a>
							</h4>
						</div>
						<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
							<div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--//collapse -->
		</div>
	</div>
	<!--//single-page-->
<?php
endif;
require_once('footer.php');
?>
