<?php

/**
 * Description of loginController
 *
 * @author junior
 */
class loginController extends controller {

    public function index() {
        $dados = [];
        $u = new usuario();

        if (!empty($_POST['email']) && isset($_POST['email'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = md5(filter_input(INPUT_POST, 'senha'));
            $user = $u->getUsuarioPorEmail($email); 
            if ($user !== NULL && ($email == $user['email'] && $senha == $user['senha'])) {
                $_SESSION['cliente'] = $user['id'];
                header("Location: /pedidos");
            } else {
                $dados['aviso'] = "Os dados de email e/ou senha não estão corretos";
            }
        }

        $this->loadTemplate('login', $dados);
    }

    public function logout() {
        unset($_SESSION['cliente']);
        header("Location: /login");
    }

}
