<?php if (isset($_SESSION['emblema']) && !empty($_SESSION['emblema']) && isset($_SESSION['emblema_tipo']) && !empty($_SESSION['emblema_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['emblema_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['emblema']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>

    <?php 
        unset($_SESSION['emblema']);
        unset($_SESSION['emblema_tipo']);
    ?>
<?php endif; ?>
<?php 
    $status = [
        0 => 'Aguardando',
        1 => 'Aprovado',
        2 => 'Negado'
    ];

    $status2 = [
        0 => '',
        1 => 'table-success',
        2 => 'table-danger'
    ];
?>
<div class="card">
    <h5 class="card-header">Items comprados</h5>
    <div class="card-body">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Imagem</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) : ?>
                    <tr class="<?php echo $status2[$item['status']]; ?>">
                        <td><img src="<?php echo $item['img']; ?>" alt="item"></td>
                        <td><?php echo $item['nickname']; ?></td>
                        <td><?php echo $item['msg']; ?></td>
                        <td><?php echo $status[$item['status']]; ?></td>
                        <td>
                            <?php if ($item['status'] == 0): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>loja/confirmarCompra/<?php echo $item['id']; ?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                                    <a href="<?php echo BASE; ?>loja/negarCompra/<?php echo $item['id']; ?>" class="btn btn-danger"><i class="fas fa-times"></i></a>
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