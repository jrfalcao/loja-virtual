<?php
/**
 * Description of produtos
 *
 * @author junior
 */
class produtos extends model
{
    public function add($nome, $descricao, $categoria, $preco, $quantidade, $md5imagem) 
    {
        $nome = addslashes($nome);
        $descricao = addslashes($descricao);
        $categoria = addslashes($categoria);
        $preco = addslashes($preco);
        $quantidade = addslashes($quantidade);
        $imagem = addslashes($md5imagem);
        if(isset($nome) && !empty($nome) && isset($imagem) && !empty($imagem)){
            $sql = "INSERT INTO `loja`.`produtos` (`id_categoria`, `nome`, `imagem`, `preco`, `quantidade`, `descricao`) VALUES ('$categoria', '$nome', '$imagem', '$preco', '$quantidade', '$descricao')";
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
        $sql = "DELETE FROM produtos WHERE id = '".($id)."'";
        $this->db->query($sql);
    }
    
    /*public function edit($titulo, $id) {
        $titulo = addslashes($titulo);
        $id = addslashes($id);
        $sql = "UPDATE categorias SET titulo = '$titulo' WHERE id = '$id'";
        $this->db->query($sql);
    }*/
    
    public function get($id) {
        $sql = "SELECT * FROM produtos WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return NULL;
    }
}
