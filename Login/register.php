<?php
//register.php

require '../connect.php';

if(isset($_SESSION['id']))
{
	header("location:../web/index.php");
}

$message = '';

if(isset($_POST["register"]))
{
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
	{
    	$query = "
		SELECT * FROM user 
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
			$message = 'Email déja utilisé ';
				header("location:../web/register.php?message=$message");
		}
		else
		{
			if($_POST['password'] == $_POST['password_verify'])
			{
				$user_password = $_POST['password'];
				$user_encrypted_password = password_hash($user_password, PASSWORD_BCRYPT);
				$user_activation_code = md5(rand());
				$insert_query = "
				INSERT INTO `user` (`id`, `email`, `password`, `name`, `phone`, `address`, `admin`, `avatar`) VALUES (NULL, :email, :password, :name,:phone,:address,2,:avatar)
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
					
					$message ='Bienvenu ! vous êtes bien inscrit, s\'authentifier ';
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
    	$message = 'Format Email non adapatée';
				header("location:../web/register.php?message=$message");
	}
	
}

?>