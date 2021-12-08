<div class="card">
    <h5 class="card-header">Todos os comentários</h5>
    <div class="card-body">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">Tópico</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comentarios as $comentario) : ?>
                    <tr class="<?php echo($comentario['status'] == 1)?'table-danger':''; ?>">
                        <td scope="row">
                            <a href="<?php echo BASE_PAI; ?>forum/abrir/<?php echo $comentario['id_topico']; ?>/<?php echo $comentario['slug']; ?>" target="_blank">
                                Veja o comentário no tópico
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#comentario<?php echo $comentario['id']; ?>">Ver comentário</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="comentario<?php echo $comentario['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="comentario<?php echo $comentario['id']; ?>Label" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="comentario<?php echo $comentario['id']; ?>Label">Comentário</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $u->replaceBBcodes($comentario['comentario']); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if (intval($mi_externos['cargo']) >= 1 && $comentario['status'] == 0) : ?>
                                <div class="btn-group">
                                    <a href="<?php echo BASE; ?>forum/deletarComentario/<?php echo $comentario['id']; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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

    .citacao {
        margin-bottom: 20px;
        padding: 20px;
        background: #EEEEEE;
        border: 1px solid #CCCCCC;
    }

    .citacao .de {
        font-weight: 800;
        font-size: 17px;
        margin-bottom: 10px;
    }
</style>