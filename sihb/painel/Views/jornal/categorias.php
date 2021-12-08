<div class="card">
    <h5 class="card-header">Todos as categorias</h5>
    <div class="card-body">
        <?php if (intval($mi_externos['cargo']) >= 4) : ?>
            <a href="<?php echo BASE; ?>jornal/categoriasAdd" class="btn btn-outline-dark btn-block">Adicionar categoria</a><br />
        <?php endif; ?>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) : ?>
                    <tr>
                        <td scope="row">
                            <?php echo $categoria['nome']; ?>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 4) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>jornal/deletarCategoria/<?php echo $categoria['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-responsive {
        display: table;
    }

    @media only screen and (max-width:520px) {
        .table-responsive {
            display: block;
        }
    }
</style>