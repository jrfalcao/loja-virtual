<div>
<form method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Editar Produto</legend>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome</span>
            <input type="text" name="nome" class="form-control" value="<?=$produto['nome']?>">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Descrição</span>
            <textarea rows="" cols="" name="descricao" class="form-control"><?=$produto['descricao']?></textarea>            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Categoria</span>
            <select name="categoria"  class="form-control">
                <?php foreach($categorias as $cat): ?>
                <option <?php echo ($cat['id'] == $produto['id_categoria'])? 'selected="selected"': '' ?> value="<?= $cat['id'] ?>"><?= $cat['titulo'] ?></option>
                <?php endforeach; ?>
            </select>            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Preço</span>
            <input type="text" name="preco" class="form-control" value="<?=$produto['preco']?>">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Quantidade</span>
            <input type="text" name="quantidade" class="form-control" value="<?=$produto['quantidade']?>">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">imagem</span>
            <input type="file" name="imagem" class="form-control">            
        </div><br>
        <div><img src="/../assets/img/<?=$produto['imagem']?>" width="150"></div>
    </fieldset><br>
    <input type="submit" value="Salvar" class="btn btn-default btn-block"><br><br>
</form>
</div>
