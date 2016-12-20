<div class="container_login">
<form method="POST">
    <fieldset>
        <legend>Editar categoria</legend>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Título</span>
            <input type="text" name="titulo" class="form-control"
                <?php echo (isset($categoria)) ? "value='$categoria'" : "placeholder='Título'";?>
            >            
        </div>
    </fieldset><br>
    <input type="submit" value="Salvar" class="btn btn-default btn-block"><br><br>
</form>
</div>
