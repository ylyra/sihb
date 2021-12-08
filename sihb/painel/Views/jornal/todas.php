<div class="row">
    <!-- ============================================================== -->
    <!-- sales  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Total notícias</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_noticias; ?></h1>
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
                <h5 class="text-muted">Revisadas</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_noticias_revisadas; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Sem revisão</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_noticias_sem_revisao; ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Minhas notícas</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><?php echo $total_minhas; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end new customer  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
</div>
<?php 
    $status_noticias = [
        0 => "Sem revisão",
        1 => "Revisada",
        2 => "Fixada",
        3 => "Destacada"
    ];

?>
<div class="card">
    <h5 class="card-header">Todas as notícias</h5>
    <div class="card-body">
        <a href="<?php echo BASE; ?>jornal/criar" class="btn btn-outline-dark btn-block">Criar noticia</a><br/>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($noticias as $noticia) : ?>
                    <tr>
                        <td scope="row">
                            <a href="<?php echo BASE_PAI; ?>noticias/abrir/<?php echo $noticia['id']; ?>/<?php echo $noticia['slug']; ?>" target="_blank" >
                                <?php echo $noticia['titulo']; ?>
                            </a>
                        </td>
                        <td>
                            <?php echo $status_noticias[$noticia['status']]; ?>
                        </td>
                        <td>
                            <?php if ($acesso->getInfo('id_registro') == $noticia['autor_id'] && intval($mi_externos['cargo']) == 1): ?>
                                <a href="<?php echo BASE; ?>jornal/editar/<?php echo $noticia['id']; ?>" class="btn btn-outline-primary btn-block">Editar</a>
                            <?php elseif($acesso->getInfo('id_registro') == $noticia['autor_id'] && intval($mi_externos['cargo']) == 2): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>jornal/publicar/<?php echo $noticia['id']; ?>" class="btn btn-success">Publicar</a>
                                    <a href="<?php echo BASE; ?>jornal/delete/<?php echo $noticia['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </div>
                            <?php elseif(intval($mi_externos['cargo']) >= 3): ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>jornal/revisar/<?php echo $noticia['id']; ?>" class="btn btn-success">Revisar</a>
                                    <a href="<?php echo BASE; ?>jornal/delete/<?php echo $noticia['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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