<div class="card">
    <h5 class="card-header"><?php echo ($local == 1) ? 'Meus' : 'Todos'; ?> relatório</h5>
    <div class="card-body">

        <style>
            .accrodion-regular .card .card-header .btn-link {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
        </style>

        <div class="accrodion-regular">
            <div id="accordion4">
                <?php foreach ($meus as $meu) : ?>
                    <div class="card bg-primary">
                        <div class="card-header" id="relatorioo-<?php echo $meu['id']; ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link text-white collapsed" data-toggle="collapse" data-target="#relatorio-<?php echo $meu['id']; ?>" aria-expanded="false" aria-controls="relatorio-<?php echo $meu['id']; ?>">
                                    <span><span class="fas fa-angle-down mr-3"></span><?php echo $tipos[$meu['tipo']]; ?></span>

                                    <?php if ($local == 1 && $meu['status'] == 0) : ?>
                                        <span class="badge badge-pill badge-warning">Aguardando aprovação</span>
                                    <?php elseif ($local == 1 && $meu['status'] == 1) : ?>
                                        <span class="badge badge-pill badge-success">Aprovado</span>
                                    <?php elseif ($local == 1 && $meu['status'] == 2) : ?>
                                        <span class="badge badge-pill badge-danger">Negado</span>
                                    <?php endif; ?>

                                    <?php if ($local == 2 && $meu['status'] == 0) : ?>
                                        <span>
                                            <a href="<?php echo BASE; ?>relatorios/updateStatus/1/<?php echo $meu['id']; ?>" class="badge badge-pill badge-success">Aceitar</a>
                                            <a href="<?php echo BASE; ?>relatorios/updateStatus/2/<?php echo $meu['id']; ?>" class="badge badge-pill badge-danger">Negar</a>
                                        </span>
                                    <?php elseif ($local == 2 && $meu['status'] == 1) : ?>
                                        <span class="badge badge-pill badge-success">Aprovado</span>
                                    <?php elseif ($local == 2 && $meu['status'] == 2) : ?>
                                        <span class="badge badge-pill badge-danger">Negado</span>
                                    <?php endif; ?>
                                </button>
                            </h5>
                        </div>
                        <div id="relatorio-<?php echo $meu['id']; ?>" class="collapse" aria-labelledby="relatorioo-<?php echo $meu['id']; ?>" data-parent="#relatorioo-<?php echo $meu['id']; ?>">
                            <div class="card-body">
                                <?php $rel = json_decode($meu['relatorio'], true); ?>
                                <?php if ($meu['tipo'] == 1) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Responsável: <?php echo $rel['Responsavel']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Atendente: <?php echo $rel['Atendente']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Novato: <?php echo $rel['Novato']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 2) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Responsável: <?php echo $rel['Responsavel']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Pessoa que está fazendo: <?php echo $rel['Atendente']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Novato: <?php echo $rel['Novato']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 3) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Membro realizando a atividade: <?php echo $rel['Nickname']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Nickname das contas utilizadas: <?php echo $rel['Contas']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 4) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Treinamento: <?php echo $rel['Treinamento']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Responsável: <?php echo $rel['Responsavel']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Treinador: <?php echo $rel['Atendente']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Treinados: <?php echo $rel['Novato']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 5) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Ajudante: <?php echo $rel['Ajudante']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Ajudado: <?php echo $rel['Ajudado']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Como ajudou?: <?php echo $rel['Como']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Onde ajudou??: <?php echo $rel['Onde']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 6) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Nickname: <?php echo $rel['Nickname']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Sugestão: <?php echo $rel['Sugestao']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 7) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Membro realizando a atividade: <?php echo $rel['Nickname']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Contas: <?php echo $rel['Contas']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Tempo: <?php echo $rel['Tempo']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Responsável: <?php echo $rel['Responsavel']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 8) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Professor: <?php echo $rel['Professor']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Membro(s): <?php echo $rel['Membro']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Curso (treino) tipo: <?php echo $rel['Tipo']; ?>
                                    </p>
                                <?php elseif ($meu['tipo'] == 10) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Promotor: <?php echo $rel['Promotor']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Membro(s): <?php echo $rel['Membro']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Evento tipo: <?php echo $rel['Tipo']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Prêmio: <?php echo $rel['Premio']; ?> SIHBCOINS
                                    </p>
                                <?php elseif ($meu['tipo'] == 11) : ?>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Data: <?php echo $rel['Data']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Redator: <?php echo $rel['Professor']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Membro(s): <?php echo $rel['Membro']; ?>
                                    </p>
                                    <p style="margin:0px 0px 5px 0px;">
                                        Categoria: <?php echo $rel['Tipo']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>