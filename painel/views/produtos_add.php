<div>
<form method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend>Adicionar Produto</legend>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome</span>
            <input type="text" name="nome" class="form-control" placeholder="Nome do produto">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Descrição</span>
            <textarea rows="" cols="" name="descricao" class="form-control"></textarea>            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Categoria</span>
            <select name="categoria"  class="form-control">
                <?php foreach($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['titulo'] ?></option>
                <?php endforeach; ?>
            </select>            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Preço</span>
            <input type="text" name="preco" class="form-control">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Quantidade</span>
            <input type="text" name="quantidade" class="form-control">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">imagem</span>
            <input type="file" name="imagem" class="form-control">            
        </div>
    </fieldset><br>
    <input type="submit" value="Salvar" class="btn btn-default btn-block"><br><br>
</form>
</div>
