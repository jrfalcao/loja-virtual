<h3>Categoria: <?= $categoria['titulo'] ?></h3>
<?php foreach ($produtos as $value): ?>
    <a href="/produtos/ver/<?=  $value['id']?>">
        <div class="produto">
                <img src="/assets/img/<?= $value['imagem'] ?>" width="205" height="180" border="0">
                <strong><?= $value['nome'] ?></strong><br>
                <?= "R$ ". $value['preco'] ?>
        </div>
    </a>
<?php endforeach; ?>
<div style="clear: both;"></div>