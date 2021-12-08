<div class="card">
    <h5 class="card-header">Dar curso</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>cursos/darCursoAction" method="POST">

            <div class="nicknames">
                <div class="row" style="align-items:flex-end;">
                    <div class="form-group col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                        <label for="nickname" class="col-form-label">Nickname</label>
                        <input id="nickname" type="text" class="form-control" name="nicknames[]" placeholder="Nickname do membro..." required />
                    </div>

                    <div class="form-group col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                        <button class="btn btn-outline-success btn-block" type="button" onclick="addInput('nicknames')"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="curso">Curso</label>
                <select class="form-control" id="curso" name="curso" required>
                    <option value="">Escolha um curso</option>
                    <?php foreach ($cursos as $curso) : ?>
                        <option value="<?php echo $curso['id']; ?>">
                            <?php echo $curso['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $id_externo; ?>">

            <button class="btn btn-outline-dark btn-block">Adicionar</button>
        </form>
    </div>
</div>