<?php if (isset($_SESSION['edit_registro']) && !empty($_SESSION['edit_registro']) && isset($_SESSION['edit_registro_tipo']) && !empty($_SESSION['edit_registro_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['edit_registro_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['edit_registro']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>

    <?php 
        unset($_SESSION['edit_registro']);
        unset($_SESSION['edit_registro_tipo']);
    ?>
<?php endif; ?>

<div class="card">
    <h5 class="card-header">Lista de Registro</h5>
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered second dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nickname: activate to sort column descending" style="width: 20px;">#ID</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nickname: activate to sort column descending" style="width: 152px;">Nickname</th>

                                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Patente: activate to sort column ascending" style="width: 139px;">Patente</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Promovido por: activate to sort column ascending" style="width: 109px;">Promovido por</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Ultima promoção: activate to sort column ascending" style="width: 151px;">Ultima promoção</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Vip: activate to sort column ascending" style="width: 103px;">Vip</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Sihbcoins: activate to sort column ascending" style="width: 80px;">SIHBCoins</th>

                                    <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 115px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registros as $registro): ?>
                                    <tr role="row" class="even">
                                        <td><?php echo $registro['id']; ?></td>
                                        <td><?php echo $registro['nickname']; ?></td>
                                        <td><?php echo $registro['patente']; ?></td>
                                        <td><?php echo $registro['promovido_por']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($registro['ultima_promocao'])); ?></td>
                                        <td><?php echo($registro['vip'] == 1)?'Sim':'Não'; ?></td>
                                        <td><?php echo $registro['moedas']; ?></td>
                                        <td>
                                            <?php if ($acesso->podePromover($registro['patente_id'], $acesso->getInfo('patente'))) : ?>
                                                <a href="<?php echo BASE; ?>registros/editar/<?php echo $registro['id']; ?>" class="btn btn-info" ><i class="fas fa-pencil-alt"></i></a>
                                            <?php endif; ?>

                                            <?php if ($acesso->getInfo('patente') <= 6): ?>
                                                <a href="<?php echo BASE; ?>registros/delete/<?php echo $registro['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este registro?')" ><i class="fas fa-trash"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>