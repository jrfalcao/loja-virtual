<h1>Seu pedido!</h1>

<table width="100%" border="0">
    <tr>
        <th>Nº do Pedido</th>
        <th>Valor pago</th>
        <th>Forma de Pgto</th>
        <th>Statos do Pgto</th>
    </tr>
    <?php global $config; ?>
    <tr>
        <td><?= $pedido['id'] ?></td>
        <td><?= $pedido['valor'] ?></td>
        <td><?= $pedido['forma_pg'] ?></td>
        <td><?= $config['status_pgto'][$pedido['status_pg']] ?></td>
    </tr>
</table>
<hr>
<?php foreach($pedido['produtos'] as $produto): ?>
<div class="pedido_produto">
    <img src="/assets/img/<?= $produto['imagem'];?>" border="0" width="100" /><br>
    <?= $produto['nome'];?><br>
    R$ <?= $produto['preco'];?><br>
    Quantidade <?= $produto['quantidade'];?>
</div>
<?php endforeach; ?>
<div style="clear: both"></div>

