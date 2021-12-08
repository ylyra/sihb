<?php if (count($emblemas) > 0): ?>
    <?php foreach ($emblemas as $produto): ?>
        <div class="shop-item <?php echo($produto['limite'] == 0)?'esgotado':''; ?>">
            <div class="shop-item-body">
                <h2>
                    <?php echo $produto['nome']; ?>
                    <?php if ($produto['vip'] == 1): ?>
                        <img src="https://i.imgur.com/1DBSVgG.png" alt="vip" style="margin-bottom:-5px;">
                    <?php endif; ?>
                </h2>

                <div class="item">
                    <img src="<?php echo $produto['img']; ?>" alt="<?php echo $produto['nome']; ?>" />

                    <div>
                        <?php if ($produto['valor_anterior'] != 0): ?>
                            <p class="de">De <span><?php echo $produto['valor_anterior']; ?>Sc</span></p>                    
                        <?php endif; ?>
                        <p class="por">Por <span><?php echo $produto['valor']; ?>Sc</span></p>
                    </div>
                </div>
            </div>
            <div class="shop-item-footer">
                
                <?php if ($produto['vip'] == 1 && $acesso->getInfo('vip') == 1): ?>
                    <?php if ($produto['tipo'] == 1): ?>
                        <button class="presentear" onclick="shopItem(this, 2, <?php echo $produto['id']; ?>)">
                            <img src="https://i.imgur.com/80OPtsi.png" alt="Presentear" />
                        </button>
                    <?php endif; ?>

                    <?php if (!$loja->compreiProduto($acesso->getInfo('id_registro'), $produto['id']) && $produto['tipo'] == 1): ?>
                        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                            Comprar 
                            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                        </button>  
                    <?php else: ?>
                        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                            Comprar 
                            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                        </button>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($produto['vip'] == 0): ?>
                    <?php if ($produto['tipo'] == 1): ?>
                        <button class="presentear" onclick="shopItem(this, 2, <?php echo $produto['id']; ?>)">
                            <img src="https://i.imgur.com/80OPtsi.png" alt="Presentear" />
                        </button>
                    <?php endif; ?>

                    <?php if (!$loja->compreiProduto($acesso->getInfo('id_registro'), $produto['id']) && $produto['tipo'] == 1): ?>
                        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                            Comprar 
                            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                        </button>
                    <?php else: ?>
                        <button class="comprar" onclick="shopItem(this, 3, <?php echo $produto['id']; ?>)">
                            Comprar 
                            <img src="https://i.imgur.com/KEXmGCz.png" alt="Comprar" />
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>