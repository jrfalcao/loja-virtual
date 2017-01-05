<?php
/**
 * Description of produtos
 *
 * @author junior
 */
class produtos extends model
{
    public function add($nome, $descricao, $categoria, $preco, $quantidade, $imagem) 
    {
        if(isset($nome) && !empty($nome) && isset($imagem) && !empty($imagem)){
            $sql = "INSERT INTO loja.produtos (`id_categoria`, `nome`, `imagem`, `preco`, `quantidade`, `descricao`) "
                                        . "VALUES ($categoria, '$nome', '$imagem', $preco, $quantidade, '$descricao')";
            $this->db->query($sql);
        }
    }
    public function getAll($offset, $limit) 
    {
        $array = array();

        $sql = "select *,(select categorias.titulo from categorias where categorias.id = produtos.id_categoria) as catNome from produtos LIMIT $offset, $limit";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getTotalProdutos() {
        $sql = $this->db->query("SELECT count(*) as c FROM loja.produtos");
        return $sql->fetch()['c'];
    }
    
    public function removeProduto($id) {
        $id = addslashes($id);
        $prod = $this->get($id);
        $filename = "../assets/img/".$prod['imagem']."";
        unlink($filename);
        $sql = "DELETE FROM produtos WHERE id = '".($id)."'";
        $this->db->query($sql);
    }
    
    public function edit($id, $nome, $descricao, $categoria, $preco, $quantidade, $imagem = null) {
        $id = addslashes($id);
        //var_dump($id, $nome, $descricao, $categoria, $preco, $quantidade, $imagem);exit;
        $sql = ($imagem != null) ? "UPDATE produtos SET nome = '$nome', descricao = '$descricao', id_categoria = '$categoria', preco = '$preco', quantidade = '$quantidade', imagem = '$imagem' WHERE id = '$id'"
                                : "UPDATE produtos SET nome = '$nome', descricao = '$descricao', id_categoria = '$categoria', preco = '$preco', quantidade = '$quantidade' WHERE id = '$id'";
        $this->db->query($sql);
    }
    
    public function get($id) {
        $sql = "SELECT * FROM produtos WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return NULL;
    }
}
