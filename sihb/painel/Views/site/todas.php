<div class="card">
    <h5 class="card-header">Páginas do site</h5>
    <div class="card-body">
        <a href="<?php echo BASE; ?>site/criar" class="btn btn-outline-dark btn-block">Criar página oculta</a><br/>
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Site página</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paginas as $pagina) : ?>
                    <tr>
                        <td scope="row">
                            <?php if ($pagina['tipo'] == 0): ?>
                                <a href="<?php echo BASE_PAI . $pagina['local']; ?>" target="_blank" ><?php echo BASE_PAI . $pagina['local']; ?></a>
                            <?php else: ?>
                                <a href="<?php echo BASE_PAI . 'pages/open/'. $pagina['id'] . '/' . $pagina['local']; ?>" target="_blank" ><?php echo BASE_PAI . 'pages/open/'. $pagina['id'] . '/' . $pagina['local']; ?></a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo BASE; ?>site/editarPagina/<?php echo $pagina['id']; ?>" class="btn btn-outline-primary ">Editar</a>
                                <?php if ($pagina['tipo'] == 1): ?>
                                    <a href="<?php echo BASE; ?>site/deleteOculta/<?php echo $pagina['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                <?php endif; ?>
                            </div>
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