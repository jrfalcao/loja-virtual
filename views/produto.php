<div class="produto_foto">
    <img alt="" src="<?= $produto['imagem'] ?>" border="0">
</div>
<section class="produto_desc">
    <div class="prod_title_desc">
        <h2><?= $produto['nome'] ?></h2>
        <p><?= $produto['descricao'] ?></p>
    </div>
    <div class="preco">
        <span>R$ <?= $produto['preco'] ?></span>
        <a href="#">Adicionar Ao Carrinho</a>
    </div>
</section>
<div style="clear: both"></div>

