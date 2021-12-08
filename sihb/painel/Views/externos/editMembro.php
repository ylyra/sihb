<?php 
    $cargos = [
        1 => 'Membro',
        2 => 'Auxiliar',
        3 => 'Líder'
    ];
?>

<div class="card">
    <h5 class="card-header"><?php echo $pageName; ?> - Adicionar</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>externo/editAction" method="POST">

            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="Nickname do membro" value="<?php echo $info['nickname']; ?>" />
            </div>

            <div class="form-group">
                <label for="cargo">Cargos</label>
                <select class="form-control" id="cargo" name="cargo">
                    <option value="">Escolha um cargo</option>
                    <?php foreach ($cargos as $cargoId => $cargo) : ?>
                        <option value="<?php echo $cargoId; ?>" <?php echo($info['cargo'] == $cargoId)?'selected':''; ?>>
                            <?php echo $cargo; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id_externo" value="<?php echo $id_externo; ?>">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

            <button class="btn btn-outline-dark btn-block">Adicionar</button>
        </form>
    </div>
</div>