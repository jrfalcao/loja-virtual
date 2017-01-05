<h1>Todos os produtos</h1>

<?php if (isset($aviso) && !empty($aviso)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>ERRO!</strong> <?= $aviso ?>
    </div>
<?php endif; ?>
<a href="/painel/produtos/add" class="btn btn-default">Adicionar produto</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th width="200">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $prod): ?>
            <tr>
                <td><img src="/../assets/img/<?= $prod['imagem'] ?>" height="80"></td>
                <td><?= $prod['nome'] ?></td>
                <td><?= $prod['catNome'] ?></td>
                <td>R$ <?= $prod['preco'] ?>,00</td>
                <td><em><?= $prod['quantidade'] ?></em></td>
                <td>
                    <a class="btn btn-sm btn-default" href="/painel/produtos/edit/<?= $prod['id'] ?>">Editar</a> 
                    <a class="btn btn-sm btn-default" href="/painel/produtos/remove/<?= $prod['id'] ?>">Remover</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$conta = ceil($produtos_total / $produtos_limit);
for($q=1; $q<=$conta; $q++):?>
<a href="/painel/produtos?p=<?= $q ?>"><?= $q ?></a>
<?php endfor; ?>


