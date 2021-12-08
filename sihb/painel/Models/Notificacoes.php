<?php
namespace Models;

use \Core\Model;

class Notificacoes extends Model {

    // ! 1 = Mensagem
    // ! 2 = Favoritos
    // ! 3 = Melhores amigos
    // ! 4 = Moedas
    // ! 5 = Presente

    public function addNotificacao($tipo, $texto, $id_registro)
    {       
        $sql = $this->db->prepare("INSERT INTO notificacoes (id_registro, tipo, texto) VALUES (:id_registro, :tipo, :texto)");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':texto', $texto);
        $sql->execute();
    }

    public function deleteNotificacoes($id_registro)
    {
        $sql = $this->db->prepare("DELETE FROM notificacoes WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }
	
}
