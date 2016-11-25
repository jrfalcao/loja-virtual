<?php

/**
 * Description of carrinhoController
 *
 * @author junior
 */
class carrinhoController extends controller 
{
    public function index() 
    {
        $dados = [];
        $p = new produtos();
        if($p->getCarrinho($_SESSION['carrinho'])){
            $dados['produtos'] = $p->getCarrinho($_SESSION['carrinho']) ;
            $this->loadTemplate('carrinho', $dados);
        }else{
            header("Location: /");
        }
    }

    public function add($id = '') 
    {
        if (!empty($id)) {
            $_SESSION['carrinho'][] = $id;
            header("Location: /carrinho");
        }
    }

    public function del($id) 
    {
            foreach($_SESSION['carrinho'] as $key => $value){
                if($value == $id){
                    unset($_SESSION['carrinho'][$key]);
                }
                break;
            }
            header("Location: /carrinho");
    }

    public function finalizar()
    {
        var_dump($_SESSION['carrinho']);
    }

}
