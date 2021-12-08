<div class="card">
    <h5 class="card-header">Editar código</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>loja/editCodigoAction">

            <div class="form-group">
                <label for="codigo">Código</label>
                <input id="codigo" type="text" class="form-control" name="codigo" value="<?php echo $emblema['codigo']; ?>" required />
            </div>
            
            <div class="form-group">
                <label for="valor">Valor</label>
                <input id="valor" type="number" class="form-control" name="valor" value="<?php echo $emblema['valor']; ?>" required />
            </div>

            <div class="form-group">
                <label for="date-mask2">Data de expiração <small class="text-muted">dd/mm/aaaa (deixe em branco caso não queira uma data)</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="expiracao" value="<?php echo($emblema['expiracao'] != '0000-00-00 00:00:00')?date('d/m/Y', strtotime($emblema['expiracao'])):''; ?>" >
            </div>

            <div class="form-group">
                <label for="limite">Limite (Deixe em branco caso queira como ilimitado)</label>
                <input id="limite" type="number" class="form-control" name="limite" value="<?php echo($emblema['limite'] >= 0)?$emblema['limite']:''; ?>"  />
            </div>

            <input type="hidden" name="id" value="<?php echo $emblema['id']; ?>">
            
            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>