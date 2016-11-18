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
        $dados['produto'] = $produtos->get($id);
        $this->loadTemplate('produto', $dados);
    }
}
