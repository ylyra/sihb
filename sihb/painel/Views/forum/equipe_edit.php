<?php 
$cargos = [
    1 => 'Moderador',
    2 => 'Diretor(a) de moderação'
];
?>
<div class="card">
    <h5 class="card-header">Editar membro da equipe</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>forum/equipeEditAction" method="POST">

            <div class="form-group">
                <label for="nickname" class="col-form-label">Nickname</label>
                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="Nickname..." value="<?php echo $membro['nickname']; ?>" />
            </div>

            <div class="form-group">
                <label for="cargo">Cargos</label>
                <select class="form-control" id="cargo" name="cargo">
                    <option value="">Escolha um cargo</option>
                    <?php foreach ($cargos as $cargoId => $cargo) : ?>
                        <option value="<?php echo $cargoId; ?>" <?php echo($membro['cargo'] == $cargoId)?'selected':''; ?>>
                            <?php echo $cargo; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $membro['id']; ?>">
            
            <button class="btn btn-outline-dark btn-block">Atualizar</button>
        </form>
    </div>
</div>