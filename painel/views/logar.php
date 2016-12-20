<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/../assets/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/painel/assets/css/template.css" rel="stylesheet" type="text/css"/>

        <script src="/../assets/bootstrap/docs/assets/js/vendor/jquery.min.js" type="text/javascript"></script>
        <script src="/../assets/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

        <title>Minha Loja</title>
    </head>
    <body>
        <div class="container_login">
            <h1>Login Painel!</h1>
            <?php if (isset($aviso) && !empty($aviso)): ?>
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
                <input type="submit" value="Entrar" class="btn btn-success btn-block"><br><br>
            </form>
        </div>
    </body>
</html>
