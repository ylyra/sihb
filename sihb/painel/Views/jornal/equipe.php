<?php 
$cargos = [
    1 => 'Redator',
    2 => 'Jornalista',
    3 => 'Supervisor',
    4 => 'Diretor de Redação'
];
?>
<div class="card">
    <h5 class="card-header">Todas as notícias</h5>
    <div class="card-body">
        <?php if (intval($mi_externos['cargo']) >= 4): ?>
            <a href="<?php echo BASE; ?>jornal/equipeAdd" class="btn btn-outline-dark btn-block">Adicionar membro</a><br/>
        <?php endif; ?>        
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Nickname</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($membros as $membro) : ?>
                    <tr>
                        <td scope="row">
                            <a href="<?php echo BASE_PAI; ?>profile/<?php echo $membro['nickname']; ?>" target="_blank" >
                                <?php echo $membro['nickname']; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $cargos[$membro['cargo']]; ?>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 4): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>jornal/editarMembro/<?php echo $membro['id']; ?>" class="btn btn-success">Editar</a>
                                    <a href="<?php echo BASE; ?>jornal/deletarMembro/<?php echo $membro['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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