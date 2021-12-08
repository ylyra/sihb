<div class="curso" data-cursoId="<?php echo $curso['id']; ?>" data-cursoAulaId="<?php echo $aulas[0]['id']; ?>">
    <div class="video" style="height:290px;width: 100%;max-width: 440px;">
        <div id="player" data-videoId="<?php echo $aulas[0]['videoId']; ?>"></div>        
    </div>
    <div class="infos">
        <div>
            <?php
                $tipo = 'incompleto';
                if (ceil($curso['porcentagem']) >= 51 && ceil($curso['porcentagem']) <= 99) {
                    $tipo = 'metade';
                } elseif (ceil($curso['porcentagem']) == 100) {
                    $tipo = 'completo';
                }
            ?>
            <h4 style="background: rgb(<?php echo $curso['cor']; ?>);"><?php echo $curso['modulo_nome']; ?></h4>

            <h1><?php echo $curso['nome']; ?></h1>

            <p class="status-info <?php echo $tipo; ?>">
                <span class="status-number">
                    <?php echo ceil($curso['porcentagem']); ?></span>% concluido
            </p>
            <div class="status-bar <?php echo $tipo; ?>" style="background-size: <?php echo ceil($curso['porcentagem']); ?>%;"></div>

            <p><?php echo $curso['descricao']; ?></p>
        </div>

        <div class="proximos">
            <ul>
                <?php foreach ($aulas as $aulaIndex => $aula): ?>
                    <li class="<?php echo($aulaIndex == 0)?'atual':''; ?><?php echo($aula['assistiu'])?' assistida':''; ?>" data-videoId="htc1z4Uv0HA" id="aula<?php echo $aula['id']; ?>" onclick="proximaAula(<?php echo $aula['id']; ?>)" ><?php echo $aula['nome']; ?></li>                
                <?php endforeach; ?>
            </ul>
        </div>

        <div style="background:<?php echo $curso['cursoCor']; ?>;" class="info" >
            <img src="<?php echo $curso['cursoImagem']; ?>" alt="<?php echo $curso['cursoArea']; ?>">

            <p>
                Este curso faz parte do departamento <?php echo $curso['cursoArea']; ?>
            </p>
        </div>
    </div>
</div>