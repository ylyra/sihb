<div class="card">
    <h5 class="card-header">Editar curso</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <form action="<?php echo BASE; ?>cursos/editAction/<?php echo $curso['id']; ?>" method="POST">

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" class="form-control" name="nome" placeholder="Nome do curso" value="<?php echo $curso['nome']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="descricao">Desrição</label>
                        <input id="descricao" type="text" class="form-control" name="descricao" placeholder="Desrição do curso" value="<?php echo $curso['descricao']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="area">Área</label>
                        <select class="form-control" id="area" name="area" required>
                            <option value="">Escolha uma área</option>
                            <?php foreach ($areas as $area) : ?>
                                <option value="<?php echo $area['id']; ?>" <?php echo ($curso['id_area'] == $area['id']) ? 'selected' : ''; ?>>
                                    <?php echo $area['nome']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input id="imagem" type="text" class="form-control" name="imagem" placeholder="Imagem do curso (hospedado no imgur)" value="<?php echo $curso['imagem']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="cor">Cor do curso</label>
                        <input type="text" id="cor" name="cor" class="form-control demo minicolors-input" data-control="hue" value="<?php echo $u->rgbToHex($curso['cor']); ?>" size="7" placeholder="Cor do curso">
                    </div>

                    <div class="form-group">
                        <label for="valor">Valor do curso</label>
                        <input id="valor" type="number" class="form-control" name="valor" placeholder="Valor do curso" min="1" value="<?php echo $curso['valor']; ?>" />
                    </div>

                    <div class="form-group">
                        <label for="vip">Vip</label>
                        <select class="form-control" id="vip" name="vip" required>
                            <option value="">Escolha uma opção</option>
                            <option value="1" <?php echo ($curso['vip'] == 1) ? 'selected' : ''; ?>>Sim</option>
                            <option value="0" <?php echo ($curso['vip'] == 0) ? 'selected' : ''; ?>>Não</option>
                        </select>
                    </div>

                    <button class="btn btn-outline-dark btn-block">Editar</button>
                </form>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" style="margin-top: 10px;">
                <div class="card border-3 border-top" id="add_aula" style="border-color:<?php echo $u->rgbToHex($curso['cor']); ?> !important;">
                    <div class="card-body">
                        <h4>Adicionar aula</h4>

                        <form action="<?php echo BASE; ?>cursos/adicionarAula/<?php echo $curso['id']; ?>" method="POST">

                            <div class="form-group">
                                <label for="aula_nome">Nome da aula</label>
                                <input id="aula_nome" type="text" class="form-control" name="aula_nome" placeholder="Nome da aula" required />
                            </div>

                            <div class="form-group">
                                <label for="posicao">Posição</label>
                                <select class="form-control" id="posicao" name="posicao" required>
                                    <option value="">Escolha uma área</option>
                                    <?php foreach ($curso['aulas'] as $posicao) : ?>
                                        <option value="<?php echo intval($posicao['ordem']) + 1; ?>">
                                            Após <?php echo $posicao['nome']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="video_url">Vídeo</label>
                                <input id="video_url" type="text" class="form-control" name="video_url" placeholder="Somente a parte após a /watch?v= (htc1z4Uv0HA)" required />
                            </div>

                            <button class="btn btn-outline-dark btn-block">Editar</button>
                        </form>
                    </div>
                </div>

                <div class="card border-3 border-top" id="edit_aula" style="border-color:<?php echo $u->rgbToHex($curso['cor']); ?> !important;">
                    <div class="card-body">
                        <?php foreach ($curso['aulas'] as $aula) : ?>
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h4 class="card-header-title"><?php echo $aula['nome']; ?></h4>
                                    <div class="toolbar ml-auto">
                                        <a href="<?php echo BASE; ?>cursos/deletar_aula/<?php echo $curso['id']; ?>/<?php echo $aula['id']; ?>" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <i class="fas fa-chart-line"></i>
                                        <?php echo $aula['views']; ?>
                                    </p>

                                    <a href="https://youtube.com/<?php echo $aula['videoUrl']; ?>" target="_blank" class="btn btn-primary btn-block">Vídeo</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo BASE; ?>assets/vendor/bootstrap-colorpicker/%40claviska/jquery-minicolors/jquery.minicolors.css" rel="stylesheet">
<script src="<?php echo BASE; ?>assets/vendor/bootstrap-colorpicker/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="<?php echo BASE; ?>assets/vendor/bootstrap-colorpicker/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="<?php echo BASE; ?>assets/vendor/bootstrap-colorpicker/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="<?php echo BASE; ?>assets/vendor/bootstrap-colorpicker/%40claviska/jquery-minicolors/jquery.minicolors.min.js"></script>
<script>
    $('#cor').minicolors({
        control: $(this).attr('data-control') || 'hue',
        defaultValue: $(this).attr('data-defaultValue') || '',
        format: $(this).attr('data-format') || 'hex',
        keywords: $(this).attr('data-keywords') || '',
        inline: $(this).attr('data-inline') === 'true',
        letterCase: $(this).attr('data-letterCase') || 'lowercase',
        opacity: $(this).attr('data-opacity'),
        position: $(this).attr('data-position') || 'bottom left',
        swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
        change: function(value, opacity) {
            if (!value) return;

            c('#add_aula').setAttribute('style', `border-color: ${value} !important`);
            c('#edit_aula').setAttribute('style', `border-color: ${value} !important`);
        },
        theme: 'bootstrap'
    });
</script>