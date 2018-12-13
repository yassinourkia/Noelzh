<?php
	/**
 * Include our MySQL connection.
 */
	require_once('../connect.php');
	include_once('../Comment/ratingcount.php');
	$id = $product['id'];
	$stmt = $connect->prepare("SELECT r.text, u.name ,r.rating FROM ratings r, users u where u.id = r.id_users  and id_products = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	echo '<div class="panel-body"><table class="table  table-responsive">';
	while ($row = $stmt->fetch()) 
	{ 
		$rating = $row["rating"];
		echo '	<tr><td><b>'.$row["name"].'</b></td></tr>
				<tr class="active">
					<td>
						';
							for ($x = 1; $x <= $rating; $x++) {
								echo '<img src="../web/images/star1.png" height="20px" width="20px"/>';
							}
						echo '
					</td>
				</tr>
				<tr class="active"><td> '.$row["text"].'</td></tr>';
	}
	echo '</table></div>' ;


		
		
	
	
?>