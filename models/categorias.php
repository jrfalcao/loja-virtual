<?php
/**
 * Description of categorias
 *
 * @author junior
 */
class categorias extends model 
{
    public function getAll($id = null) 
    {
        $array = array();

        $sql = "select * from categorias";
        if($id != null){$sql .=" WHERE id = $id";}
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getNome($id = null) 
    {
        $sql = "select titulo from categorias WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
    }
}
