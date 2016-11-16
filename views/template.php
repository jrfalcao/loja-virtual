<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="assets/css/template.css" rel="stylesheet" type="text/css"/>
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
                        <a href="/<?=  strtolower($categoria['titulo'])?>"><li><?= $categoria['titulo']?></li></a>
                    <?php endforeach;?>
                    <a href="/contato"><li>contato</li></a>
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
