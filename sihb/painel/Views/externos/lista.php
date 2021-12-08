<?php 
    $cargos = [
        1 => 'Membro',
        2 => 'Auxiliar',
        3 => 'Líder'
    ];
?>

<?php if (isset($_SESSION['externo']) && !empty($_SESSION['externo']) && isset($_SESSION['externo_tipo']) && !empty($_SESSION['externo_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['externo_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['externo']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>

    <?php 
        unset($_SESSION['externo']);
        unset($_SESSION['externo_tipo']);
    ?>
<?php endif; ?>

<div class="card">
    <h5 class="card-header"><?php echo $pageName; ?></h5>
    <div class="card-body">
        <?php if ($minha_info['cargo'] >= 2): ?>
            <a href="<?php echo BASE; ?>externo/addMembro/<?php echo $id_externo; ?>" class="btn btn-outline-info btn-block" >Adicionar membro</a><br/>
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
                            <?php echo $membro['nickname']; ?>
                        </td>
                        
                        <td>
                            <?php echo $cargos[$membro['cargo']]; ?>
                        </td>

                        <td>
                            <?php if (intval($minha_info['cargo']) >= 2) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>externo/editar/<?php echo $id_externo; ?>/<?php echo $membro['id']; ?>" class="btn btn-info">Editar membro</a>
                                    <a href="<?php echo BASE; ?>externo/deletar/<?php echo $id_externo; ?>/<?php echo $membro['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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