<div class="card">
    <h5 class="card-header">Todos os comentários</h5>
    <div class="card-body">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Notícia</th>
                    <th scope="col">Comentário</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($noticias_comentarios as $comentario) : ?>
                    <tr class="<?php echo($comentario['status'] == 1)?'table-danger':''; ?>">
                        <td scope="row">
                            <a href="<?php echo BASE_PAI; ?>noticias/abrir/<?php echo $comentario['id_noticia']; ?>/<?php echo $comentario['slug']; ?>" target="_blank">
                                Veja o comentário na notícia
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#comentario<?php echo $comentario['id']; ?>">Ver comentário</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="comentario<?php echo $comentario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="comentario<?php echo $comentario['id']; ?>Label" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="comentario<?php echo $comentario['id']; ?>Label">Comentario</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $comentario['comentario']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 4 && $comentario['status'] == 0) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>jornal/deletarComentario/<?php echo $comentario['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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