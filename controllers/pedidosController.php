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
        if(isset($_SESSION['cliente']) && !empty($_SESSION['cliente'])){
            $vendas = new vendas();
            $dados['pedidos'] = $vendas->getPedidosByClienteID($_SESSION['cliente']);
            $this->loadTemplate('pedidos', $dados);
        }  else {
            header("Location: /login");
        }
    }
    
    public function ver($id) {
        if(!empty($id)){
            $dados = [];
            $v = new vendas();
            if($venda = $v->getVenda($id, $_SESSION['cliente'])){
                $dados['pedido'] = $venda;
                
        //var_dump($dados['pedido']);exit;
            }else{
                header("location: /pedidos");
            }
            $this->loadTemplate('pedidos_ver', $dados);
        }else{
            header("location: /pedidos");
        }
    }
}
