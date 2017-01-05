<?php
/**
 * Description of vendas
 *
 * @author junior
 */
class vendas extends model{
    
    public function getVendas() {
        $array = array();
        $sql = "SELECT vendas.id, usuarios.nome, usuarios.email, vendas.valor, vendas.status_pg, pagamentos.nome as forma_pg "
                . "FROM vendas "
                . "INNER JOIN usuarios on vendas.id_usuario = usuarios.id "
                . "INNER JOIN pagamentos ON pagamentos.id = vendas.forma_pg";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getVenda($id){
        $array = array();
        $sql = "SELECT vendas.id, "
                . "usuarios.nome, "
                . "usuarios.email, "
                . "vendas.valor, "
                . "vendas.status_pg, "
                . "vendas.endereco, "
                . "vendas.pg_link, "
                . "pagamentos.nome as forma_pg "
                . "FROM vendas "
                . "INNER JOIN usuarios on vendas.id_usuario = usuarios.id "
                . "INNER JOIN pagamentos ON pagamentos.id = vendas.forma_pg "
                . "WHERE vendas.id = $id";
        $sql = $this->db->query($sql);
        
        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        return $array;
    }
    public function getProdutos($id) {
        $array = [];
        $sql = "SELECT id_produto, quantidade FROM vendas_produtos WHERE id_vendas = $id";
        $sql = $this->db->query($sql);
        if($sql->rowCount() > 0){
            $prods = $sql->fetchAll();
            
            $p = new produtos();
            foreach ($prods as $prod) {
                $pinfo = $p->get($prod['id_produto']);
                $array[] = ['id' => $pinfo['id'], 
                    'quantidade' => $prod['quantidade'],
                    'nome' => $pinfo['nome'],
                    'imagem' => $pinfo['imagem'],
                    'preco' => $pinfo['preco']
                ];
            }
        }
        return $array;
    }
}
