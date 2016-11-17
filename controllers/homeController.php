<?php
/**
 * Description of HomeController
 *
 * @author junior
 */
class homeController extends controller 
{    
    public function index()
    {
        $dados = array();
        $p = new produtos();
        $dados['produtos'] = $p->get(8);
        
        $this->loadTemplate("home", $dados);
    }
    
}
