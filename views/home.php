<?php foreach ($produtos as $value): ?>
	<a href="/produtos/ver/<?=  $value['id']?>">
		<div class="produto">
			<img src="<?= $value['nome'] ?>" width="205" height="180" border="0">
			<strong><?= $value['nome'] ?></strong><br>
			<?= "R$ ". $value['preco'] ?>
		</div>
	</a>
<?php endforeach; ?>
<div style="clear: both;"></div>