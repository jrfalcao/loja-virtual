<?php

/**
 * Description of carrinhoController
 *
 * @author junior
 */
class carrinhoController extends controller {

    public function index() {
        $dados = [];
        $p = new produtos();
       
        $dados['produtos'] = $p->getCarrinho($_SESSION['carrinho']) ;
        $this->loadTemplate('carrinho', $dados);
    }

    public function add($id = '') {
        if (!empty($id)) {
            $_SESSION['carrinho'][] = $id;
            header("Location: /carrinho");
        }
    }

}