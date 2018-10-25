<?php
	/**
 * Include our MySQL connection.
 */
	require_once '../connect.php';
	$stmt = $connect->query("SELECT r.text, u.name FROM ratings r, users u where u.id = r.id_users ");
	echo '<div class="panel-body"><table class="table table-hover table-responsive" ';
	while ($row = $stmt->fetch()) 
	{ 
		echo '<tr class="active"> <td>Nom </td><td> '.$row["name"].'</td></tr><tr><td>Commentaire </td><td> '.$row["text"].'</td></tr>';
	}
	echo '</table></div>' ;


		$stmt2 = $connect->query("SELECT count(*)  as count FROM ratings  ");
		$row = $stmt2->fetch();
		$count = $row['count'];
		
	
	
?>