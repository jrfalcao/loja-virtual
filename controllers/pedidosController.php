<?php
/**
 * Description of cpedidosController
 *
 * @author junior
 */
class pedidosController extends controller
{
    public function index() 
    {
        $dados = [];
        $this->loadTemplate('pedidos', $dados);
    }
}
