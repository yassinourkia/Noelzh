<?php
require_once('header.php');
require_once('../Login/register.php');
require_once('csrf.php');

if( isset($_SESSION['user_id']) )
{
	$requser = $connect->prepare('SELECT * FROM users WHERE id = ?');
	$requser->execute(array($_SESSION['user_id']));
	$userinfo = $requser->fetch();

	
	if(isset($_POST['newname']) AND !empty($_POST['newname']) AND $_POST['newname'] != $userinfo['name'] AND check_csrf_token($_POST))
    {
      $newname = htmlspecialchars($_POST['newname'], ENT_QUOTES, "UTF-8");
      $insertpseudo = $connect->prepare("UPDATE users SET name = ? WHERE id = ?");
      $insertpseudo->execute(array($newname, $_SESSION['user_id']));
    }
	
	if(isset($_POST['newemail']) AND !empty($_POST['newemail']) AND $_POST['newemail'] != $userinfo['email']  AND check_csrf_token($_POST))
    {
		if (filter_var($_POST['newemail'], FILTER_VALIDATE_EMAIL)) 
		{
		  $newemail = htmlspecialchars($_POST['newemail'], ENT_QUOTES, "UTF-8");
		  $insertpseudo = $connect->prepare("UPDATE users SET email = ? WHERE id = ?");
		  $insertpseudo->execute(array($newemail, $_SESSION['user_id']));
		}
    }
	
	if(isset($_POST['newphone']) AND !empty($_POST['newphone']) AND $_POST['newphone'] != $userinfo['phone']  AND check_csrf_token($_POST))
    {
      $newphone = htmlspecialchars($_POST['newphone'], ENT_QUOTES, "UTF-8");
      $insertpseudo = $connect->prepare("UPDATE users SET phone = ? WHERE id = ?");
      $insertpseudo->execute(array($newphone, $_SESSION['user_id']));
    }
	
	if(isset($_POST['newaddress']) AND !empty($_POST['newaddress']) AND $_POST['newaddress'] != $userinfo['address']  AND check_csrf_token($_POST))
    {
      $newaddress = htmlspecialchars($_POST['newaddress'], ENT_QUOTES, "UTF-8");
      $insertpseudo = $connect->prepare("UPDATE users SET address = ? WHERE id = ?");
      $insertpseudo->execute(array($newaddress, $_SESSION['user_id']));
    }
	
	if(isset($_POST['newavatar']) AND !empty($_POST['newavatar'])  AND check_csrf_token($_POST))
    {
      $newavatar = file_get_contents($_FILES["avatar"]["tmp_name"]);
      $insertavatar = $connect->prepare("UPDATE users SET avatar = ? WHERE id = ?");
      $insertavatar->execute(array($newavatar, $_SESSION['user_id']));
    }
	
	
	if( isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND !empty($_POST['newpassword2'])
	 AND check_csrf_token($_POST))
    {
      $newpassword = htmlspecialchars($_POST['newpassword'], ENT_QUOTES, "UTF-8");
		$newpassword2 = htmlspecialchars($_POST['newpassword2'], ENT_QUOTES, "UTF-8");
		if (!verify_password_complexity($newpassword)) {
			die ("Le mot de passe n'est pas assez complexe !");
		}
	  if( $newpassword == $newpassword2 ){
		  $user_encrypted_password = password_hash($newpassword, PASSWORD_BCRYPT);
		  $insertpassword = $connect->prepare("UPDATE users SET password = ? WHERE id = ?");
		  $insertpassword->execute(array($user_encrypted_password, $_SESSION['user_id']));
	  }
    }
	

?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Profil</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Profil</span></h3>
			<p>Bienvenue <?php echo $userinfo['name'];?></p>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4><div <?php if(isset($_GET['message'])){ echo 'class="alert alert-danger"';?> > <?php  echo htmlspecialchars($_GET['message'],ENT_QUOTES,"UTF-8"); }?></div></h4>
			</div>
			<div class="login-body">
				<form class="wow fadeInUp animated" data-wow-delay=".7s"  action="" method="post" enctype="multipart/form-data">
				
					<label>Nom</label><input type="text" class="uemail" name="newname" value="<?php echo $userinfo['name'];?>">
					<label>Adresse E-mail</label><input type="text" class="uemail"  name="newemail" value="<?php echo $userinfo['email'];?>">
					<label>Numero de Telephone</label><input type="text" class="uemail"  name="newphone" value="<?php echo $userinfo['phone'];?>">
					<label>Photo de profil</label><img width="32" height="32" src="data:image/png;base64,<?=base64_encode($userinfo['avatar'])?>">
					<input type="file" class="uemail"  name="newavatar"><br>
					<label>Addresse</label><input type="text" class="uemail"  name="newaddress" value="<?php echo $userinfo['address'];?>">
					<label>Nouveau mot de Passe</label><input type="password" name="newpassword" class="lock">
					<label>Confirmer votre nouveau mot de passe</label><input type="password" name="newpassword2" class="lock">
					<?php create_csrf_field(); ?>
					<input type="submit" value="Mettre a jour le profil!">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
<?php
  }
require_once('footer.php');
?>