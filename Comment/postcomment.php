<?php
//postcomment.php

/**
 * Start the session.
 */
session_start();



/**
 * Include our MySQL connection.
 */
require_once '../connect.php';
if(! isset($_SESSION['user_id']))
{
    header("location:../web/signin.php");
}
else
{
	if(isset($_POST["send"]))
	{
		if( isset($_POST["contenu"])  && isset($_SESSION['id_products']) && isset($_SESSION['user_id']) && check_csrf_token($_POST))
	    {

    		$insert_query = "
				INSERT INTO `ratings` (`id`, `text`, `rating`, `id_products`, `id_users`) VALUES (NULL, :contenu, :rating, :id_products,:id_users)
				";
				$statement = $connect->prepare($insert_query);
				if(isset($_POST["rating"]) && $_POST["rating"] >= 0){

					$statement->execute(
						array(
							':contenu'			=>	$_POST['contenu'],
							':rating'			=>	$_POST['rating'],
							':id_products'		=>	$_SESSION['id_products'],
							':id_users'			=>	$_SESSION['user_id']	
						)
					);
					$result = $statement->fetchAll();
				}
				else
				{
					$message ='Valeurs negatif non autorisé';
					header("location:../web/single.php?pid=".$_SESSION['id_products']."&message=$message");	
				}
				
				
				
				if(isset($result))
				{
					$message ='Merci Pour votre commentaire';
					header("location:../web/single.php?pid=".$_SESSION['id_products']."&message=$message");	
				}				
		}
		else
		{
				$message = 'Echec : Commentaire non posté';
				header("location:../web/single.php?pid=1&message=$message");
		}		 
	}
	else
	{
		$message = 'Echec';
		header("location:../web/single.php?pid=1&message=$message");
	}
}

?>