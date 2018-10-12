<?php
require_once('header.php');
require_once('../Products/products.php');
?>
<div class="container">
	<?php if ($admin) : ?>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nom_produit">Nom du produit</label>
			<input type="text" class="form-control" name="nom_produit" placeholder="nom" size="49"></input>
		</div>
		<div class="form-group">
			<label for="prix">prix</label>
			<input type="text" class="form-control" name="prix" placeholder="0" maxlength="49"></input>
		</div>
		<div class="form-group">
			<label for="image">Image</label>
			<input type="file" class="form-control-file" name="image" accept="image/png" placeholder="img.png"></input>
		</div>
		<div class="form-group">
			<label for="taille">Taille</label>
			<input type="text" class="form-control" name="taille" placeholder="m" maxlength="9"></input>
		<div class="form-group">
		<div class="form-group">
			<label for="description">Description</label>
			<textarea name="description" class="form-control" placeholder="Description du produit" maxlength="149"></textarea>
		</div>
		<?php foreach ($groups_raw as $group): ?>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="group[]" value="<?=urlencode($group['name'])?>"></input>
			<label class="form-check-label" for="group[]"><?=htmlspecialchars($group['name'])?></label>
		</div>
		<?php endforeach; ?>
		<input type="submit" class="form-control btn btn-primary" value="Ajouter"/>
	</form>
	<?php endif; ?>
</div>
<?php
require_once('footer.php');
?>
