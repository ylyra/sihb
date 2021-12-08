<?php 
$cargos = [
    1 => 'Moderador',
    2 => 'Diretor(a) de moderação'
];
?>
<div class="card">
    <h5 class="card-header">Adicionar membro a equipe</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>forum/equipeAddAction" method="POST">

            <div class="form-group">
                <label for="nickname" class="col-form-label">Nickname</label>
                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="Nickname..."/>
            </div>

            <div class="form-group">
                <label for="cargo">Cargos</label>
                <select class="form-control" id="cargo" name="cargo">
                    <option value="">Escolha um cargo</option>
                    <?php foreach ($cargos as $cargoId => $cargo) : ?>
                        <option value="<?php echo $cargoId; ?>">
                            <?php echo $cargo; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button class="btn btn-outline-dark btn-block" onclick="unhook()" >Adicionar</button>
        </form>
    </div>
</div>