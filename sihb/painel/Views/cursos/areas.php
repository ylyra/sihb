<div class="card">
    <h5 class="card-header">Todas as áreas</h5>
    <div class="card-body">
        <a href="<?php echo BASE; ?>cursos/nova" class="btn btn-outline-dark btn-block">
            Criar área
        </a><br/>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($areas as $area): ?>
                    <tr>
                        <td scope="row">
                            <?php echo $area['nome']; ?>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 2): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>cursos/editar_area/<?php echo $area['id']; ?>" class="btn btn-success">Editar</a>
                                    <a href="<?php echo BASE; ?>cursos/deletar_area/<?php echo $area['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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