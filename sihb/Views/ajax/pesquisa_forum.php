<?php if (count($pesquisas) > 0): ?>
    <?php foreach ($pesquisas as $destaque): ?>
        <div class="post d-flex">
            <div class="avatar">
                <img src="http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $destaque['autor']; ?>&action=std&direction=4&head_direction=3&img_format=png&gesture=std&headonly=1&size=b" alt="Cabeça do habbo <?php echo $destaque['autor']; ?>">
            </div>

            <div class="ml-10">
                <p><a href="<?php echo BASE; ?>forum/abrir/<?php echo $destaque['id']; ?>/<?php echo $destaque['slug']; ?>"><span><?php echo $destaque['titulo']; ?></span></a></p>
                <div class="mt-5 d-flex infos ">
                    <span class="info"><i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $destaque['autor']; ?></span>

                    <span class="info">
                        <i class="fa fa-calendar"></i>&nbsp;&nbsp;
                        <?php echo $u->diferenca($destaque['data']); ?> atrás
                    </span>

                    <span class="info2">
                        <?php echo $destaque['respostas']; ?>
                        <img src="https://i.imgur.com/qRRpLOQ.png" alt="Mensagens">
                    </span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
<?php endif; ?>