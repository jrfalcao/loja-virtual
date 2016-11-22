<h1>Carrinho de Compras!</h1>
<table border="0" width="100%">
    <tr>
        <th style="text-align: left">Imagem</th>
        <th style="text-align: left">Nome</th>
        <th style="text-align: left">Preço</th>
        <th style="text-align: left">Ação</th>
    </tr>
    <?php 
    if(isset($produtos) && !empty($produtos)):
    $subtotal =0;
    foreach ($produtos as $prod): ?>
    
    <tr>
        <td><?= $prod['imagem'] ?></td>
        <td><?= $prod['nome'] ?></td>
        <td><?= $prod['preco'] ?></td>
        <td>
            <a href="/carrinho/del/<?= $prod['id'] ?>">Excluir</a>
        </td>
    </tr>
    <?php 
    $subtotal += $prod['preco'];
    endforeach;
    else: header("Location: /"); 
    endif; 
    ?>
    <tr>
        <td colspan="2" style="text-align: right">Subtotal: </td>
        <td><?= $subtotal ?></td>
        <td><a href="/carrinho/finalizar"><button type="submit">Finalizar Compra</button></a></td>
    </tr>
</table>
