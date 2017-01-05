<?php
/**
 * Description of vendasController
 *
 * @author junior
 */
class vendasController extends controller
{
    public function index() {
        $dados = array();
        $vendas = new vendas();
        $dados['vendas'] = $vendas->getVendas();
        //var_dump($dados['vendas']);exit;
        $this->loadTemplate('vendas', $dados);
    }
    
    public function ver($id) {
        $dados = array();
        if(!empty(filter_var($id, FILTER_VALIDATE_INT))){
            $vendas = new vendas();
            $dados['venda'] = $vendas->getVenda($id);
            $dados['produtos'] = $vendas->getProdutos($id);
        }
        $this->loadTemplate('vendas_ver', $dados);
    }
}
