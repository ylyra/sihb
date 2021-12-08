<div class="card">
    <h5 class="card-header">Criar nova categoria</h5>
    <div class="card-body">
        <form action="<?php echo BASE; ?>jornal/categoriasAddAction" method="POST">

            <div class="form-group">
                <label for="nome" class="col-form-label">Nome</label>
                <input id="nome" type="text" class="form-control" name="nome" placeholder="Categoria nome..." required />
            </div>
            
            <button class="btn btn-outline-dark btn-block">Adicionar</button>
        </form>
    </div>
</div>