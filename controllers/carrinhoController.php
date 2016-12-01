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
        if ($p->getCarrinho($_SESSION['carrinho'])) {
            $dados['produtos'] = $p->getCarrinho($_SESSION['carrinho']);
            $this->loadTemplate('carrinho', $dados);
        } else {
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
        foreach ($_SESSION['carrinho'] as $key => $value) {
            if ($value == $id) {
                unset($_SESSION['carrinho'][$key]);
            }
            break;
        }
        header("Location: /carrinho");
    }

    public function finalizar() 
    { 
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
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));
            $endereco = addslashes($_POST['endereco']);

            if(!empty($_POST['pg'])) $pg = addslashes($_POST['pg']);
            else $pg = '';
            
            if(!empty($email) && !empty($senha) && !empty($endereco) && !empty($pg)){
                $u = new usuario();
                $user = $u->getUsuarioPorEmail($email);
                if($user){                    
                    if($senha == $user['senha']){
                        echo "Logou!";
                    }
                }else{
                    echo "Não encontrado";
                }

            }else{
                $dados['erro'] = "Preencha todos os campos!!!";
            }
        }
        $this->loadTemplate('finalizar_compra', $dados);
    }
}
