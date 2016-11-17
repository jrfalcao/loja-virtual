<?php
/**
 * Description of categoriasController
 *
 * @author junior
 */
class produtosController extends controller
{
    public function ver($id) {
        $dados = [
            'produto' => '',
        ];
        
        $produtos = new produtos();
        $dados['produto'] = $produtos->get(1,$id);
        var_dump($dados['produto']);exit;
        $this->loadTemplate('produto', $dados);
    }
}
