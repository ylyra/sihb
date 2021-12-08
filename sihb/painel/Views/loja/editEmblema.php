<div class="card">
    <h5 class="card-header">Editar emblema</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>loja/editEmblemaAction">

            <div class="form-group">
                <label for="img">Imagem</label>
                <input id="img" type="text" class="form-control" name="img" value="<?php echo $emblema['img']; ?>" required />
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input id="descricao" type="text" class="form-control" name="descricao" value="<?php echo $emblema['nome']; ?>" required />
            </div>

            <div class="form-group">
                <label for="valor_anterior">Valor Anterior</label>
                <input id="valor_anterior" type="number" class="form-control" name="valor_anterior" value="<?php echo $emblema['valor_anterior']; ?>" required />
            </div>
            
            <div class="form-group">
                <label for="valor">Valor</label>
                <input id="valor" type="number" class="form-control" name="valor" value="<?php echo $emblema['valor']; ?>" required />
            </div>

            <div class="form-group">
                <label for="limite">Limite (Deixe em branco caso queira como ilimitado)</label>
                <input id="limite" type="number" class="form-control" name="limite" value="<?php echo($emblema['limite'] >= 0 && $emblema['is_limited'] == 0)?$emblema['limite']:''; ?>"  />
            </div>

            <div class="form-group">
                <label for="vip">Vip?</label>
                <select class="form-control" id="vip" name="vip">
                    <option value="Não" <?php echo($emblema['vip'] == 0)?'selected':''; ?> >Não</option>
                    <option value="Sim" <?php echo($emblema['vip'] == 1)?'selected':''; ?> >Sim</option>
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo $emblema['id']; ?>">
            
            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>