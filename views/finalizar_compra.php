<h1>Finalizar Compra</h1>

<form method="post" id="form" onsubmit="pagar()">
    <fieldset>
        <legend>Informações do usuário</legend>
        Nome:<br>
        <input type="text" name="nome"><br><br>
        E-Mail:<br>
        <input type="email" name="email"><br><br>
        Senha:<br>
        <input type="password" name="senha"><br><br>
        Telefone:<br>
        <input type="text" name="ddd" size="5"><input type="text" name="telefone"><br><br>
    </fieldset><br>
    <fieldset>
        <legend>Informações de endereço</legend>
        CEP:<br>
        <input type="text" name="endereco[cep]"><br><br>
        Endereço:<br>
        <input type="text" name="endereco[rua]"><br><br>
        Número:<br>
        <input type="text" name="endereco[numero]"><br><br>
        Complemento:<br>
        <input type="text" name="endereco[comp]"><br><br>
        Bairro:<br>
        <input type="text" name="endereco[bairro]"><br><br>
        Cidade:<br>
        <input type="text" name="endereco[cidade]"><br><br>
        Estado:<br>
        <input type="text" name="endereco[estado]"><br><br>
    </fieldset><br>
    <fieldset>
        <legend>Resumo da compra</legend>
        Total a pagar: R$ <?= $total ?>
    </fieldset><br>
    <fieldset>
        <legend>Informações de pagamento</legend>
        <select name="pg_form" id="pg_form" onchange="selectPg()">
            <option value=""></option>
            <option value="CREDIT_CARD">Cartão de Crédito</option>
            <option value="BOLETO">Boleto</option>
            <option value="BALANCE">Saldo PagSeguro</option>
        </select>
        <div id="cc" style="display: none">
            Qual a bandeira do seu cartão?<br>
            <div id="bandeiras"></div>
            <br>
            <div id="cardinfo" style="display: none">
                Parcelamento:<br>
                <select name="parc" id="parc"></select><br><br>
                
                Titular do cartão:<br>
                <input type="text" name="c_titular"><br><br>
                
                CPF do Titular:<br>
                <input type="text" name="c_cpf"><br><br>
                
                Número do Cartão:<br>
                <input type="text" name="cartao" id="cartao"><br><br>
                
                Dígito:<br>
                <input type="text" name="digito" id="cvv" maxlength="4"><br><br>
                
                Validade:<br>
                <input type="text" name="validade" id="validade"><br><br>
            </div>
        </div>
    </fieldset><br>
    <input type="submit" value="Pagamento" class="btn btn-default"><br><br>

    <input type="hidden" class="bandeira" id="bandeira">
    <input type="hidden" class="ctoken" id="ctoken">
    <input type="hidden" class="shash" id="shash">
    <input type="hidden" class="sessionId" value="<?= $sessionId ?>">
</form>

<script type="text/javascript" src=
"https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
</script>

<script type="text/javascript">
    var sessionId = "<?= $sessionId ?>";
    var valor = "<?= $total ?>";
    var formOk = false;
</script>
<script type="text/javascript" src="/assets/js/ckt.js"></script>