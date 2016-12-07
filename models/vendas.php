<?php
/**
 * Description of produtos: Model da Entidade Vendas
 *
 * @author Junior Falcão
 */
class vendas extends model 
{
    public function setVendas($uid, $endereco, $valor, $forma_pg, $prods) {
        /**
         * Formas de Status de pagamento
         * 1 => Aguardando pg
         * 2 => Aprovado
         * 3 => Cancelado
         */
        $status_pg = '1';
        $pg_link = '';
        $sql = $this->db->prepare("INSERT INTO vendas SET id_usuario = ?, endereco = ?, valor = ?, forma_pg = ?, status_pg = ?, pg_link = ?");
        $sql->execute([
            $uid, $endereco, $valor, $forma_pg, $status_pg, $pg_link
        ]);
        $id_venda = $this->db->lastInsertId();
        
        if($forma_pg == 1){
            $status_pg = '2';
            $pg_link = "/carrinho/obrigado";
            $this->db->query("UPDATE vendas set status_pg = '$status_pg' WHERE id = '".$id_venda."'");
        }elseif ($forma_pg == 2) {
            //Integração com PagSeguro
            require "libraries/PagSeguroLibrary/PagSeguroLibrary.php";
            $paymentRequest = new PagSeguroPaymentRequest();
            foreach ($prods as $prod) {
                $paymentRequest->addItem($prod['id'], $prod['nome'], 1, $prod['preco']);
            }
            $paymentRequest->setCurrency('BRL');
            $paymentRequest->setReference($id_venda);
            $paymentRequest->setRedirectUrl("http://loja.pc/carrinho/obrigado");
            $paymentRequest->addParameter("notificationURL", "http://loja.pc/carrinho/notificacao");
            try{
                $cred = PagSeguroConfig::getAccountCredentials();
                $pg_link = $paymentRequest->register($cred);
            }catch(PagSeguroServiceException $e){
                $e->getMessage();
            }
        }
                
        foreach ($prods as $pd) {
            $sql = $this->db->prepare("INSERT INTO vendas_produtos SET id_vendas = ?, id_produto = ?, quantidade = ?");
            $sql->execute([$id_venda, $pd['id'], 1]);
        }
        unset($_SESSION['carrinho']);
        return $pg_link;
    }
}