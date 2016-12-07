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
        $dados = array('total' => 0);
        $p = new pagamentos();
        $dados['pagamentos'] = $p->get();

        $p = new produtos();
        if ($p->getCarrinho($_SESSION['carrinho'])) {
            $dados['produtos'] = $p->getCarrinho($_SESSION['carrinho']);
            foreach ($dados['produtos'] as $prod) {
                $dados['total'] += $prod['preco'];
            }
        }
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));
            $endereco = addslashes($_POST['endereco']);

            if (!empty($_POST['pg']))
                $pg = addslashes($_POST['pg']);
            else
                $pg = '';

            if (!empty($email) && !empty($senha) && !empty($endereco) && !empty($pg)) {
                $total = 0;
                $u = new usuario();
                if ($u->getUsuarioPorEmail($email)) {
                    $user = $u->getUsuarioPorEmail($email);
                    if ($senha == $user['senha']) {
                        $uid = $user['id'];
                    } else {
                        $dados['erro'] = "Usuário e/ou senha incorretos!";
                    }
                } else {
                    $uid = $u->insertUser($nome, $email, $senha);
                }
                if ($uid > 0) {
                    $prods = $p->getCarrinho($_SESSION['carrinho']);
                    foreach ($prods as $prod){
                        $total += $prod['preco'];
                    }
                }
                $v = new vendas();
                $link = $v->setVendas($uid, $endereco, $total, $pg, $prods);
                
                header("Location: ".$link);
                
            } else {
                $dados['erro'] = "Preencha todos os campos!!!";
            }
        }
        $this->loadTemplate('finalizar_compra', $dados);
    }
    
    public function obrigado() {
        $dados = array();       
        $this->loadTemplate('obrigado', $dados);
    }

}
