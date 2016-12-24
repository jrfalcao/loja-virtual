<?php
/**
 * Description of categoriasController
 *
 * @author junior
 */
class categoriasController extends controller
{
    public function index() 
    {
        $dados = [];
        $categorias = new categorias();
        $dados['categorias'] = $categorias->getAll();
        $this->loadTemplate("categorias", $dados);
    }
    public function add() 
    {
        if(isset($_POST['titulo'])&& !empty($_POST['titulo'])){
            $titulo = addslashes(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING));
            $cat = new categorias();
            $cat->add($titulo);
            header("location: /painel/categorias");
        }
        $this->loadTemplate('categoria_add');
    }
    
    public function edit($id) 
    {
        $dados = array();
        $cat = new categorias();
        if(isset($_POST['titulo'])&& !empty($_POST['titulo'])){
            $titulo = addslashes(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING));
            $cat->edit($titulo, $id);
            header("location: /painel/categorias");
        }
        if($categoria = $cat->get($id)){
            $dados['categoria'] = $categoria['titulo'];
            $this->loadTemplate("categoria_edit", $dados);
        }
    }
    
    public function remove($id) 
    {
        $dados = array();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!empty($id)){
            $cat = new categorias();
            $cat->removeCategoria($id);
            header("location: /painel/categorias");
        }else{
            $dados['aviso'] = "ERRO - Categoria não encontrada";
        }
    }
}
