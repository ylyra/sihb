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

                                    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Confiança: activate to sort column ascending" style="width: 139px;">Confiança</th>

                                    <th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 86px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registros as $registro) : ?>
                                    <?php if ($registro['voto_semana'] == 0) : ?>
                                        <tr role="row" class="even">
                                            <td><?php echo $registro['id']; ?></td>
                                            <td><?php echo $registro['nickname']; ?></td>
                                            <td><?php echo $registro['confianca']; ?>%</td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if ($registro['confianca'] > 0) : ?>
                                                        <a href="<?php echo BASE; ?>registros/confianca/2/<?php echo $registro['id']; ?>" class="btn btn-danger"><i class="icon-dislike"></i></a>
                                                    <?php endif; ?>
                                                    <?php if ($registro['confianca'] < 100) : ?>
                                                        <a href="<?php echo BASE; ?>registros/confianca/1/<?php echo $registro['id']; ?>" class="btn btn-success"><i class="icon-like"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>