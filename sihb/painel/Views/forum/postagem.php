<?php 
$cargos = [
    0 => 'Sem revisão',
    1 => 'Revisada',
    2 => 'Fixada',
    3 => 'Fechada'
];
?>
<div class="card">
    <h5 class="card-header">Revisar postagem</h5>
    <div class="card-body">
        <p>
            <strong>Titulo: </strong> <?php echo $postagem['titulo']; ?>
        </p>

        <p>
            <strong>Texto: </strong> <?php echo $postagem['texto']; ?>
        </p>

        <form action="<?php echo BASE; ?>forum/editarPostagem" method="POST">

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="">Escolha um cargo</option>
                    <?php foreach ($cargos as $cargoId => $cargo) : ?>
                        <option value="<?php echo $cargoId; ?>" <?php echo($postagem['status'] == $cargoId)?'selected':''; ?> >
                            <?php echo $cargo; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            
            <button class="btn btn-outline-dark btn-block">Atualizar</button>
        </form>
    </div>
</div>