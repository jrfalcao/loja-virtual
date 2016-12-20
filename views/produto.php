<div class="produto_foto">
    <img alt="" src="/assets/img/<?= $produto['imagem'] ?>" width="300" height="300" border="0">
</div>
<section class="produto_desc">
    <div class="prod_title_desc">
        <h2><?= $produto['nome'] ?></h2>
        <p><?= $produto['descricao'] ?></p>
    </div>
    <div class="preco">
        <span>R$ <?= $produto['preco'].",00" ?></span><br>
        <a href="/carrinho/add/<?= $produto['id'] ?>">Adicionar Ao Carrinho</a>
    </div>
    <div style="clear: both"></div>
</section>
<div style="clear: both"></div>

