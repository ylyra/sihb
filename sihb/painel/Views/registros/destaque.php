<?php if (isset($_SESSION['edit_registro']) && !empty($_SESSION['edit_registro']) && isset($_SESSION['edit_registro_tipo']) && !empty($_SESSION['edit_registro_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['edit_registro_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['edit_registro']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a>
    </div>

    <?php
    unset($_SESSION['edit_registro']);
    unset($_SESSION['edit_registro_tipo']);
    ?>
<?php endif; ?>
<div class="card">
    <h5 class="card-header">Adicionar destaque</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>registros/addDestaque">

            <div class="form-group">
                <label for="nickname" class="col-form-label">Nickname</label>
                <input id="nickname" type="text" class="form-control" name="nickname" placeholder="Nickname do membro..." required />
            </div>

            <div class="form-group">
                <label for="date-mask2">Data de começo <small class="text-muted">dd/mm/aaaa</small></label>
                <input type="text" class="form-control date-inputmask" id="date-mask2" name="data" required>
            </div>

            <div class="form-group">
                <label>Características</label>
                <select id='keep-order' multiple='multiple' name="caracte[]">
                    <option value='Agilidade'>Agilidade</option>
                    <option value='Treinamentos'>Treinamentos</option>
                    <option value='Atendimento'>Atendimento</option>
                    <option value='Ética'>Ética</option>
                    <option value='Proatividade'>Proatividade</option>
                    <option value='Liderança'>Liderança</option>
                    <option value='Ajuda'>Ajuda</option>
                    <option value='DEs'>DEs</option>
                    <option value='Respeito'>Respeito</option>
                    <option value='Disciplina'>Disciplina</option>
                    <option value='Perseverança'>Perseverança</option>
                    <option value='Humildade'>Humildade</option>
                    <option value='Lealdade'>Lealdade</option>
                    <option value='Honestidade'>Honestidade</option>
                </select>
            </div>

            <span id="alerta_selection"></span>

            <button class="btn btn-outline-success btn-block">Atualizar destaque</button>
        </form>
    </div>
</div>

<link rel="stylesheet" href="<?php echo BASE; ?>assets/vendor/multi-select/css/multi-select.css" />
<script src="<?php echo BASE; ?>assets/vendor/multi-select/js/jquery.multi-select.js"></script>
<script>
    $(document).ready(function() {
        $('#keep-order').multiSelect({
            keepOrder: true
        });
    });

    c('form').addEventListener('submit', e => {
        if ($("select#keep-order option:selected").length != 4) {
            e.preventDefault();
            c('form span#alerta_selection').innerHTML = '<div class="alert alert-danger alert-dismissible fade show mb-3">Selecione 4 características <a href="#" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></a></div>'
        }
    })
</script>