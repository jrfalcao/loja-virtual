<?php if(isset($msg) && !empty($msg)): ?>
    <div class="alert alert-success" role="alert"><?= $msg ?></div>
<?php endif; ?>
<form  method="POST">
    <legend>Fale conosco</legend>
    <div class="input-group">
        <span for="nome" class="input-group-addon">Nome:</span> 
        <input type="text" name="nome" class="form-control" required>
    </div> <br><br>
    <div class="input-group">
        <label for="email" class="input-group-addon">Email:</label> 
        <input type="email" name="email" class="form-control" required>
    </div> <br><br>
    <div class="input-group">
        <label for="mensagem" class="input-group-addon">Mensagem:</label>
        <textarea name="mensagem" class="form-control" rows="4" required></textarea>
    </div><br><br>
    <input type="submit" name="submitContato" class="btn btn-default" value="Enviar Mensagem" ><br><br>
</form>

