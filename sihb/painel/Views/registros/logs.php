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
    <h5 class="card-header">Logs</h5>
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered second2 dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nickname: activate to sort column descending" style="width: 20px;">#ID</th>

                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Log: activate to sort column descending" style="width: 152px;">Log</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs as $log) : ?>
                                    <tr role="row">
                                        <td><?php echo $log['id']; ?></td>
                                        <td><?php echo $log['texto']; ?></td>
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