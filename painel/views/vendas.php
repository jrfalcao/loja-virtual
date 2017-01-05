<h1>Controle das Vendas</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Cliente</th>
            <th>Valor</th>
            <th>Forma de Pagamento</th>
            <th>Status da Venda</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        global $config;
        foreach($vendas as $venda):?>
        <tr>
            <td><?= $venda['id']?></td>
            <td><?= $venda['nome'].' - '.$venda['email']?></td>
            <td><?= $venda['valor']?></td>
            <td><?= $venda['forma_pg']?></td>
            <td><?= $config['status_pgto'][$venda['status_pg']]?></td>
            <td><a href="/painel/vendas/ver/<?=$venda['id']?>">Visualizar</a></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>