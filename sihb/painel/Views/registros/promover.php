<?php if (isset($_SESSION['add_promover']) && !empty($_SESSION['add_promover']) && isset($_SESSION['add_promover_tipo']) && !empty($_SESSION['add_promover_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['add_promover_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['add_promover']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a>
    </div>

    <?php 
        unset($_SESSION['add_promover']);
        unset($_SESSION['add_promover_tipo']);
    ?>
<?php endif; ?>
<div class="card">
    <h5 class="card-header">Adicionar/Promover Registro</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>registros/addRegistro">

            <div class="form-group">
                <label for="date-mask2">Data ultima promoção <small class="text-muted">dd/mm/aaaa (deixe em branco caso queira automatico)</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data_ultima_promocao">
            </div>

            <div class="form-group">
                <label for="responsavel">Executivo responsável</label>
                <select class="form-control" id="responsavel" name="responsavel" required>
                    <option value="">Escolha um responsável</option>
                    <?php foreach ($executivos as $executivo) : ?>
                        <option value="<?php echo $executivo['nickname']; ?>"><?php echo $executivo['nickname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

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
                <label for="cargo">Cargo</label>
                <select class="form-control" id="cargo" name="cargo" required>
                    <option value="">Escolha um cargo</option>
                    <?php foreach ($patentes as $patente) : ?>
                        <?php if ($acesso->podePromover($patente['id'], $acesso->getInfo('patente'))) : ?>
                            <option value="<?php echo $patente['id']; ?>"><?php echo $patente['nome']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Escolha um status</option>
                    <option value="1">Ativo</option>
                    <option value="2">Demitido</option>
                    <?php if ($acesso->getInfo('patente') <= 5) : ?>
                        <option value="3">Aposentado</option>
                        <option value="4">Conselheiro</option>
                    <?php endif; ?>

                </select>
            </div>

            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>