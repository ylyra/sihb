<?php

namespace Models;

use \Core\Model;

class Cursos extends Model
{


    public function getMeusCursos($id_registro)
    {
        $array = [];
        $sql = $this->db->prepare("SELECT 
            cursos_alunos.id_curso,
            cursos.nome,
            cursos.imagem,
            cursos.descricao,
            cursos.cor,
            cursos.modulo_nome,
            IFNULL(((100 * (SELECT COUNT(*) FROM cursos_historico WHERE cursos_historico.id_curso = cursos_alunos.id_curso AND cursos_historico.id_registro = cursos_alunos.id_registro)) / (SELECT COUNT(*) FROM cursos_aulas WHERE cursos_aulas.id_curso = cursos_alunos.id_curso)), 0) AS porcentagem
        FROM 
            cursos_alunos
        LEFT JOIN cursos ON cursos_alunos.id_curso = cursos.id
        WHERE cursos_alunos.id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getCurso($id, $id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 
            (select cursos_area.nome from cursos_area where cursos_area.id = cursos.id_area) as cursoArea, 
            (select cursos_area.cor from cursos_area where cursos_area.id = cursos.id_area) as cursoCor, 
            (select cursos_area.imagem from cursos_area where cursos_area.id = cursos.id_area) as cursoImagem,

            IFNULL(((100 * (SELECT COUNT(*) FROM cursos_historico WHERE cursos_historico.id_curso = cursos.id AND cursos_historico.id_registro = :id_registro)) / (SELECT COUNT(*) FROM cursos_aulas WHERE cursos_aulas.id_curso = cursos.id)), 0) AS porcentagem 
        FROM 
            cursos 
        WHERE id = :id");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getAreas($id_registro)
    {
        $array = [];

        $sql = $this->db->query("SELECT * FROM cursos_area");

        if ($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach ($rows as $row) {
                $array[] = [
                    'id' => $row['id'],
                    'nome' => $row['nome'],
                    'cursos' => $this->getCursosArea($row['id'], $id_registro)
                ];
            }
        }


        return $array;
    }

    public function totalCursosTipo($id_registro, $completo)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM cursos_alunos WHERE id_registro = :id_registro AND completo = :completo");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':completo', $completo);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function totalCursos($id_registro)
    {
        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM cursos_alunos WHERE id_registro = :id_registro");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function totalCursosG()
    {
        $sql = $this->db->query("SELECT COUNT(*) as c FROM cursos");
        $sql = $sql->fetch();
        return $sql['c'];
    }

    public function getCursosArea($id_area, $id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, (select count(*) from cursos_alunos where cursos_alunos.id_registro = :id_registro and cursos_alunos.id_curso = cursos.id) as tenho FROM cursos WHERE id_area = :id_area");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id_area', $id_area);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function tenhoCurso($id_curso, $id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM cursos_alunos WHERE id_curso = :id_curso AND id_registro = :id_registro");
        $sql->bindValue(':id_curso', $id_curso);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getAulasCurso($id_curso, $id_registro)
    {
        $array = [];

        $sql = $this->db->prepare("SELECT *, 
            (select cursos_videos.url from cursos_videos where cursos_videos.id_aula = cursos_aulas.id) as videoId,
            (select count(*) from cursos_historico where cursos_historico.id_registro = :id_registro and cursos_historico.id_aula = cursos_aulas.id and cursos_historico.id_curso = cursos_aulas.id_curso) as assistiu
        FROM cursos_aulas WHERE id_curso = :id_curso");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id_curso', $id_curso);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getHistorico($id_registro) {
        $array = [];

        $sql = $this->db->prepare("SELECT *,
            (select cursos.nome from cursos where cursos.id = cursos_historico.id_curso) as nome, 
            (select cursos.imagem from cursos where cursos.id = cursos_historico.id_curso) as imagem, 
            (select cursos.cor from cursos where cursos.id = cursos_historico.id_curso) as cor, 
            (select cursos.modulo_nome from cursos where cursos.id = cursos_historico.id_curso) as modulo_nome,

            IFNULL(
                (
                    (100 * (SELECT COUNT(*) FROM cursos_historico WHERE cursos_historico.id_curso = cursos_historico.id_curso AND cursos_historico.id_registro = cursos_historico.id_registro)) / 
                    (SELECT COUNT(*) FROM cursos_aulas WHERE cursos_aulas.id_curso = cursos_historico.id_curso)
                ), 
                0
            ) AS porcentagem 
        FROM 
            cursos_historico 
        WHERE 
            id_registro = :id_registro 
        ORDER BY 
            id 
        DESC 
        LIMIT 3");
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function comprarCurso($curso, $id_registro)
    {
        $sql = $this->db->prepare("INSERT INTO cursos_alunos (id_curso, id_registro, completo) VALUES (:id_curso, :id_registro, 0)");
        $sql->bindValue(':id_curso', $curso['id']);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        $r = new \Models\Registros();
        $valor = '-' . $curso['valor'];
        $r->addMoedas($id_registro, $valor);
    }

    public function addView($id_curso, $id_aula, $id_registro)
    {
        if (!$this->naoViu($id_curso, $id_aula, $id_registro)) {
            $sql = $this->db->prepare("INSERT INTO cursos_historico (data_viewed, id_registro, id_aula, id_curso) VALUES (:data_viewed, :id_registro, :id_aula, :id_curso)");
            $sql->bindValue(':data_viewed', date('Y-m-d H:i:s'));
            $sql->bindValue(':id_registro', $id_registro);
            $sql->bindValue(':id_aula', $id_aula);
            $sql->bindValue(':id_curso', $id_curso);
            $sql->execute();

        }
        $this->verify($id_curso, $id_registro);
    }

    private function naoViu($id_curso, $id_aula, $id_registro)
    {
        $sql = $this->db->prepare("SELECT * FROM cursos_historico WHERE id_curso = :id_curso AND id_registro = :id_registro AND id_aula = :id_aula");
        $sql->bindValue(':id_curso', $id_curso);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->bindValue(':id_aula', $id_aula);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        }

        return false;
    }

    private function verify($id_curso, $id_registro)
    {
        $sql = $this->db->prepare("SELECT 
            COUNT(*) as total_vistas,
            (select count(*) from cursos_aulas where cursos_aulas.id_curso = cursos_historico.id_curso) as total_aulas
        FROM cursos_historico WHERE id_curso = :id_curso AND id_registro = :id_registro");
        $sql->bindValue(':id_curso', $id_curso);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $a = $sql->fetch();

            if(intval($a['total_vistas']) == intval($a['total_aulas'])) {
                $this->completarCurso($id_curso, $id_registro);
            }
        }
    }

    private function completarCurso($id_curso, $id_registro)
    {
        $sql = $this->db->prepare("UPDATE cursos_alunos SET completo = 1 WHERE id_curso = :id_curso AND id_registro = :id_registro");
        $sql->bindValue(':id_curso', $id_curso);
        $sql->bindValue(':id_registro', $id_registro);
        $sql->execute();
    }


}
