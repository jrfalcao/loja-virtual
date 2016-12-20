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
        <div class="menu">
            <div class="menuint">
                <ul>
                    <a href="/painel/"><li>Home</li></a>
                    <a href="/painel/categorias"><li>Categorias</li></a>
                    <a href="/painel/produtos"><li>Produtos</li></a>
                    <a href="/painel/vendas"><li>Vendas</li></a>
                    <a href="/painel/usuarios"><li>Usuários</li></a>
                    <a href="/painel/login/logout" style="float: right"><li>Sair</li></a>
                </ul>
            </div>
        </div>
        <div class="container">
            <?php
                $this->loadViewInTemplate($viewName, $viewData);
            ?>
        </div>
    </body>
    <footer class="footer">Rodapé do site!!! <?= date('Y'); ?></footer>
</html>
