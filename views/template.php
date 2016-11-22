<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="/assets/css/template.css" rel="stylesheet" type="text/css"/>
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
                        <?php echo (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) ? "Carrinho: ".count($_SESSION['carrinho']) : '';?>
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
