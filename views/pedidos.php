<h1>Seus pedidos</h1><br>
<a href="/login/logout">Sair</a>

<table width="100%" border="0">
    <tr>
        <th>Nº do Pedido</th>
        <th>Valor pago</th>
        <th>Forma de Pgto</th>
        <th>Statos do Pgto</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($pedidos as $p): 
     global $config;
     ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['valor'] ?></td>
        <td><?= $p['forma_pg'] ?></td>
        <td><?= $config['status_pgto'][$p['status_pg']] ?></td>
        <td><a href="/pedidos/ver/<?= $p['id'] ?>">Detalhes</a></td>
    </tr>
    <?php endforeach; ?>
</table>

