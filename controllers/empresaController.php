<?php
/**
 * Description of HomeController
 *
 * @author junior
 */
class empresaController extends controller {
    
    public function index(){
        $dados = array();
        
        $this->loadTemplate("empresa", $dados);
    }
    
}
