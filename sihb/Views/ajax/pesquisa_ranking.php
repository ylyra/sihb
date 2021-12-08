<?php if (count($meugeral) > 0): ?>
    <tr>
        <td><?php echo $meugeral['posicao']; ?></td>
        <td style="background-image:url('http://www.habbo.com.br/habbo-imaging/avatarimage?&user=<?php echo $meugeral['nickname']; ?>&action=std&direction=3&head_direction=2&img_format=gif&gesture=std&headonly=1&size=m');"></td>
        <td class="text-white"><?php echo $meugeral['nickname']; ?></td>
        <td><?php echo $meugeral['total']; ?></td>
    </tr>
<?php endif; ?>