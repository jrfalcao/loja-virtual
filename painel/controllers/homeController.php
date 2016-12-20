<?php
/**
 * Description of HomeController
 *
 * @author junior
 */
class homeController extends controller 
{ 
    use helper;
    public function __construct() {
        if(!$this->isLogged()){
            header("Location: /painel/login");
        }
    }
    public function index()
    {
        $dados = array();
        
        $this->loadTemplate("home", $dados);
    }
}
