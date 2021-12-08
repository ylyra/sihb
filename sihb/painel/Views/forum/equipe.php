<?php 
$cargos = [
    1 => 'Moderador',
    2 => 'Diretor(a) de moderação'
];
?>
<div class="card">
    <h5 class="card-header">Todas as notícias</h5>
    <div class="card-body">
        <?php if (intval($mi_externos['cargo']) >= 2): ?>
            <a href="<?php echo BASE; ?>forum/equipeAdd" class="btn btn-outline-dark btn-block">Adicionar membro</a><br/>
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
                            <?php if (intval($mi_externos['cargo']) >= 2): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>forum/editarMembro/<?php echo $membro['id']; ?>" class="btn btn-success">Editar</a>
                                    <a href="<?php echo BASE; ?>forum/deletarMembro/<?php echo $membro['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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