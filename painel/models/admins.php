<?php
/**
 * Description of produtos: Model da Entidade Admins
 *
 * @author Junior Falcão
 */
class admins extends model 
{
    public function getAdminPorEmail($email) 
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
    
    public function insertAdmin($email, $senha) {
        $sql = "INSERT INTO usuarios SET email = '$email', senha = '$senha'";
        $this->db->query($sql);
        
        return $this->db->lastInsertId();
    }
}
