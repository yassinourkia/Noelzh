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
$r_categorie_delete = $dbh->prepare('delete from category where nom=:nom');

if ($admin && isset($_POST['nom_supprimer'])) {
	$nom = base64_decode($_POST['nom_supprimer']);
	$r_categorie_delete->bindParam(':nom', $nom);
	$res = $r_categorie_delete->execute();
	if (! $res) {
		echo 'Imposible de supprimer '.$nom;
	}
}

if ($admin && isset($_POST['nom_ajout'])) {
	$nom = $_POST['nom_ajout'];
	$r_categorie_insert->bindParam(':nom', $nom);
	$r_categorie_insert->execute();
}


$r_product_nocat_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description, p.picture from product p where p.id not in (select id_p from a_product_category)');
$r_product_cat_list = $dbh->prepare('select p.id, p.name, p.price, p.quantity, p.size, p.description, p.picture from product p inner join a_product_category a on a.id_p=p.id where a.name_c=:cat');
$r_product_insert = $dbh->prepare('insert into product (name, price, quantity, size, description, picture) values (:nom, :prix, :quantite, :taille, :description, :image)');
$r_product_delete = $dbh->prepare('delete from product where id=:id');

if ($admin && isset($_POST['nom_produit'])) {
	$nom = $_POST['nom_produit'];
	$prix = (int) $_POST['prix'];
	$taille = $_POST['taille'];
	$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 0;
	$description = trim($_POST['description']);
	$image = file_get_contents ($_FILES['image']['tmp_name']);
	$r_product_insert->bindParam(':nom', $nom);
	$r_product_insert->bindParam(':prix', $prix, PDO::PARAM_INT);
	$r_product_insert->bindParam(':quantite', $quantite);
	$r_product_insert->bindParam(':taille', $taille);
	$r_product_insert->bindParam(':description', $description);
	$r_product_insert->bindParam(':image', $image);
	$r_product_insert->execute();
}

if ($admin && isset($_POST['id_p_supprimer'])) {
	$id = $_POST['id_p_supprimer'];
	$r_product_delete->bindParam(':id', $id);
	$r_product_delete->execute();
}

$r_categorie_list->execute();
$groups = $r_categorie_list->fetchAll();

if (isset($_GET['n'])) {
	$name = urldecode($_GET['n']);
	$r_product_cat_list->bindParam(':cat', $name);
	$r_product_cat_list->execute();
	$products = $r_product_cat_list->fetchAll();
} else {
	$r_product_nocat_list->execute();
	$products = $r_product_nocat_list->fetchAll();
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

<div class="products">
	<?php if ($admin) : ?>
	<form method="post" enctype="multipart/form-data">
		<label for="nom_produit">Nom du produit</label>
		<input type="text" name="nom_produit" placeholder="nom" size="49"></input>
		<label for="prix">prix</label>
		<input type="text" name="prix" placeholder="0" size="49"></input>
		<label for="image">Image</label>
		<input type="file" name="image" accept="image/png" placeholder="img.png"></input>
		<label for="taille">Taille</label>
		<input type="text" name="taille" placeholder="m" size="9"></input>
		<label for="description">Description</label>
		<textarea name="description" placeholder="Description du produit" maxlength="149"></textarea>
		<?php foreach ($groups as $group): ?>
		<input type="checkbox" name="group" value="<?=urlencode($group['name'])?>"><?=urlencode($group['name'])?></option>
		<?php endforeach; ?>
		<input type="submit" value="Ajouter"/>
	</form>
	<?php endif; ?>
	<?php foreach ($products as $product): ?>
	<hr>
	<div class="product">
		<a href="product.php?pid=<?=$product['id']?>"><h3><?=htmlspecialchars($product['name'])?></h3></a>
		<img src="data:image/png;base64,<?=base64_encode($product['picture'])?>"/>
		<div class="price"><?=htmlspecialchars($product['price'])?> €</div>
		<div class="size"><?=htmlspecialchars($product['size'])?></div>
		<pre><?=htmlspecialchars($product['description'])?></pre>
	</div>
	<?php endforeach; ?>
</div>
-->
