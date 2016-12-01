<?php if(isset($erro)): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>ERRO!</strong> <?= $erro ?>.
</div>
<?php endif ?>
<h1>Finalizar Compra</h1>
<br>
<form method="POST">
    <fieldset>
        <legend>Informações de usuário</legend>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Nome</span>
            <input type="text" name="nome" class="form-control" placeholder="Username">
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email</span>
            <input type="email" name="email" class="form-control" placeholder="Email">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Senha</span>
            <input type="password" name="senha" class="form-control" >
        </div>
    </fieldset><br>
    <fieldset>
        <legend>Informações de endereço</legend>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Endereço</span>
            <textarea name="endereco" class="form-control" ></textarea>
        </div>
    </fieldset><br>
    <fieldset>
        <legend>Resumo da Compra</legend>
        <h4>Total a pagar: R$ <?= $total ?>,00</h4>
        <h4>Itens da compra:</h4>
        <table class="table" border="0" width="70%">
            <?php
            foreach ($produtos as $prod):?>
                <tr>
                    <td><?= $prod['nome'] ?></td>
                    <td>R$ <?= $prod['preco'] ?>,00</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </fieldset><br>
    <fieldset>
        <legend>Informações de pagamento</legend>
            <?php foreach ($pagamentos as $pg):
                if ($pg['id'] != 1):
                    ?>
                <span style="margin-right: 15px"><input type="radio" name="pg" value="<?= $pg['id'] ?>"> <?= $pg['nome'] ?></span>
    <?php endif;
endforeach; ?>
    </fieldset><br>
    <input type="submit" value="Efetuar Pagamento"><br><br>
</form>
