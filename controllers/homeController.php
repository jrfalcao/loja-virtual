<?php
/**
 * Description of HomeController
 *
 * @author junior
 */
class homeController extends controller {
    
    public function index(){
        $dados = array();
        
        $this->loadTemplate("home", $dados);
    }
    
}
