<h1>Página de login!</h1>
<?php if(isset($aviso) && !empty($aviso)):?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>ERRO!</strong> <?= $aviso ?>
    </div>
<?php endif; ?>
<br>
<form method="POST">
    <fieldset>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email</span>
            <input type="email" name="email" class="form-control" placeholder="Email">            
        </div><br>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Senha</span>
            <input type="password" name="senha" class="form-control" >
        </div>
    </fieldset><br>
    <input type="submit" value="Entrar" class="btn btn-success"><br><br>
</form>

