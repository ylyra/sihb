<?php

namespace Models;

use \Core\Model;
use \Models\Uteis;

class Noticias extends Model
{

    // 0 = Sem revisão
    // 1 = Revisada
    // 2 = Fixada
    // 3 = Destacada

    public function getNoticia($filtros, $offset = 0, $limit = 9)
    {
        $array = [];
        $u = new Uteis();

        $paginas = ceil($this->getTotalNoticias($filtros) / 9);
        $valor = ($filtros['page'] * $limit) - $limit;
        $offset = ($filtros['page'] <= $paginas) ? $valor : 0;

        $where = $this->buildWhere($filtros);

        $sql = "SELECT *, (select count(*) from noticias_views where noticias_views.id_noticia = noticias.id) as views FROM noticias";
        $sql .= " WHERE " . implode(' AND ', $where);

        if ($filtros['ordem'] != 'views') {
            $sql .= " ORDER BY data " . $filtros['ordem'];
        } elseif ($filtros['ordem'] == 'views') {
            $sql .= " ORDER BY views DESC";
        }

        $sql .= " LIMIT $offset, $limit";

        $sql = $this->db->prepare($sql);
        $this->bindWhere($filtros, $sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $a = $sql->fetchAll();

            foreach ($a as $b) {
                $array[] = [
                    'id' => $b['id'],
                    'slug' => $b['slug'],
                    'data' => $b['data'],
                    'titulo' => $b['titulo'],
                    'subtitulo' => $b['subtitulo'],
                    'banner' => $b['banner'],
                    'texto' => $b['texto'],
                    'autor' => $b['autor'],
                    'autor_id' => $b['autor_id'],
                    'categoria' => $b['categoria'],
                    'status' => $b['status'],
                    'media' => $b['media'],
                    'postado_a' => $u->diferenca($b['data'])
                ];
            }
        }

        return $array;
    }

    public function getNoticiaById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 
            (select count(*) from noticias_comentarios where noticias_comentarios.id_noticia = noticias.id) as total_comentarios, 
            (select noticias_categorias.nome from noticias_categorias where noticias_categorias.id = noticias.categoria) as categoria_nome, 
            (select count(*) from noticias_avaliacoes where noticias_avaliacoes.id_noticia = noticias.id) as total_votos
        FROM noticias 
        WHERE id = :id AND status != 0");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getRecentes()
    {
        $array = [];

        $sql = $this->db->query("SELECT * FROM noticias WHERE status != 0 ORDER BY id DESC LIMIT 2");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getDestacadas()
    {
        $array = [];

        $sql = $this->db->query("SELECT *, (select noticias_categorias.nome from noticias_categorias where noticias_categorias.id = noticias.categoria) as categoria_nome FROM noticias WHERE status = 3 ORDER BY id DESC LIMIT 3");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getComentariosNoticiaById($id)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 

        (select count(*) from noticias_avaliacoes_comentarios where noticias_avaliacoes_comentarios.id_noticia_comentario = noticias_comentarios.id and tipo = 1) as likes, 

        (select count(*) from noticias_avaliacoes_comentarios where noticias_avaliacoes_comentarios.id_noticia_comentario = noticias_comentarios.id and tipo = 2) as deslikes

        FROM noticias_comentarios WHERE id_noticia = :id AND status = 0");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function verificarVoto($id_noticia, $id_registro)
    {
        $voto = 0;

        $sql = $this->db->prepare("SELECT avaliacao FROM noticias_avaliacoes WHERE id_noticia = :id_noticia AND id_registro = :id_registro");
        $sql->bindValue(':id_noticia', $id_noticia);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $voto = $array['avaliacao'];
        }

        return $voto;
    }

    public function verificarVotoComentarios($id_noticia, $id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT id_noticia_comentario, tipo FROM noticias_avaliacoes_comentarios WHERE id_noticia = :id_noticia AND id_registro = :id_registro");
        $sql->bindValue(':id_noticia', $id_noticia);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotalNoticias($filtros)
    {
        $where = $this->buildWhere($filtros);
        $sql = "SELECT COUNT(*) as c FROM noticias";
        $sql .= " WHERE " . implode(' AND ', $where);
        $sql = $this->db->prepare($sql);
        $this->bindWhere($filtros, $sql);
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }

    public function getCategorias()
    {
        $array = [];

        $sql = $this->db->query("SELECT * FROM noticias_categorias");

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addComentario($comentario, $id_noticia, $id_registro, $nickname, $data)
    {
        $sql = $this->db->prepare("INSERT INTO noticias_comentarios (id_noticia, id_registro, nickname, comentario, data) VALUES (:id_noticia, :id_registro, :nickname, :comentario, :data)");
        $sql->bindValue(':id_noticia', $id_noticia);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':nickname', $nickname);
        $sql->bindValue(':comentario', $comentario);
        $sql->bindValue(':data', $data);
        $sql->execute();

        $l = new \Models\Logs();
        $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $nickname . " fez um comentário na notícia com o #ID " . $id_noticia . " .";
        $l->addLog('noticias_comentario', $msg);
    }

    public function votarNoticia($id_noticia, $voto, $id_registro, $nickname)
    {
        if ($voto >= 1 && $voto <= 5) {

            $sql = $this->db->prepare("SELECT id FROM noticias_avaliacoes WHERE id_noticia = :id_noticia AND id_registro = :id_registro");
            $sql->bindValue(":id_noticia", $id_noticia);
            $sql->bindValue(":id_registro", $id_registro);
            $sql->execute();

            if ($sql->rowCount() == 0) {
                $sql = $this->db->prepare("INSERT INTO noticias_avaliacoes (id_noticia, id_registro, nickname, avaliacao) VALUES (:id_noticia, :id_registro, :nickname, :avaliacao)");
                $sql->bindValue(":id_noticia", $id_noticia);
                $sql->bindValue(":id_registro", $id_registro);
                $sql->bindValue(":nickname", $nickname);
                $sql->bindValue(":avaliacao", $voto);
                $sql->execute();

                $sql = $this->db->prepare("UPDATE noticias SET media = (select (SUM(avaliacao)/COUNT(*)) from noticias_avaliacoes where noticias_avaliacoes.id_noticia = noticias.id) WHERE id = :id");
                $sql->bindValue(":id", $id_noticia);
                $sql->execute();

                $l = new \Models\Logs();
                $msg = "No dia " . date('d/m/Y') . " às [" . date('H:i') . "] o(a) " . $nickname . " votou na notícia de #ID" . $id_noticia . ".";
                $l->addLog('noticias_voto', $msg);
            }
        }
    }

    public function votarComentario($id_noticia_comentario, $id_registro, $tipo, $id_noticia, $nickname)
    {
        $sql = $this->db->prepare("SELECT id FROM noticias_avaliacoes_comentarios WHERE id_noticia_comentario = :id_noticia_comentario AND id_registro = :id_registro");
        $sql->bindValue(":id_noticia_comentario", $id_noticia_comentario);
        $sql->bindValue(":id_registro", $id_registro);
        $sql->execute();

        if ($sql->rowCount() == 0) {

            $sql = $this->db->prepare("INSERT INTO noticias_avaliacoes_comentarios (id_noticia_comentario, id_noticia, id_registro, nickname, tipo) VALUES (:id_noticia_comentario, :id_noticia, :id_registro, :nickname, :tipo)");
            $sql->bindValue(":id_noticia_comentario", $id_noticia_comentario);
            $sql->bindValue(":id_noticia", $id_noticia);
            $sql->bindValue(":id_registro", $id_registro);
            $sql->bindValue(":nickname", $nickname);
            $sql->bindValue(":tipo", $tipo);
            $sql->execute();
        }
    }

    public function verificarComentario($id_comentario, $id_registro, $id_noticia, $tipo)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT id_noticia_comentario, tipo FROM noticias_avaliacoes_comentarios WHERE id_noticia_comentario = :id_comentario AND id_registro = :id_registro");
        $sql->bindValue(':id_comentario', $id_comentario);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();

            if ($tipo == $array['tipo']) {
                return 'class="active"';
            } else {
                return '';
            }
        } else {
            $retorno = 'onclick="curtirComentarioN(' . $id_comentario . ', ' . $id_registro . ', ' . $tipo . ', ' . $id_noticia . ')"';

            return $retorno;
        }
    }

    private function buildWhere($filters)
    {
        $where = array(
            'status >= 1'
        );

        if (!empty($filters['pesquise_por'])) {
            $where[] = "titulo LIKE :pesquise_por OR texto LIKE :pesquise_por_texto";
        }

        if ($filters['categoria'] != 'all') {
            $where[] = "categoria = :categoria";
        }

        if (!empty($filters['data_de'])) {
            $where[] = "data >= :data_de";
        }

        if (!empty($filters['data_ate'])) {
            $where[] = "data <= :data_ate";
        }

        return $where;
    }

    private function bindWhere($filters, &$sql)
    {
        if (!empty($filters['pesquise_por'])) {
            $sql->bindValue(":pesquise_por", '%' . $filters['pesquise_por'] . '%');
            $sql->bindValue(":pesquise_por_texto", '%' . $filters['pesquise_por'] . '%');
        }

        if (!empty($filters['categoria'])) {
            $sql->bindValue(":categoria", $filters['categoria']);
        }

        if (!empty($filters['data_de'])) {
            $de = explode('/', $filters['data_de']);
            $data_de = $de[2] . '-' . $de[1] . '-' . $de[0];
            $sql->bindValue(":data_de", $filters['data_de']);
        }

        if (!empty($filters['data_ate'])) {
            $ate = explode('/', $filters['data_ate']);
            $data_ate = $ate[2] . '-' . $ate[1] . '-' . $ate[0];
            $sql->bindValue(":data_ate", $filters['data_ate']);
        }
    }
}
