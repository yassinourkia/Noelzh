<?php
require_once('header.php');
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Register</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Formulaire d'<span> inscription</span></h3>
			<p>Bienvenue </p>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h3>Vous êtes déja inscrit  ?<a href="signin.php">  Connectez vous »</a> </h3>
				<h4><div <?php if(isset($_GET['message'])) echo 'class="alert alert-danger"';?> > <?php  echo htmlspecialchars($_GET['message'],ENT_QUOTES,"UTF-8"); endif?></div></h4>
			</div>
			<div class="login-body">
				<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="../login/register.php" method="post" enctype="multipart/form-data">
					<input type="text" class="uemail" name="name" placeholder="Votre Nom" required="">
					<input type="text" class="uemail"  name="email" placeholder="Adresse E-mail" required="">
					<input type="text" class="uemail"  name="phone" placeholder="Numéro de Telephone" required="">
					<label>Photo de profil</label><input type="file" class="uemail"  name="avatar" placeholder="Photo de Profile" required=""><br>
					<input type="text" class="uemail"  name="address" placeholder="Addresse" required="">
					<input type="password" name="password" n class="lock" placeholder="Mot de Passe">
					<input type="password" name="password_verify" n class="lock" placeholder="Vérifier votre mot de passe">
					<input type="submit" name="register" value="S'inscrire">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
<?php
require_once('footer.php');
?>