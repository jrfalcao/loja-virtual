<?php
/**
 * Description of loginController
 *
 * @author junior
 */
class loginController extends controller {

    public function index() {
        $dados = [];
        $admin = new admins();

        if (!empty($_POST['email']) && isset($_POST['email'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = md5(filter_input(INPUT_POST, 'senha'));
            $user = $admin->getAdminPorEmail($email); 
            if ($user !== NULL && ($email == $user['email'] && $senha == $user['senha'])) {
                $_SESSION['admin'] = $user['id'];
                header("Location: /painel");
            } else {
                $dados['aviso'] = "Os dados de email e/ou senha não estão corretos";
            }
        }
        $this->loadView('logar', $dados);
    }

    public function logout() {
        unset($_SESSION['admin']);
        header("Location: /painel/login");
    }
}
