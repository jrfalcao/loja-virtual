<h1>Carrinho de Compras!</h1>
<table border="0" width="100%">
    <tr>
        <th style="text-align: left">Imagem</th>
        <th style="text-align: left">Nome</th>
        <th style="text-align: left">Preço</th>
        <th style="text-align: left">Ação</th>
    </tr>
    <?php 
    $subtotal =0;
    foreach ($produtos as $prod): ?>
    <tr>
        <td><?= $prod['imagem'] ?></td>
        <td><?= $prod['nome'] ?></td>
        <td><?= $prod['preco'] ?></td>
        <td>
            
        </td>
    </tr>
    <?php 
    $subtotal += $prod['preco'];
    endforeach; ?>
    <tr>
        <td colspan="2" style="text-align: right">Subtotal: </td>
        <td><?= $subtotal ?></td>
    </tr>
</table>
