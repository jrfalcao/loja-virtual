<?php //var_dump($venda, $produtos);?>
<h1>Vendas</h1>

<h3>Produtos da venda</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $prod): ?>
        <tr>
                <td><img src="/../assets/img/<?= $prod['imagem'] ?>" height="70" /></td>
                <td style="padding-top: 20px"><?= $prod['nome'] ?></td>
                <td style="padding-top: 20px"><?= $prod['quantidade'] ?></td>
                <td style="padding-top: 20px"><?= 'R$ '.$prod['preco'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>