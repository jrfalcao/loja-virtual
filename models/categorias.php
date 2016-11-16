<?php
/**
 * Description of categorias
 *
 * @author junior
 */
class categorias extends model {

    public function get() {
        $array = array();

        $sql = "select * from categorias";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}
