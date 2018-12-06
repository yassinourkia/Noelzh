<?php
//register.php

require '../connect.php';

if(isset($_SESSION['id']))
{
	header("location:../web/index.php");
}

function verify_password_complexity($password) {
	$ret = true;
	if (strlen($password) < 12) {
		$ret = false;
	}
	if (!preg_match("/[A-Z]{1}/", $password) && !preg_match("/[a-z]{1}/", $password)) {
		$ret = false;
	}
	if (!preg_match("/[0-9]{1}/", $password)) {
		$ret = false;
	}
	if (!preg_match("/\W+/", $password)) {
		$ret = false;
	}
	return $ret;
}

assert(verify_password_complexity("a") == false);
assert(verify_password_complexity("zaefaeazee") == false);
assert(verify_password_complexity("zaefaeaZzZee") == false);
assert(verify_password_complexity("zaefae@ZZ12@azee") == true);

$message = '';

if(isset($_POST["register"]))
{
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
	{
    	$query = "
		SELECT * FROM users 
		WHERE email = :email
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':email'	=>	$_POST['email']
			)
		);
		$no_of_row = $statement->rowCount();
		if($no_of_row > 0)
		{
			$message = 'Email déjà utilisé ';
				header("location:../web/register.php?message=$message");
		}
		else
		{
			if($_POST['password'] == $_POST['password_verify'])
			{
				$user_password = $_POST['password'];
				if (!verify_password_complexity($user_password)) {
					$message ='Votre mot de passe est trop faible. Merci d\'utiliser au moins 12 caractères, avec des majuscules, minuscules, chiffres et caractères spèciaux';
					header("location:../web/register.php?message=$message");
					exit();
				}
				$user_encrypted_password = password_hash($user_password, PASSWORD_BCRYPT);
				$user_activation_code = md5(rand());
				$insert_query = "
				INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone`, `address`, `admin`, `avatar`) VALUES (NULL, :email, :password, :name,:phone,:address,0,:avatar)
				";
				$statement = $connect->prepare($insert_query);
				$statement->execute(
					array(
						':name'			=>	$_POST['name'],
						':email'			=>	$_POST['email'],
						':password'		=>	$user_encrypted_password,
						':phone'			=>	$_POST['phone'],
						':address'			=>	$_POST['address'],
						':avatar'			=>	file_get_contents($_FILES["avatar"]["tmp_name"])
						
					)
				);
				$result = $statement->fetchAll();
				
				if(isset($result))
				{
					
					$message ='Bienvenue ! vous êtes bien inscrit, s\'authentifier ';
					header("location:../web/signin.php?message=$message");
					
				}
			}else
			{
				$message = 'Echec : verification email non validée';
				header("location:../web/register.php?message=$message");
			}	
		}
	} 
	else 
	{
    	$message = 'Format Email non adapté';
				header("location:../web/register.php?message=$message");
	}
	
}

?>
