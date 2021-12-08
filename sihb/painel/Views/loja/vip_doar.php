<div class="card">
    <h5 class="card-header">Adicionar vip</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>loja/addVipAction">

            <div class="nicknames">
                <div class="row" style="align-items:flex-end;">
                    <div class="form-group col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                        <label for="nickname" class="col-form-label">Nickname</label>
                        <input id="nickname" type="text" class="form-control" name="nicksnames[]" placeholder="Nickname do membro..." required />
                    </div>

                    <div class="form-group col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                        <button class="btn btn-outline-success btn-block" type="button" onclick="addInput('nicknames')"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="tempo">Tempo</label>
                <select name="tempo" class="form-control" id="tempo" required>
                    <option value="">Selecione quanto tempo de vip deseja dar</option>
                    <?php for ($i=1; $i<=12; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> mês(es)</option>
                    <?php endfor; ?>
                </select>
            </div>
            
            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>