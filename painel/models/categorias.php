<?php
/**
 * Description of categorias
 *
 * @author junior
 */
class categorias extends model
{
    public function add($titulo) {
        $titulo = addslashes($titulo);
        if(isset($titulo) && !empty($titulo)){
            $sql = "INSERT INTO categorias SET titulo = '".($titulo)."'";
            $this->db->query($sql);
        }
    }
    public function getAll() 
    {
        $array = array();

        $sql = "select * from categorias";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function removeCategoria($id) {
        $id = addslashes($id);
        $sql = "DELETE FROM categorias WHERE id = '".($id)."'";
        $this->db->query($sql);
        $sql = "DELETE FROM produtos WHERE id_categoria = '".($id)."'";
        $this->db->query($sql);
    }
    
    public function edit($titulo, $id) {
        $titulo = addslashes($titulo);
        $id = addslashes($id);
        $sql = "UPDATE categorias SET titulo = '$titulo' WHERE id = '$id'";
        $this->db->query($sql);
    }
    
    public function get($id) {
        $sql = "SELECT * FROM categorias WHERE id = '$id'";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
        return NULL;
    }
    
    
}
