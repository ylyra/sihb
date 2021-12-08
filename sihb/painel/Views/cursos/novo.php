<div class="card">
    <h5 class="card-header">Adicionar curso</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>cursos/addAction" method="POST">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input id="nome" type="text" class="form-control" name="nome" placeholder="Nome do curso" required />
            </div>

            <div class="form-group">
                <label for="descricao">Desrição</label>
                <input id="descricao" type="text" class="form-control" name="descricao" placeholder="Desrição do curso" required />
            </div>

            <div class="form-group">
                <label for="area">Área</label>
                <select class="form-control" id="area" name="area" required >
                    <option value="">Escolha uma área</option>
                    <?php foreach ($areas as $area) : ?>
                        <option value="<?php echo $area['id']; ?>">
                            <?php echo $area['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input id="imagem" type="text" class="form-control" name="imagem" placeholder="Imagem do curso (hospedado no imgur)" required />
            </div>

            <div class="form-group">
                <label for="cor">Cor do curso</label>
                <input type="text" id="cor" name="cor" class="form-control demo minicolors-input" data-control="hue" size="7" placeholder="Cor do curso" required />
            </div>

            <div class="form-group">
                <label for="valor">Valor do curso</label>
                <input id="valor" type="number" class="form-control" name="valor" placeholder="Valor do curso" min="1" required />
            </div>

            <div class="form-group">
                <label for="vip">Vip</label>
                <select class="form-control" id="vip" name="vip" required >
                    <option value="">Escolha uma opção</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>

            <button class="btn btn-outline-dark btn-block">Adicionar</button>
        </form>
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
        },
        theme: 'bootstrap'
    });
</script>