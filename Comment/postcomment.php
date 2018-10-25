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
    header("location:../web/login.php");
}
else
{
	if(isset($_POST["send"]))
	{
		echo "here";
		if( isset($_POST["contenu"]) && isset($_POST["rating"]) && isset($_SESSION['id_products']) && isset($_SESSION['user_id']) )
	    {

    		
    		$insert_query = "
				INSERT INTO `ratings` (`id`, `text`, `rating`, `id_products`, `id_users`) VALUES (NULL, :contenu, :rating, :id_products,:id_users)
				";
				$statement = $connect->prepare($insert_query);
				$statement->execute(
					array(
						':contenu'			=>	$_POST['contenu'],
						':rating'			=>	$_POST['rating'],
						':id_products'		=>	$_SESSION['id_products'],
						':id_users'			=>	$_SESSION['user_id']	
					)
				);
				$result = $statement->fetchAll();
				
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
		echo "mochkil";
	}
}

?>