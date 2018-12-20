<?php
	require_once('header.php');
	require_once('csrf.php');
	
	if ($admin) :
	
		include_once('../connect.php');
		$dbh = $connect;
		
		$r_insert = $dbh->prepare('insert into messages (id_users, message) values (:idusers, :msg)');
		if ($admin && isset($_POST['message'])) {
			if (! check_csrf_token($_POST)) exit("csrf");
			$r_insert->bindParam(':idusers', $_SESSION['user_id']);
			$r_insert->bindParam(':msg', $_POST['message']); 
			$r_insert->execute();
		}
		
		$r_messages = $dbh->prepare('select * from messages order by `date` asc');
		$r_messages->execute();
		$messages = $r_messages->fetchAll();
		
		$r_author = $dbh->prepare('select name from users where id = :iduser');
		
		
?>

		<!--breadcrumbs-->
			<div class="breadcrumbs">
				<div class="container">
					<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
						<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
						<li class="active">Messagerie</li>
					</ol>
				</div>
			</div>
		<!--//breadcrumbs-->
		
		<!--messagerie-->
		<div class="messagerie">
			<div class="container">
				<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
					<h3 class="title">Messagerie<span> interne</span></h3>
				</div>
				<div id="msg"> <!-- affichage messages -->
					<?php foreach ($messages as $key => $message): ?>
						<div> <!-- message -->
							<?php
								$r_author->bindParam(':iduser', $message['id_users'], PDO::PARAM_INT); 
								$r_author->execute();
								$author = $r_author->fetch();
								$date = $message['date'];
							?>
							<p><?=htmlspecialchars($author[0], ENT_QUOTES, "UTF-8")?> - <?=htmlspecialchars($message['date'], ENT_QUOTES, "UTF-8")?></p>
							<div> <!-- contenu message -->
								<p><?=htmlspecialchars($message['message'], ENT_QUOTES, "UTF-8")?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div> <!-- envoi message -->
					<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<textarea id="msgarea" name="message" class="form-control" placeholder="Message" maxlength="500"></textarea>
						</div>
						<?php create_csrf_field(); ?>
						<input type="submit" class="form-control btn btn-primary" value="Envoyer" onclick="emptyText()">
					</form>
				</div>
			</div>
		</div>
		<!--//messagerie-->

<?php
	endif;
	
	require_once('footer.php');
?>