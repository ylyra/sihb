<div class="card">
    <h5 class="card-header">Todos os cursos</h5>
    <div class="card-body">
        <a href="<?php echo BASE; ?>cursos/novo" class="btn btn-outline-dark btn-block">
            Criar curso
        </a><br/>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Total aulas</th>
                    <th scope="col">Total alunos</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td scope="row">
                            <?php echo $curso['nome']; ?>
                        </td>
                        <td>
                            <?php echo $curso['total_aulas']; ?>
                        </td>
                        <td>
                            <?php echo $curso['total_alunos']; ?>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 2): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>cursos/editar/<?php echo $curso['id']; ?>" class="btn btn-success">Editar</a>
                                    <a href="<?php echo BASE; ?>cursos/deletar/<?php echo $curso['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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