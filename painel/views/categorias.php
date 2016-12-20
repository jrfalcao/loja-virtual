<h1>Página de categorias</h1>
<?php if (isset($aviso) && !empty($aviso)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>ERRO!</strong> <?= $aviso ?>
    </div>
<?php endif; ?>
<a href="/painel/categorias/add" class="btn btn-default">Adicionar categoria</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th width="200">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $cat): ?>
            <tr>
                <td><?= $cat['titulo'] ?></td>
                <td>
                    <a class="btn btn-sm btn-default" href="/painel/categorias/edit/<?= $cat['id'] ?>">Editar</a> 
                    <a class="btn btn-sm btn-default" href="/painel/categorias/remove/<?= $cat['id'] ?>">Remover</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>