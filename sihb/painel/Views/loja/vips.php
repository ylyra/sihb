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
<div class="card">
    <h5 class="card-header">Lista de membros vip</h5>
    <div class="card-body">
        <a href="<?php echo BASE; ?>loja/darVip" class="btn btn-outline-dark btn-block">Dar vip</a><br/>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Data vencimento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td><img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $item['nickname']; ?>&action=std&direction=3&head_direction=3&img_format=png&gesture=std&headonly=1&size=b" alt="item"></td>
                        <td><?php echo $item['nickname']; ?></td>
                        <td><?php echo date('d/m/Y \à\s H:i:s', strtotime($item['vip_vencimento'])); ?></td>
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