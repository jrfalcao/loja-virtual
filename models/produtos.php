<?php
/**
 * Description of produtos: Model da Entidade Produtos
 *
 * @author Junior Falcão
 */
class produtos extends model 
{
    /**
     * 
     * @param type INT $qt Quantidade de produtos retornados se maior que 0
     * e $id != null 
     * @param type INT $id - Se diferente de null retorna o produto específico, e 
     * $qt deverá ter valor = 1
     * @return type array com 1 ou mais produtos
     */
    public function getProdutos($qt = 0) 
    {
        $array = array();

        $sql = "select * from produtos";
        if($qt > 0 ) {$sql .= " ORDER BY RAND() LIMIT $qt";}
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function get($id) 
    {
        if(isset($id) && !empty($id)) {
            $sql = "select * from produtos WHERE id=$id";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            }
        }
        return;
    }
    public function getCarrinho($id = []) 
    {
        if(isset($id) && !empty($id)) {
            $sql = "select * from produtos WHERE id IN(".implode(',', $id).")";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                return $sql->fetchAll();
            }
        }
        return;
    }
    /**
     * 
     * @param type INT $cat - ID da categoria solicitada
     * @param type INT $qt - Quantidade LIMIT dfe retorno
     * @return type array de produtos por categoria
     */
    public function produtosByCat($cat, $qt = 0) 
    {
        $array = array();

        $sql = "select * from produtos WHERE produtos.id_categoria = $cat";
        if($qt > 0) {$sql .= " LIMIT $qt";}
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    /*public function insert(){
        for($i = 1; $i <= 99; $i++){

            $sql = "INSERT INTO `loja`.`produtos` (`id_categoria`, `nome`, `imagem`, `preco`, `quantidade`, `descricao`) VALUES (".rand(1,3).", 'Produto $i', 'imagem.jpg', ".rand(50,300).", ".rand(30,200).", 'DescriÃ§Ã£o do produto $i')";
            $this->db->query($sql);
        }
    }*/
}
