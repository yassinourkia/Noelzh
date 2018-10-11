<?php
$admin = true;
try
{
    $dbh = new PDO('mysql:host=localhost;dbname=noelzh', 'root', '');
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch(Exception $e)
{
    echo 'Echec de la connexion à la base de données';
    exit();
}
$r_categorie_list = $dbh->prepare('select c.name, count(id_p) as n_members from a_product_category a right join category c on c.name=a.name_c group by c.name');
$r_categorie_insert = $dbh->prepare('insert into category (name) values (:nom)');
$r_categorie_delete = $dbh->prepare('delete from category where name=:nom');


if ($admin && isset($_POST['nom_supprimer'])) {
	$nom = base64_decode($_POST['nom_supprimer']);
	$r_categorie_delete->bindParam(':nom', $nom);
	$res = $r_categorie_delete->execute();
	if (! $res) {
		echo 'Imposible de supprimer '.$nom;
	} else {
		echo 'Deleted '.$nom;
		header('Location: ../web');
	}
}

if ($admin && isset($_POST['nom_ajout'])) {
	$nom = $_POST['nom_ajout'];
	$r_categorie_insert->bindParam(':nom', $nom);
	$r_categorie_insert->execute();
	header('Location: ../web');
}

$r_categorie_list->execute();
$groups_raw = $r_categorie_list->fetchAll();

$groups = [];

foreach ($groups_raw as $gr) {
	$cal = explode('§', $gr['name']);
	if (count($cal) == 2){
		if (! isset($groups[$cal[0]]))
			$groups[$cal[0]] = array();
		array_push($groups[$cal[0]], $cal[1]);
	} else {
		if (! isset($groups[$cal[0]]))
			$groups[$cal[0]] = array();
	}
}

?>
<!--
<div class="groups">
	<?php if ($admin) : ?>
	<form method="post">
		<input type="text" name="nom_ajout"/>
		<input type="submit" value="Ajouter"/>
	</form>
	<?php endif; ?>
	<div class="group">
		<a href="/groups.php">
			<h3>Sans categories <span></span></h3>
		</a>
	</div>
	<?php foreach ($groups as $group): ?>
	<div class="group">
		<a href="/groups.php?n=<?=urlencode($group['name'])?>">
			<h3><?=htmlspecialchars($group['name'])?> <span>(<?=htmlspecialchars($group['n_members']).' produit'.((int)$group['n_members']>=2?'s':'') ?>)</span></h3>
		</a>
		<?php if ($admin): ?>
		<form method="post">
			<input type="hidden" name="nom_supprimer" value="<?=base64_encode($group['name'])?>"/>
			<input type="submit" value="Supprimer"/>
		</form>
		<?php endif; ?>
	</div>
	<?php endforeach; ?>
</div>
-->
