<?php
/**
 * Description of categoriasController
 *
 * @author junior
 */
class categoriasController extends controller
{
    public function ver($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!empty($id) && isset($id)){
            $dados = [
                'categoria' => '',
                'produtos' => [],
            ];

            $produtos = new produtos();
            $cat = new categorias();
            $dados['produtos'] = $produtos->produtosByCat($id, 8);
            if(!empty($dados['produtos'] ) && isset($dados['produtos'] )){
                $dados['categoria'] = $cat->getNome($id);
                $this->loadTemplate('categorias', $dados);
            }  else {
                header("Location: /");
            }
        }else{
            echo 'ID de categoria nao informado!!!';
        }
    }
}
