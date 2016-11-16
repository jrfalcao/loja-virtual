<?php
/**
 * Description of HomeController
 *
 * @author junior
 */
class contatoController extends controller {
    
    public function index(){
        $dados = array();
        
        $this->loadTemplate("contato", $dados);
    }
    
}
