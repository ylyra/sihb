<?php 
$cargos = [
    0 => 'Sem revisão',
    1 => 'Revisada',
    2 => 'Fixada',
    3 => 'Fechada',
    4 => 'Deletada'
];
?>
<div class="row">
    <!-- ============================================================== -->
    <!-- sales  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Total tópicos</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_topicos; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end sales  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- new customer  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Moderados</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_moderados; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Fechados</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_fechados; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Deletados</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_deletados; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end new customer  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</div>
<div class="card">
    <h5 class="card-header">Todos as postagens</h5>
    <div class="card-body">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Tópico</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topicos as $comentario) : ?>
                    <tr class="<?php echo($comentario['status'] == 4)?'table-danger':''; ?>">
                        <td scope="row">
                            <a href="<?php echo BASE_PAI; ?>forum/abrir/<?php echo $comentario['id']; ?>/<?php echo $comentario['slug']; ?>" target="_blank">
                                Veja o tópico
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#comentario<?php echo $comentario['id']; ?>">Ver mensagem</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="comentario<?php echo $comentario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="comentario<?php echo $comentario['id']; ?>Label" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="comentario<?php echo $comentario['id']; ?>Label">Texto</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $comentario['texto']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php echo $cargos[$comentario['status']]; ?>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 1 && ($comentario['status'] != 3 && $comentario['status'] != 4)) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>forum/revisar/<?php echo $comentario['id']; ?>" class="btn btn-success">Revisar</a>
                                    <a href="<?php echo BASE; ?>forum/deletarTopico/<?php echo $comentario['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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