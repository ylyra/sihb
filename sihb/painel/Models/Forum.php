<?php
namespace Models;

use \Core\Model;
use \Models\Uteis;

class Forum extends Model {

    // 0 = Sem revisão
    // 1 = Revisada
    // 2 = Fixada
    // 3 = Fechada
    // 4 = Deletada

    public function getTopicoById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *,
        (select count(*) from forum_comentarios where forum_comentarios.id_registro = forum.autor_id) as total_msgsT,
        (select count(*) from forum where forum.autor_id = forum.autor_id) as total_msgsF,
        (select patente_id from registros where registros.id = forum.autor_id) as cargo_id,
        (select nome from patentes where patentes.id = cargo_id) as cargo,
        (select avatar_forum from registros where registros.id = forum.autor_id) as avatar_forum,
        (select descricao_forum from registros where registros.id = forum.autor_id) as descricao_forum
        FROM forum 
        WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getTopicos()
    {
        $array = [];

        $sql = $this->db->query("SELECT * FROM forum ORDER BY id DESC");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getComentarios()
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select forum.slug from forum where forum.id = forum_comentarios.id_topico) as slug FROM forum_comentarios ORDER BY id DESC");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getComentariosForumById($offset, $limit, $id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 

        (select count(*) from forum_comentarios where forum_comentarios.id_registro = forum_comentarios.id_registro) as total_msgsT,
        (select count(*) from forum where forum.autor_id = forum_comentarios.id_registro) as total_msgsF,
        (select patente_id from registros where registros.id = forum_comentarios.id_registro) as cargo_id,
        (select nome from patentes where patentes.id = cargo_id) as cargo,
        (select avatar_forum from registros where registros.id = forum_comentarios.id_registro) as avatar_forum,
        (select descricao_forum from registros where registros.id = forum_comentarios.id_registro) as descricao_forum
        
        FROM forum_comentarios WHERE id_topico = :id LIMIT $offset, $limit");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotalTopicos($status = [])
    {
        $sql = "SELECT COUNT(*) as c FROM forum ";
        if (count($status) > 0) {
            $sql .= "WHERE status IN (".implode(', ', $status).")";
        }
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }

    public function updateStatus($id, $status, $ofc_nickname)
    {
        $sql = $this->db->prepare("UPDATE forum SET status = :status WHERE id = :id");
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia ".date('d/m/Y')." às [".date('H:i')."] o(a) ".$ofc_nickname." atualizou o status do tópico de #ID ".$id.".";
        $l->addLog('forum_update', $msg);
    }

    public function delComentario($id, $ofc_nickname)
    {
        $sql = $this->db->prepare("DELETE FROM forum_comentarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia ".date('d/m/Y')." às [".date('H:i')."] o(a) ".$ofc_nickname." deletou um comentário de #ID ".$id.".";        
        $l->addLog('forum_del', $msg);
    }
	
}
