<div class="card">
    <h5 class="card-header">Adicionar código</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>loja/addCodigoAction">

            <div class="form-group">
                <label for="codigo">Código</label>
                <input id="codigo" type="text" class="form-control" name="codigo" placeholder="Código de SIHBCoins (Exemplo: sihb10)" required />
            </div>
            
            <div class="form-group">
                <label for="valor">Valor</label>
                <input id="valor" type="number" class="form-control" name="valor" placeholder="Valor do código. (Exemplo: 10)" required />
            </div>

            <div class="form-group">
                <label for="date-mask2">Data de expiração <small class="text-muted">dd/mm/aaaa (deixe em branco caso não queira uma data)</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="expiracao">
            </div>

            <div class="form-group">
                <label for="limite">Limite (Deixe em branco caso queira como ilimitado)</label>
                <input id="limite" type="number" class="form-control" name="limite" placeholder="Limite de códigos. (Exemplo: 1)"  />
            </div>
            
            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>