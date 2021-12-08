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
    <h5 class="card-header">Entrada/Saída</h5>
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered second2 dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nickname: activate to sort column descending" style="width: 20px;">#ID</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nickname: activate to sort column descending" style="width: 152px;">Nickname</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Entrada: activate to sort column ascending" style="width: 139px;">Entrada</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Saída: activate to sort column ascending" style="width: 139px;">Saída</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registros as $registro) : ?>
                                    <tr role="row">
                                        <td><?php echo $registro['id']; ?></td>
                                        <td><?php echo $registro['nickname']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($registro['inicio'])); ?></td>
                                        <td><?php echo($registro['fim'] != '0000-00-00 00:00:00')?date('d/m/Y', strtotime($registro['fim'])):'E não saiu'; ?></td>
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