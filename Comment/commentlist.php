<?php
	/**
 * Include our MySQL connection.
 */
	require_once '../connect.php';
	include_once('../Comment/ratingcount.php');
	$stmt = $connect->query("SELECT r.text, u.name ,r.rating FROM ratings r, users u where u.id = r.id_users  and id_products =".$product['id']);
	echo '<div class="panel-body"><table class="table  table-responsive">';
	while ($row = $stmt->fetch()) 
	{ 
		$rating = $row["rating"];
		echo '	<tr><td><b>'.$row["name"].'</b></td></tr>
				<tr class="active">
					<td>
						<div class="single-rating">
							<span class="starRating">';
							for ($x = 1; $x <= $rating; $x++) {
								echo '<label for="rating'.$x.'"></label>';
							}
						echo '</span>
						</div>
					</td>
				</tr>
				<tr class="active"><td> '.$row["text"].'</td></tr>';
	}
	echo '</table></div>' ;


		
		
	
	
?>