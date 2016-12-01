<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/assets/css/template.css" rel="stylesheet" type="text/css"/>
        
        <script src="/assets/bootstrap/docs/assets/js/vendor/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        
        <title>Minha Loja</title>
    </head>
    <body>
        <div class="topo"></div>
        <div class="menu">
            <div class="menuint">
                <ul>
                    <a href="/"><li>Home</li></a>
                    <a href="/empresa"><li>Empresa</li></a>
                    <?php foreach($viewData['categorias'] as $categoria):?>
                        <a href="/categorias/ver/<?=  $categoria['id']?>"><li><?= $categoria['titulo']?></li></a>
                    <?php endforeach;?>
                    <a href="/contato"><li>contato</li></a>
                </ul>
                <a href="/carrinho">
                    <div class="carrinho">
                        <?php echo (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) ? "Carrinho: ".count($_SESSION['carrinho']).' Itens' : '';?>
                    </div>
                </a>
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
