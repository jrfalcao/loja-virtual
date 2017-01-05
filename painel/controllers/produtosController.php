<?php
/**
 * Description of produtosController
 *
 * @author junior
 */
class produtosController extends controller
{
    public function index() 
    {
        $offset = 0;
        $limit = 10;
        
        if(isset($_GET['p']) && !empty($_GET['p'])){
            $p = addslashes(filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT));
            $offset = ($p * $limit)-$limit;
        }
        
        $dados = ['produtos_limit' => $limit];
        $produtos = new produtos();
        
        $dados['produtos'] = $produtos->getAll($offset, $limit);
        $dados['produtos_total'] = $produtos->getTotalProdutos();
        $this->loadTemplate("produtos", $dados);
    }

    public function add() 
    {
        if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])){
            $nome = addslashes(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING));
            $descricao = addslashes(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING));
            $categoria = addslashes(filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING));
            $preco = addslashes(filter_input(INPUT_POST, "preco", FILTER_SANITIZE_STRING));            
            $quantidade = addslashes(filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_STRING));
            $imagem = $_FILES['imagem'];           
            if(in_array($imagem['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $md5imagem = ($imagem['type'] == 'image/png') ? md5(time().rand(0,9999)) . '.png' :  md5(time().rand(0,9999)) . '.jpg';
                move_uploaded_file($imagem['tmp_name'],"../assets/img/$md5imagem");
            }           
            $prod = new produtos();
            $prod->add($nome, $descricao, $categoria, $preco, $quantidade, $md5imagem);
            header("location: /painel/produtos");
        }
        $dados = array();
        $cat = new categorias();
        $dados['categorias'] = $cat->getAll();
        $this->loadTemplate('produtos_add', $dados);
    }
    
    public function edit($id) 
    {
        $dados = array();
        $produtos = new produtos();
        $cat = new categorias();
        $produto = $produtos->get($id);
        $dados['produto'] = $produto;
        $dados['categorias'] = $cat->getAll();

        if(isset($_POST['nome'])&& !empty($_POST['nome'])){
            $nome = addslashes(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING));
            $descricao = addslashes(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING));
            $categoria = addslashes(filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_STRING));
            $preco = addslashes(filter_input(INPUT_POST, "preco", FILTER_SANITIZE_STRING));            
            $quantidade = addslashes(filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_STRING));
            $md5imagem = NULL;
            if(isset($_FILES['imagem'])&& !empty($_FILES['imagem'])){
                $imagem = $_FILES['imagem'];
                $oldImagem = "../assets/img/".$produto['imagem']."";         
                if(in_array($imagem['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                    $md5imagem = ($imagem['type'] == 'image/png') ? md5(time().rand(0,9999)) . '.png' :  md5(time().rand(0,9999)) . '.jpg';
                    move_uploaded_file($imagem['tmp_name'],"../assets/img/$md5imagem");
                    unlink($oldImagem);
                } 
            }
            $produtos->edit($id, $nome, $descricao, $categoria, $preco, $quantidade, $md5imagem);
            header("location: /painel/produtos");
        }
        
        $this->loadTemplate("produtos_edit", $dados);
    }
    
    public function remove($id) 
    {
        $dados = array();
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!empty($id)){
            $prod = new produtos();
            $prod->removeProduto($id);
            header("location: /painel/produtos");
        }else{
            $dados['aviso'] = "ERRO - Produto não encontrada";
        }
    }
}
