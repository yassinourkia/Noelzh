<?php
require_once('header.php');
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow fadeInUp" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
				<li class="active">Se connecter</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Connectez<span> Vous</span></h3>
			
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h3>Bon retour parmi nous ! <br> Vous n'êtes pas encore membre ? <a href="register.php">  Créer un compte »</a> </h3>
				<h4><div <?php if(isset($_GET['message'])) { echo 'class="alert alert-danger"';?> > <?php echo htmlspecialchars($_GET['message'],ENT_QUOTES,"UTF-8"); } ?></div></h4>
			</div>
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<form action="../Login/login.php" method="post">
					<input type="text" class="user" name="user_email" placeholder="Adresse email" required="">
					<input type="password" name="user_password" class="lock" placeholder="Mot de passe">
					<input type="submit" name="login" value="Se connecter">
					<!--
					<div class="forgot-grid">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Remember me</label>
						<div class="forgot">
							<a href="#">Forgot Password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>-->
				</form>
			</div>
		</div>
		<div class="login-page-bottom">
			<h5> - OR -</h5>
			<div class="social-btn"><a href="#"><i>Se connecter avec Facebook</i></a></div>
			<div class="social-btn sb-two"><a href="#"><i>Se connecter avec Twitter</i></a></div>
		</div>
	</div>
	<!--//login-->
<?php
require_once('footer.php');
?>
