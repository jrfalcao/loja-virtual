<?php
/**
 * Description of HomeController
 *
 * @author junior
 */
class contatoController extends controller {
    
    public function index(){
        $dados = array('msg'=>'');
        if(isset($_POST['submitContato'] ) && !empty($_POST['submitContato'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $mensagem = addslashes($_POST['mensagem']);

            $html = "Nome: {$nome} <br> Email: {$email}<br> Mensagem: {$mensagem}";

            $header  = 'From: contato@juniorfalcao.tw'."\r\n";
            $header .= 'Replat-to: '.$email."\r\n";
            $header .= 'X-Mailer: PHP/'.phpversion();

            mail('suporte@juniorfalcao.tw', 'Contato pelo site em '.date('d/m/Y'), $html, $header);
            @$dados['msg'] = "Email enviado com sucesso!";
        }
        
        $this->loadTemplate("contato", $dados);
    }
    
}
