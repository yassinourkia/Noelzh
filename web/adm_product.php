<?php
require_once('header.php');
require_once('../Products/products.php');
require_once('../Products/groups.php');
require_once('csrf.php');
if (isset($_GET['mod_id'])) {
  $id = (int)urldecode($_GET['mod_id']);
  $p = product($id);
  $cat = get_categories($id);
  $modify = true;
} else {
  $cat = array();
  $modify = false;
}

?>
<div class="container">
	<?php if ($admin) : ?>
	<form method="post" enctype="multipart/form-data">
		<?php if ($modify): ?>
		<input type="hidden" name="mod_id" value="<?=$p['id']?>"></input>
		<?php endif; ?>
		<div class="form-group">
			<label for="nom_produit">Nom du produit</label>
			<input type="text" class="form-control" name="nom_produit" placeholder="nom" size="49" value="<?=isset($p['name'])?$p['name']:''?>"></input>
		</div>
		<div class="form-group">
			<label for="prix">prix</label>
			<input type="text" class="form-control" name="prix" placeholder="0" maxlength="49" value="<?=isset($p['price'])?$p['price']:''?>"></input>
		</div>
		<div class="form-group container">
			<div class="row">
				<?php if ($modify): ?>
				<img src="../Products/image.php?id=<?=urlencode($p['id'])?>" class="img-responsive col-md-4" width="200px"/>
				<?php endif; ?>
				<div class="col-md-4">
					<label for="image">Image</label>
					<input type="file" class="form-control-file" name="image" accept="image/png" placeholder="img.png"></input>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="taille">Taille</label>
			<input type="text" class="form-control" name="taille" placeholder="m" maxlength="9" value="<?=isset($p['size'])?$p['size']:''?>"></input>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea name="description" class="form-control" placeholder="Description du produit" maxlength="149"><?=isset($p['description'])?$p['description']:''?></textarea>
		</div>
		<?php foreach (get_raw_categories() as $group): ?>
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="group[]" value="<?=urlencode($group['name'])?>" <?php if (in_array($group['name'], $cat)) echo 'checked'?>></input>
			<label class="form-check-label" for="group[]"><?=htmlspecialchars($group['name'], ENT_QUOTES, "UTF-8")?></label>
		</div>
		<?php endforeach; ?>
		<?php create_csrf_field(); ?>
		<input type="submit" class="form-control btn btn-primary" value="Ajouter"/>
	</form>
	<?php endif; ?>
</div>
<?php
require_once('footer.php');
?>
