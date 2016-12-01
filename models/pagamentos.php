<?php
/**
 * Description of pagamentos
 *
 * @author junior
 */
class pagamentos extends model
{
    public function get() 
    {
        $array = array();
        $sql = $this->db->prepare("SELECT * from pagamentos");
        if($sql->execute()){
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
}
