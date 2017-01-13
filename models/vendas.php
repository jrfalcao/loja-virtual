<?php

/**
 * Description of produtos: Model da Entidade Vendas
 *
 * @author Junior Falcão
 */
class vendas extends model 
{
    public function getPedidosByClienteID($id) 
    {
        $array = array();

        $sql = "select *,(select pagamentos.nome from pagamentos WHERE pagamentos.id = vendas.forma_pg) as forma_pg from vendas WHERE vendas.id_usuario = $id";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getVenda($id, $id_usuario) 
    {
        $array = [];
        $sql = "select *,(select pagamentos.nome from pagamentos WHERE pagamentos.id = vendas.forma_pg) as forma_pg from vendas WHERE id = $id AND id_usuario = '".($id_usuario)."'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['produtos'] = $this->getProdutosDoPedido($id);
        }
        
        //var_dump($array);exit;
        return $array;
    }
    public function getProdutosDoPedido($id) {
        $array = array();
        $sql = "SELECT "
                . "vendas_produtos.quantidade, vendas_produtos.id_produto, "
                . "produtos.nome, produtos.imagem, produtos.preco "
                . "from vendas_produtos "
                . "LEFT JOIN produtos ON vendas_produtos.id_produto = produtos.id "
                . "WHERE vendas_produtos.id_vendas = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function verificarVendas() 
    {
        require "libraries/PagSeguroLibrary/PagSeguroLibrary.php";

        $code = '';
        $type = '';

        if (isset($_POST['notificationCode']) && isset($_POST['notificationType'])) {
            $code = trim($_POST['notificationCode']);
            $type = trim($_POST['notificationType']);
            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();

            $credentials = PagSeguroConfig::getAccountCredentials();
            try {
                $transection = PagSeguroNotificationService::checkTransaction($credentials, $code);
                $ref = $transection->getReference();
                $status = $transection->getStatus()->getValue();
                
                $novoStatus = '0';
                switch ($status) {
                    case '1': //Aguardando Pagamento 
                    case '2': //Em análise
                        $novoStatus = '1';
                        break;
                    case '3': //Pago
                    case '4': //Disponivel
                        $novoStatus = '2';
                        break;
                    case '6': //Devolvida
                    case '7': //Cancelada
                        $novoStatus = '3';
                        break;
                }
                
                $this->db->query("UPDATE vendas SET  status_pg = '$novoStatus' WHERE id = '$ref'");
            } catch (PagSeguroServiceException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function setVendas($uid, $endereco, $valor, $forma_pg, $prods) 
    {
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

        if ($forma_pg == 1) {
            $status_pg = '2';
            $pg_link = "/carrinho/obrigado";
            $this->db->query("UPDATE vendas set status_pg = '$status_pg' WHERE id = '" . $id_venda . "'");
        } elseif ($forma_pg == 2) {
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
            try {
                $cred = PagSeguroConfig::getAccountCredentials();
                $pg_link = $paymentRequest->register($cred);
            } catch (PagSeguroServiceException $e) {
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

    public function setVendaCKTransparenre($params, $uid, $sessionId, $prods, $subtotal){
        require "libraries/PagSeguroLibrary/PagSeguroLibrary.php";
        /**
         * Formas de Status de pagamento
         * 1 => Aguardando pg
         * 2 => Aprovado
         * 3 => Cancelado
         */
        $status_pg = '1';
        $pg_link = '';
        $endereco = implode(",", $params['endereco']);
        $sql = $this->db->prepare("INSERT INTO vendas SET id_usuario = ?, endereco = ?, valor = ?, forma_pg = ?, status_pg = ?, pg_link = ?");
        $sql->execute([
            $uid, $endereco, $subtotal, 6, $status_pg, $sessionId
        ]);
        $id_venda = $this->db->lastInsertId();
        foreach ($prods as $pd) {
            $sql = $this->db->prepare("INSERT INTO vendas_produtos SET id_vendas = ?, id_produto = ?, quantidade = ?");
            $sql->execute([$id_venda, $pd['id'], 1]);
        }
        unset($_SESSION['carrinho']);
        
        $directPaymentRequest = PagSeguroDirectPaymentRequest();
        $directPaymentRequest->setPaymentMode("DEFAULT");
        $directPaymentRequest->setPaymentMethod($params["pg_form"]);
        $directPaymentRequest->setReference($id_venda);
        $directPaymentRequest->setCurrency("BRL");
        $directPaymentRequest->addParameter("notificationURL", "http://loja.pc/carrinho/notificacao");
        
        foreach ($prods as $prod){
            $directPaymentRequest->addItem($prod['id'], $prod['nome'], 1, $prod['preco']);
        }
        
        $directPaymentRequest->setSender(
            $params['nome'],
            $params['email'],
            $params['ddd'],
            $params['telefone'],
            'CPF',
            $params['c_cpf']
        );
        
        $directPaymentRequest->setSenderHash($params['shash']);
        $directPaymentRequest->setShippingType(3);
        $directPaymentRequest->setShippingCost(0);
        $directPaymentRequest->setShippingAddress(
            $params['endereco']['cep'],
            $params['endereco']['rua'],
            $params['endereco']['numero'],
            $params['endereco']['comp'],
            $params['endereco']['bairro'],               
            $params['endereco']['cidade'],             
            $params['endereco']['estado'],
            'BRA'
        );
        $billingAddres = new PagSeguroBilling(
            array(
                'postalCode' => $params['endereco']['cep'],
                'street' => $params['endereco']['rua'],
                'number' => $params['endereco']['numero'],
                'complement' => $params['endereco']['comp'],
                'district' => $params['endereco']['bairro'],
                'city' => $params['endereco']['cidade'],
                'state' => $params['endereco']['estado'],
                'country' => 'BRA'
            )
        );
        
        if($params['pg_form'] == 'CREDIT_CARD'){
            $parc = explode(";", $params['parc']);
            
            $installments = new PagSeguroInstallments(
                '',
                $parc[0],
                $parc[1],
                '',
                ''
            );
            
            $credtCardData = new PagSeguroCreditCardCheckout(
                array(
                    'token' => $params['ctoken'],
                    'installment' => $installments,
                    'billing' => $billingAddres,
                    'holder' => new PagSeguroCreditCardHolder(
                        [
                            'name' => $params['c_titular'],
                            'birtDate' => Date('14/05/1977'),
                            'areaCode' => $params['ddd'],
                            'number' => $params['telefone'],
                            'documents' => array(
                                'type' => 'CPF',
                                'value' => $params['c_cpf']
                            )
                        ]
                    )
                )
            );
            
            $directPaymentRequest->setCreditCard($credtCardData);
        }
        
        try {
            $credentials = PagSeguroConfig::getAccountCredentials();
            $r = $directPaymentRequest->register($credentials);
            return $r;
        } catch (PagSeguroServiceException $exc) {
            echo $exc->getTraceAsString();
        }
    
    }
}
