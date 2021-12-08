<?php if ($tipo == 1 || $tipo == 4 || $tipo == 5): ?>
    <div class="shop-item-body">
        <h2>
            <?php echo $produto['nome']; ?>
        </h2>

        <div class="item">
            <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />

            <div>
                <?php if ($produto['valor_anterior'] != 0): ?>
                    <p class="de">De <span><?php echo $produto['valor_anterior']; ?>c</span></p>                    
                <?php endif; ?>
                <p class="por">Por <span><?php echo $produto['valor']; ?>c</span></p>
            </div>
        </div>
    </div>
    <div class="shop-item-footer">
        <button class="presentear" onclick="shopItem(this, 2, <?php echo $produto['id']; ?>)">
            <img src="https://i.imgur.com/80OPtsi.png" alt="Presentear" />
        </button>

        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
            Comprar 
            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
        </button>
    </div>
<?php elseif($tipo == 2): ?>
    <div class="presenteie">
        <div style="position:relative;">
            <p class="msg">Digite o nome do membro que deseja presentear</p>
            <img src="https://i.imgur.com/80OPtsi.png" alt="Presente" style="position:absolute;right:0;top:-10px;" />
        </div>

        <div style="width:-webkit-fill-available;position: relative;">
            <input type="text" id="nickname_user" placeholder="Digite aqui" />
            <img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=sihb&action=std&direction=3&head_direction=4&img_format=png&gesture=std&headonly=1&size=s" alt="Habbo Head" id="user_img_presente" style="position:absolute;right: 0;top: 5px;" />
        </div>

        <div style="display:flex;justify-content:space-between;width:-webkit-fill-available;">
            <button onclick="cleanInput(this)" id="limpar">Limpar</button>
            <button onclick="shopItem(this, 4, <?php echo $produto['id']; ?>)" id="presentear">Presentear</button>
        </div>
    </div>
<?php elseif($tipo == 3): ?>
    <div class="comprar">
        <p class="msg">Tem certeza que deseja comprar este item?</p>
        <div class="item">
            <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />

            <div>
                <?php if ($produto['valor_anterior'] != 0): ?>
                    <p class="de">De <span><?php echo $produto['valor_anterior']; ?>c</span></p>                    
                <?php endif; ?>
                <p class="por">Por <span><?php echo $produto['valor']; ?>c</span></p>
            </div>
        </div>

        <div style="display:flex;justify-content:space-between;width:-webkit-fill-available;">
            <button onclick="shopItem(this, 1, <?php echo $produto['id']; ?>)" id="nao">Não</button>
            <button onclick="shopItem(this, 5, <?php echo $produto['id']; ?>)" id="sim">Sim</button>
        </div>
    </div>
<?php elseif($tipo == 6): ?>
    <div class="sem-saldo">
        <p class="msg">Item não comprado!</p>

        <div class="item">
            <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />
        </div>

        <div class="fim">
            Saldo insuficiente
        </div>
    </div>
<?php elseif($tipo == 7): ?>
    <div class="finalizado">
        <p class="msg">Item comprado!</p>

        <div class="item">
            <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />
        </div>

        <div class="fim">
            <strong>-<?php echo $produto['valor']; ?>c</strong> na sua carteira
        </div>
    </div>

    <audio autoplay> 
        <source src="<?php echo BASE; ?>assets/audio/payment.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
<?php endif; ?>