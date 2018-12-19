<?php
	session_start();
	require_once('../Products/groups.php');
	require_once('../Products/panier.php');
	require_once('csrf.php');
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Noelzh</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Noelzh, Noël, vêtements accessoires" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//for-mobile-apps -->
<!--Custom Theme files -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!--//Custom Theme files -->
<!--js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<!--//js-->
<!--flex slider-->
<script defer src="js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="css/flexslider1.css" type="text/css" media="screen" />
<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
});
</script>
<!--flex slider-->
<script src="js/imagezoom.js"></script>
<!--cart-->
<script src="js/simpleCart.min.js"></script>
<!--cart-->
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'><link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Pompiere' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Fascinate' rel='stylesheet' type='text/css'>
<!--web-fonts-->
<!--animation-effect-->
<link href="css/animate.min.css" rel="stylesheet"> 
<script src="js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<!--//animation-effect-->
<!--start-smooth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},0);
			});
		});
</script>
<!--//end-smooth-scrolling-->
</head>
<body>
	<!--header-->
	<div class="header">
		<div class="top-header navbar navbar-default"><!--header-one-->
			<div class="container">
				<?php
					if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
						echo '<div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
								<p>Bienvenue chez Noelzh <a href="profil.php">'.$_SESSION['user_name'].' </a></p><a href="../login/logout.php" >Se déconnecter </a>
							</div>';
					}
					else 
						echo '<div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
								<p>Bienvenue chez Noelzh ! <a href="register.php">Créer un compte </a> - <a href="signin.php">Se Connecter</a></p>
							</div>';
				?>
				<div class="nav navbar-nav navbar-right social-icons wow fadeInRight animated" data-wow-delay=".5s">
					<ul>
						<li><a href="#"> </a></li>
						<li><a href="#" class="pin"> </a></li>
						<li><a href="#" class="in"> </a></li>
						<li><a href="#" class="be"> </a></li>
						<li><a href="#" class="you"> </a></li>
						<li><a href="#" class="vimeo"> </a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="header-two navbar navbar-default"><!--header-two-->
			<div class="container">
				<div class="nav navbar-nav header-two-left">
					<ul>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 892</li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">support@noelzh.com</a></li>			
					</ul>
				</div>
				<div class="nav navbar-nav logo wow zoomIn animated" data-wow-delay=".7s">
					<h1><a href="index.php">Noelzh<span class="tag">Tout ce qu'il vous faut pour un Noël réussi </span> </a></h1>
				</div>
				<div class="nav navbar-nav navbar-right header-two-right">
					<div class="header-right my-account">
						<a href="contact.php"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Nous contacter</a>						
					</div>
					<div class="header-right cart">
					<?php $panier_info = panier_get_info(); ?>
						<a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
						<h4><a href="checkout.php">
								<span class="simpleCart_total"> <?=round($panier_info['price'], 2)?> €</span> (<span id="simpleCart_quantity" class="simpleCart_quantity"> <?=$panier_info['nb']?> </span>) 
						</a></h4>
						<div class="cart-box">
							<form action="../Products/panier.php" method="post">
								<?php create_csrf_field(); ?>
								<input type="submit" name="panier_clear" value="Vider le panier" class="simpleCart_empty">
							</form>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="top-nav navbar navbar-default"><!--header-three-->
			<div class="container">
				<nav class="navbar" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Voir les options de navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!--navbar-header-->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav top-nav-info">
							<li><a href="index.php">Accueil</a></li>
							
							<?php foreach (get_header_categories() as $key => $group): ?>
							<li class="dropdown grid">
								<a href="#" class="dropdown-toggle list1" data-toggle="dropdown"><?=htmlspecialchars($key, ENT_QUOTES)?><b class="caret"></b></a>
								<ul class="dropdown-menu multi-column menu-two multi-column3">
									<div class="row">
										<div class="col-sm-4 menu-grids">
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php?n=<?=urlencode($key)?>"><?=htmlspecialchars($key, ENT_QUOTES)?></a></li>
												<?php if ($admin): ?>
												<form method="post"  action="../Products/groups.php">
													<input type="hidden" name="nom_supprimer" value="<?=base64_encode($key)?>"/>
													<?php create_csrf_field(); ?>
													<input type="submit" value="Supprimer"/>
												</form>
												<?php endif; ?>
												<?php foreach ($group as $sg): ?>
												<li><a class="list" href="products.php?n=<?=urlencode($sg)?>"><?=htmlspecialchars($sg, ENT_QUOTES)?></a></li>
												<?php if ($admin): ?>
												<form method="post" action="../Products/groups.php">
													<input type="hidden" name="nom_supprimer" value="<?=base64_encode($key.'§'.$sg)?>"/>
													<?php create_csrf_field(); ?>
													<input type="submit" value="Supprimer"/>
												</form>
												<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										</div>
										<div class="col-sm-8 menu-grids">
											<a href="products.php">
												<div class="new-add">
													<h5>30% DE REDUCTION <br> Aujourd'hui seulement</h5>
												</div>	
											</a>
										</div>	
										<div class="clearfix"> </div>
									</div>	
								</ul>
							</li>
							<?php endforeach; ?>
							
							<li><a href="products.php">Autre</a></li>
							<?php if ($admin) : ?>
							<li><a href="adm_product.php">Gérer les produits</a></li>
							<li><a href="messages.php">Messagerie</a></li>
							<?php endif; ?>
						</ul> 
						<?php if ($admin) : ?>
						<form method="post" action="../Products/groups.php">
							<input type="text" name="nom_ajout"/>
							<?php create_csrf_field(); ?>
							<input type="submit" value="Ajouter"/>
						</form>
						<?php endif; ?>
						<div class="clearfix"> </div>
						<!--//navbar-collapse-->
						<header class="cd-main-header">
							<ul class="cd-header-buttons">
								<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
							</ul> <!-- cd-header-buttons -->
						</header>
					</div>
					<!--//navbar-header-->
				</nav>
				<div id="cd-search" class="cd-search">
					<form>
						<input type="search" placeholder="Rechercher...">
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--//header-->
