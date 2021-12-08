<div class="card">
    <h5 class="card-header">Adicionar benefício</h5>
    <div class="card-body">
        <form method="POST" action="<?php echo BASE; ?>loja/addBeneficioAction">

            <div class="form-group">
                <label for="img">Imagem</label>
                <input id="img" type="text" class="form-control" name="img" placeholder="Imagem do Benefício (Exemplo: https://i.imgur.com/Za8j5Uf.gif)" required />
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input id="descricao" type="text" class="form-control" name="descricao" placeholder="Descrição do benefício" required />
            </div>
            
            <div class="form-group">
                <label for="valor">Valor</label>
                <input id="valor" type="number" class="form-control" name="valor" placeholder="Valor do benefício. (Exemplo: 1)" required />
            </div>

            <div class="form-group">
                <label for="limite">Limite (Deixe em branco caso queira como ilimitado)</label>
                <input id="limite" type="number" class="form-control" name="limite" placeholder="Limite de benefício. (Exemplo: 1)"  />
            </div>

            <div class="form-group">
                <label for="vip">Vip?</label>
                <select class="form-control" id="vip" name="vip">
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
                </select>
            </div>
            
            <button class="btn btn-outline-success btn-block">Enviar</button>
        </form>
    </div>
</div>