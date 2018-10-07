<?php
	session_start();
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
					if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))
						echo '<div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
								<p>Welcome to Modern Shoppe <a href="web/profile.html">'.$_SESSION['user_name'].' </a></p>
								<a href="../login/logout.php" >Logout </a>
							</div>';
					else 
						echo '<div class="nav navbar-nav wow fadeInLeft animated" data-wow-delay=".5s">
								<p>Welcome to Modern Shoppe <a href="register.php">Register </a> Or <a href="signin.php">Sign In </a></p>
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
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">mail@example.com</a></li>			
					</ul>
				</div>
				<div class="nav navbar-nav logo wow zoomIn animated" data-wow-delay=".7s">
					<h1><a href="index.php">Noelzh<span class="tag">Everything for Christmas </span> </a></h1>
				</div>
				<div class="nav navbar-nav navbar-right header-two-right">
					<div class="header-right my-account">
						<a href="contact.php"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> CONTACT US</a>						
					</div>
					<div class="header-right cart">
						<a href="#"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
						<h4><a href="checkout.php">
								<span class="simpleCart_total"> $0.00 </span> (<span id="simpleCart_quantity" class="simpleCart_quantity"> 0 </span>) 
						</a></h4>
						<div class="cart-box">
							<p><a href="javascript:;" class="simpleCart_empty">Empty cart</a></p>
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
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!--navbar-header-->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav top-nav-info">
							<li><a href="index.php">Home</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Baby<b class="caret"></b></a>
								<ul class="dropdown-menu multi-column multi-column1">
									<div class="row">
										<div class="col-sm-4 menu-grids menulist1">
											<h4>Bath & Care</h4>
											<ul class="multi-column-dropdown ">
												<li><a class="list" href="products.php">Diapering</a></li>
												<li><a class="list" href="products.php">Baby Wipes</a></li>
												<li><a class="list" href="products.php">Baby Soaps</a></li>
												<li><a class="list" href="products.php">Lotions & Oils </a></li>
												<li><a class="list" href="products.php">Powders</a></li>
												<li><a class="list" href="products.php">Shampoos</a></li>
											</ul>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Body Wash</a></li>
												<li><a class="list" href="products.php">Cloth Diapers</a></li>
												<li><a class="list" href="products.php">Baby Nappies</a></li>
												<li><a class="list" href="products.php">Medical Care</a></li>
												<li><a class="list" href="products.php">Grooming</a></li>
												<li><h6><a class="list" href="products.php">Combo Packs</a></h6></li>
											</ul>
										</div>																		
										<div class="col-sm-2 menu-grids">
											<h4>Baby Clothes</h4>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Onesies & Rompers</a></li>
												<li><a class="list" href="products.php">Frocks</a></li>
												<li><a class="list" href="products.php">Socks & Tights</a></li>
												<li><a class="list" href="products.php">Sweaters & Caps</a></li>
												<li><a class="list" href="products.php">Night Wear</a></li>
												<li><a class="list" href="products.php">Quilts & Wraps</a></li>
											</ul>
										</div>
										<div class="col-sm-3 menu-grids">
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Blankets</a></li>
												<li><a class="list" href="products.php">Gloves & Mittens</a></li>
												<h4>Shop by Age</h4>
												<li><a class="list" href="products.php">New Born (0 - 5 M)</a></li>
												<li><a class="list" href="products.php">5 - 10 Months</a></li>
												<li><a class="list" href="products.php">10 - 15 Months</a></li>
												<li><a class="list" href="products.php">15 Months Above</a></li>
											</ul>
										</div>
										<div class="col-sm-3 menu-grids">
											<ul class="multi-column-dropdown">
												<li><h6><a class="list" href="products.php">Feeding & Nursing</a></h6></li>
												<h4>Baby Gear</h4>
												<li><a class="list" href="products.php">Baby Walkers</a></li>
												<li><a class="list" href="products.php">Strollers</a></li>
												<li><a class="list" href="products.php">Prams & Toys</a></li>
												<li><a class="list" href="products.php">Cribs & Cradles</a></li>
												<li><a class="list" href="products.php">Booster Seats</a></li>
											</ul>
										</div>
										<div class="clearfix"> </div>
									</div>
								</ul>
							</li>
							<li class="dropdown grid">
								<a href="#" class="dropdown-toggle list1" data-toggle="dropdown">Kids<b class="caret"></b></a>
								<ul class="dropdown-menu multi-column multi-column2">
									<div class="row">
										<div class="col-sm-3 menu-grids">
											<h4>New Arrivals</h4>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Topwear</a></li>
												<li><a class="list" href="products.php">Bottomwear</a></li>
												<li><a class="list" href="products.php">Innerwear</a></li>
												<li><a class="list" href="products.php">Nightwear</a></li>
												<li><a class="list" href="products.php">Swimwear</a></li>
												<li><a class="list" href="products.php">Jumpers</a></li>
											</ul>
										</div>																		
										<div class="col-sm-3 menu-grids">
											<h4>Boys</h4>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Jeans</a></li>
												<li><a class="list" href="products.php">Shirts</a></li>
												<li><a class="list" href="products.php">T-shirts</a></li>
												<li><a class="list" href="products.php">Dhoti Kurta Sets</a></li>
												<li><a class="list" href="products.php">Winter wear</a></li>
												<li><a class="list" href="products.php">Party Wear</a></li>
											</ul>
										</div>
										<div class="col-sm-3 menu-grids">
											<h4>Girls</h4>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Tops</a></li>
												<li><a class="list" href="products.php">Leggings</a></li>
												<li><a class="list" href="products.php">Dresses </a></li>
												<li><a class="list" href="products.php">Skirts</a></li>
												<li><a class="list" href="products.php">Casual Dresses</a></li>
												<li><a class="list" href="products.php">Capris & 3/4ths</a></li>
											</ul>
										</div>
										<div class="col-sm-3 menu-grids new-add2">
											<a href="products.php">
												<h6>Kids Special</h6>
												<img src="images/img1.jpg" alt="">
											</a>
										</div>
										<div class="clearfix"> </div>
									</div>
								</ul>
							</li>
							<li class="dropdown grid">
								<a href="#" class="dropdown-toggle list1" data-toggle="dropdown">Accessories<b class="caret"></b></a>
								<ul class="dropdown-menu multi-column menu-two multi-column3">
									<div class="row">
										<div class="col-sm-4 menu-grids">
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Jewellery</a></li>
												<li><a class="list" href="products.php">Hair bands & Clips</a></li>
												<li><a class="list" href="products.php">Bangles </a></li>
												<li><a class="list" href="products.php">Caps & Belts</a></li>
												<li><a class="list" href="products.php">Rain wear</a></li>
												<li><a class="list" href="products.php">Bags</a></li>
											</ul>
										</div>
										<div class="col-sm-8 menu-grids">
											<a href="products.php">
												<div class="new-add">
													<h5>30% OFF <br> Today Only</h5>
												</div>	
											</a>
										</div>	
										<div class="clearfix"> </div>
									</div>	
								</ul>
							</li>				
							<li class="dropdown grid">
								<a href="#" class="dropdown-toggle list1" data-toggle="dropdown">Toys <b class="caret"></b></a>
								<ul class="dropdown-menu multi-column multi-column4">
									<div class="row">
										<div class="col-sm-4 menu-grids menulist1">
											<h4>BABY</h4>
											<ul class="multi-column-dropdown ">
												<li><a class="list" href="products.php">Rockers</a></li>
												<li><a class="list" href="products.php">Rattles</a></li>
												<li><a class="list" href="products.php">Stroller Toys</a></li>
												<li><a class="list" href="products.php">Musical Toys </a></li>
												<li><a class="list" href="products.php">Doll Houses</a></li>
												<li><a class="list" href="products.php">Play Sets</a></li>
											</ul>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Toys Dolls</a></li>
												<li><a class="list" href="products.php">Pacifiers</a></li>
												<li><a class="list" href="products.php">Building Sets</a></li>
												<li><a class="list" href="products.php">Bath Toys</a></li>
												<li><a class="list" href="products.php">Soft Toys</a></li>
												<li><h6><a class="list" href="products.php">Special Off</a></h6></li>
											</ul>
										</div>																		
										<div class="col-sm-2 menu-grids">
											<h4>Pretend Play</h4>
											<ul class="multi-column-dropdown">
												<li><h6><a class="list" href="products.php">Video Games</a></h6></li>
												<li><a class="list" href="products.php">Kitchen Sets</a></li>
												<li><a class="list" href="products.php">Sand Toys</a></li>
												<li><a class="list" href="products.php">Tool Sets</a></li>
												<li><a class="list" href="products.php">Bath Toys</a></li>
												<li><a class="list" href="products.php">Medical Set</a></li>
											</ul>
										</div>
										<div class="col-sm-2 menu-grids">
											<h4>Outdoor</h4>
											<ul class="multi-column-dropdown">
												<li><a class="list" href="products.php">Swimming</a></li>
												<li><a class="list" href="products.php">Rideons </a></li>
												<li><a class="list" href="products.php">Scooters</a></li>
												<li><a class="list" href="products.php">Remote Control</a></li>
												<li><a class="list" href="products.php">Animals</a></li>
												<li><a class="list" href="products.php">Make up</a></li>
											</ul>
										</div>
										<div class="col-sm-4 menu-grids">
											<a href="products.php">
												<div class="new-add">
													<h5>30% OFF <br> Today Only</h5>
												</div>
											</a>	
										</div>
										<div class="clearfix"> </div>
									</div>
								</ul>
							</li>
							<li><a href="codes.php">Special Offers</a></li>
						</ul> 
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
						<input type="search" placeholder="Search...">
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--//header-->