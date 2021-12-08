<?php if (isset($_SESSION['emblema']) && !empty($_SESSION['emblema']) && isset($_SESSION['emblema_tipo']) && !empty($_SESSION['emblema_tipo'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['emblema_tipo']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['emblema']; ?>
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </a>
    </div>

    <?php 
        unset($_SESSION['emblema']);
        unset($_SESSION['emblema_tipo']);
    ?>
<?php endif; ?>
<div class="card">
    <h5 class="card-header">Adicionar moedas</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>loja/addMoedasAction">

            <div class="nicknames">
                <div class="row" style="align-items:flex-end;">
                    <div class="form-group col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                        <label for="nickname" class="col-form-label">Nickname</label>
                        <input id="nickname" type="text" class="form-control" name="nicksnames[]" placeholder="Nickname do membro..." required />
                    </div>

                    <div class="form-group col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                        <button class="btn btn-outline-success btn-block" type="button" onclick="addInput('nicknames')"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="number" name="valor" id="valor" class="form-control" placeholder="Digite o valor das moedas" />
            </div>
            
            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>