<?php
/**
 * Description of produtos: Model da Entidade Usuarios
 *
 * @author Junior Falcão
 */
class usuario extends model 
{
    public function getUsuarioPorEmail($email) 
    {
        if(isset($email) && !empty($email)) {
            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            }
        }
        return;
    }
}
