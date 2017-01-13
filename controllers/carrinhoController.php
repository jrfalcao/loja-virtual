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
        if ($p->getCarrinho($_SESSION['carrinho'])) {
            $dados['produtos'] = $p->getCarrinho($_SESSION['carrinho']);
            $this->loadTemplate('carrinho', $dados);
        } else {
            header("Location: /");
        }
    }

    public function add($id = '') {
        if (!empty($id)) {
            $_SESSION['carrinho'][] = $id;
            header("Location: /carrinho");
        }
    }

    public function del($id) {
        foreach ($_SESSION['carrinho'] as $key => $value) {
            if ($value == $id) {
                unset($_SESSION['carrinho'][$key]);
            }
            break;
        }
        header("Location: /carrinho");
    }

    public function finalizar() {
        $dados = array();
        require 'libraries/PagSeguroLibrary/PagSeguroLibrary.php';
        $prods = array();
        if (isset($_SESSION['carrinho'])) {
            $prods = $_SESSION['carrinho'];
        }
        if (count($prods) > 0) {
            $produtos = new produtos();
            $dados['produtos'] = $produtos->getCarrinho($prods);
            foreach ($dados['produtos'] as $prod) {
                $dados['total'] = $prod['preco'];
            }
        }
        if (isset($_POST['pg_form']) && !empty($_POST['pg_form'])) {
            $nome = addslashes(filter_input(INPUT_POST, 'nome'));
            $email = addslashes(filter_input(INPUT_POST, 'email'));
            $senha = addslashes(filter_input(INPUT_POST, 'senha'));
            $sessionId = addslashes(filter_input(INPUT_POST, 'sessionId'));
            if(!empty($email) && !empty($senha)){
                $uid = 0;
                $u = new usuario();
                if($user = $u->getUsuarioPorEmail($email)){
                    if($user['senha'] === $senha){
                        $uid = $user['id'];
                    }else{
                        $dados['erro'] = "Usuario e/ou senha errado!";
                    }
                }else{
                    $uid = $u->insertUser($nome, $email, $senha);
                }
            }else{
                $dados['erro'] = "Preencha todos os campos!";
            }
            
            if($uid > 0){
                $vendas = new vendas();
                $venda = $vendas->setVendaCKTransparenre($_POST, $uid, $sessionId, $dados['produtos'], $dados['total']);
            }
            
        } else {
            try {
                $credentials = PagSeguroConfig::getAccountCredentials();
                $dados['sessionId'] = PagSeguroSessionService::getSession($credentials);
            } catch (PagSeguroServiceException $e) {
                die($e->getMessage());
            }
        }
        $this->loadTemplate('finalizar_compra', $dados);
    }

    public function notificacao() {
        $vendas = new vendas();
        $vendas->verificarVendas();
    }

    public function obrigado() {
        $dados = array();
        $this->loadTemplate('obrigado', $dados);
    }

}
