<?php if (isset($_SESSION['relatorio']) && !empty($_SESSION['relatorio']) && isset($_SESSION['relatorio_tipo']) && !empty($_SESSION['relatorio_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['relatorio_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['relatorio']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>

    <?php
    unset($_SESSION['relatorio']);
    unset($_SESSION['relatorio_tipo']);
    ?>
<?php endif; ?>
<div class="card">
    <h5 class="card-header">Criar relatório</h5>
    <div class="card-body">
        <h5>Escolha um tipo de relatório</h5>
        <form onchange="return buscarTipoTreino(this)" id="opcoes-tipo">
            <label class="custom-control custom-radio">
                <input type="radio" name="radio-stacked" class="custom-control-input" value="1" checked=""><span class="custom-control-label">Relatório Atendimento</span>
            </label>

            <?php if ($acesso->getInfo('patente') <= 12) : ?>
                <label class="custom-control custom-radio">
                    <input type="radio" name="radio-stacked" class="custom-control-input" value="2"><span class="custom-control-label">Relatório DE</span>
                </label>
            <?php endif; ?>

            <?php if ($acesso->getInfo('patente') <= 11) : ?>
                <label class="custom-control custom-radio">
                    <input type="radio" name="radio-stacked" class="custom-control-input" value="4"><span class="custom-control-label">Relatório Treinamento</span>
                </label>
            <?php endif; ?>

            <?php if ($acesso->isExterno(1, $acesso->getInfo('id_registro'))) : ?>
                <label class="custom-control custom-radio">
                    <input type="radio" name="radio-stacked" class="custom-control-input" value="5"><span class="custom-control-label">Relatório Ajudantes</span>
                </label>
            <?php endif; ?>

            <?php if ($acesso->isExterno(4, $acesso->getInfo('id_registro'))) : ?>
                <label class="custom-control custom-radio">
                    <input type="radio" name="radio-stacked" class="custom-control-input" value="9"><span class="custom-control-label">Relatório Professores</span>
                </label>
            <?php endif; ?>

            <?php if ($acesso->isExterno(5, $acesso->getInfo('id_registro'))) : ?>
                <label class="custom-control custom-radio">
                    <input type="radio" name="radio-stacked" class="custom-control-input" value="10"><span class="custom-control-label">Relatório Entretenimento</span>
                </label>
            <?php endif; ?>

            <?php if ($acesso->isExterno(6, $acesso->getInfo('id_registro'))) : ?>
                <label class="custom-control custom-radio">
                    <input type="radio" name="radio-stacked" class="custom-control-input" value="11"><span class="custom-control-label">Relatório Ouvidoria</span>
                </label>
            <?php endif; ?>

            <label class="custom-control custom-radio">
                <input type="radio" name="radio-stacked" class="custom-control-input" value="6"><span class="custom-control-label">Relatório Sugestões</span>
            </label>
        </form>

        <div id="relatorio">
            <form method="POST" action="<?php echo BASE; ?>relatorios/addRelatorio">
                <input type="hidden" name="tipo" value="1" />

                <div class="form-group">
                    <label for="date-mask2">Data <small class="text-muted">dd/mm/aaaa</small></label>
                    <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" value="<?php echo date('d/m/Y'); ?>" readonly />
                </div>

                <div class="form-group">
                    <label for="atendente" class="form-label">Pessoa que fez o atendimento</label>
                    <input id="atendente" type="text" class="form-control" name="atendente" placeholder="Nickname do atendente..." required value="<?php echo $acesso->getInfo('nickname'); ?>" />
                </div>

                <div class="form-group">
                    <label for="responsavel">Executivo que comprova o ato</label>
                    <select class="form-control" id="responsavel" name="responsavel" required>
                        <option value="">Escolha um executivo</option>
                        <?php foreach ($executivos as $executivo) : ?>
                            <option value="<?php echo $executivo['nickname']; ?>"><?php echo $executivo['nickname']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="novato" class="form-label">Novato que foi atendido</label>
                    <input id="novato" type="text" class="form-control" name="novato" placeholder="Nickname do novato..." required />
                </div>

                <input type="submit" value="Enviar" class="btn btn-success btn-block" />

            </form>
        </div>
    </div>
</div>

<style>
    #opcoes-tipo {
        display: grid;
        gap: 3px;
        grid-template-areas:
            "r1 r3 r5"
            "r2 r4 r6";
    }

    #opcoes-tipo label:nth-child(1) {
        grid-area: r1;
    }

    #opcoes-tipo label:nth-child(2) {
        grid-area: r2;
    }

    #opcoes-tipo label:nth-child(3) {
        grid-area: r3;
    }

    #opcoes-tipo label:nth-child(4) {
        grid-area: r4;
    }

    #opcoes-tipo label:nth-child(5) {
        grid-area: r5;
    }

    #opcoes-tipo label:nth-child(6) {
        grid-area: r6;
    }
</style>