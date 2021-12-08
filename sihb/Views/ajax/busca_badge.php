<div class="imagem">
    <img src="<?php echo $badge['img']; ?>" alt="<?php echo utf8_decode($badge['nome']); ?>">
</div>

<div class="info">
    <h3><?php echo utf8_decode($badge['nome']); ?></h3>
    <p><?php echo utf8_decode($badge['descricao']); ?></p>

    <div class="botoes">
        <button class="status <?php echo $tipos[$badge['status']] ?> btn">
            <img src="<?php echo $urls[$badge['status']] ?>" alt="Cadeado" />
            Grupo <?php echo $tipos[$badge['status']] ?>
        </button>

        <a href="<?php echo $badge['quarto']; ?>" class="quarto btn">
            <img src="https://i.imgur.com/FvzLNrE.png" alt="Cadeado" />
            Ir para o quartel do grupo
        </a>
    </div>
</div>