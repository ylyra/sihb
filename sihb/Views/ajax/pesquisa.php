<?php if (count($registro) > 0) : ?>
    <div class="mb-10 pesquise">
        <?php echo $registro['nickname']; ?>
        <span class="status <?php echo strtolower($registro['status']); ?>">
            • <?php echo $registro['status']; ?>
        </span>
    </div>

    <div class="d-flex space-between" style="position:relative;">
        <div class="info ml-20">
            <strong>Cargo: </strong> <?php echo $registro['patente']; ?><br />
            <strong>Última promoção: </strong> <?php echo date('d/m/Y', strtotime($registro['ultima_promocao'])); ?><br />
            <strong>Promovido por: </strong> <?php echo $registro['promovido_por']; ?><br />
            <strong>Faixa BJJ: </strong> <span class="faixa-bjj <?php echo $registro['faixa_nome']; ?>"></span><br />

            <a href="<?php echo BASE; ?>profile/<?php echo $registro['nickname']; ?>" target="_blank" class="btn perfil">Perfil</a>
        </div>

        <div class="avatar">
            <img src="https://habbo.com.br/habbo-imaging/avatarimage?user=<?php echo $registro['nickname']; ?>&action=std&direction=4&head_direction=4&gesture=sml&size=m" alt="avatar habbo" style="position:absolute;bottom:10px;right:10px;" />
            <img src="https://i.imgur.com/JVngWt4.png" alt="palanque habbo" />
        </div>
    </div>
    <style>
        div#busca-registro .pesquise {
            display: flex;
            align-items: center;
            padding-left: 10px;
            padding-right: 10px;
            width: 210px;
            position: relative;
        }

        div#busca-registro .pesquise .status {
            font-size: 9px;
            position: absolute;
            right: 10px;
            color: #fff;
            font-weight: 900;
        }

        div#busca-registro .pesquise .status.ativo {
            color: rgb(1, 216, 0);
        }

        div#busca-registro .pesquise .status.demitido {
            color: #EE2223;
        }

        .info a.perfil {
            border: 2px solid #fff;
            width: 200px;
            font-weight: bold;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
        }

        .info a.perfil:hover {
            background: #fff;
            color: #1b1b1b;
        }
    </style>
<?php else : ?>
    <div class="mb-10 pesquise" style="width:fit-content;padding-right:10px;padding-left:10px;">
        Este usuário não está registrado!
    </div>
<?php endif; ?>