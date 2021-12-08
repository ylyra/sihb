<?php
namespace Models;

use \Core\Model;

class Uteis extends Model {

    public function trocarItens($msg)
    {
        $valores = array(
            '@\<div (.*?)\>(.*?)\<\/div\>@' => '$2',
            '@\<header (.*?)\>(.*?)\<\/header\>@' => '$2',
            '@\<main (.*?)\>(.*?)\<\/main\>@' => '$2',
            '@\<footer (.*?)\>(.*?)\<\/footer\>@' => '$2',
            '@\<section (.*?)\>(.*?)\<\/section\>@' => '$2',
            '@\<article (.*?)\>(.*?)\<\/article\>@' => '$2',
            '@\<aside (.*?)\>(.*?)\<\/aside\>@' => '$2',
            '@\<nav (.*?)\>(.*?)\<\/nav\>@' => '$2',
            '@\<h1 (.*?)\>(.*?)\<\/h1\>@' => '$2',
            '@\<h2 (.*?)\>(.*?)\<\/h2\>@' => '$2',
            '@\<h3 (.*?)\>(.*?)\<\/h3\>@' => '$2',
            '@\<h4 (.*?)\>(.*?)\<\/h4\>@' => '$2',
            '@\<h5 (.*?)\>(.*?)\<\/h5\>@' => '$2',
            '@\<h6 (.*?)\>(.*?)\<\/h6\>@' => '$2',
            '@\<p (.*?)\>(.*?)\<\/p\>@' => '$2',
            '@\<span (.*?)\>(.*?)\<\/span\>@' => '$2',
            '@\<pre (.*?)\>(.*?)\<\/pre\>@' => '$2',
            '@\<b (.*?)\>(.*?)\<\/b\>@' => '$2',
            '@\<i (.*?)\>(.*?)\<\/i\>@' => '$2',
            '@\<a (.*?)\>(.*?)\<\/a\>@' => '$2',
            '@\<ol (.*?)\>(.*?)\<\/ol\>@' => '$2',
            '@\<ul (.*?)\>(.*?)\<\/ul\>@' => '$2',
            '@\<li (.*?)\>(.*?)\<\/li\>@' => '$2',
            '@\<script (.*?)\>(.*?)\<\/script\>@' => '',
            '@\<meta (.*?)\/\>@' => ''
        );

        $msg = preg_replace(array_keys($valores), array_values($valores), $msg);
        $ms = str_replace('<', '&#60;', $msg);
        $msg = str_replace('>', '&#62;', $ms);
        $msg = str_replace('"', '&quot;', $msg);
        $msg = str_replace("'", "&#039;", $msg);
        $msg = str_replace("&#60;br&#62;", "<br/>", $msg);
        $msg = str_replace("&#60;br/&#62;", "<br/>", $msg);

        return $msg;
    }

    public static function replaceBBcodes($msg)
    {
        $valores = array(
            '@\[b\](.*?)\[/b\]@' => '<b>$1</b>',
            '@\[i\](.*?)\[/i\]@' => '<i>$1</i>',
            '@\[u\](.*?)\[/u\]@' => '<span style="text-decoration:underline;">$1</span>',
            '@\[citar\]([^"><]*?)\[/citar\]@' => '<div class="citacao">$1</div>',
            '@\[nickname\]([^"><]*?)\[/nickname\]@' => '<div class="de">$1</div>',
            '@\[user\]([^"><]*?)\[/user\]@' => '<div class="de">$1</div>',
            '@\[msg\]([^"><]*?)\[/msg\]@' => '<div class="citacao-msg">$1</div>',
            '@\[size=([^"><]*?)\](.*?)\[/size\]@' => '<span style="font-size:$1px;">$2</span>',
            '@\[color=([^"><]*?)\](.*?)\[/color\]@' => '<span style="color:$1;">$2</span>',
            '@\[url=((?:ftp|https?)://[^"><]*?)\](.*?)\[/url\]@' => '<a href="$1">$2</a>',
            '@\\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]@' => '<img src="$1" alt="Imagem" />'
        );
        
        $msg = preg_replace(array_keys($valores), array_values($valores), $msg);

        return $msg;
    }
    
    public function temCitacao($msg)
    {

        if (preg_match('@\[citar\]([^"><]*?)\[/citar\]@', $msg) === 1) {
            return true;
        }
        
        return false;
    }

	public function encripta($senha){
		// VEJA QUE PRIMEIRO EU VOU GERAR UM SALT JÁ ENCRIPTADO EM MD5
		$salt = md5('painel_praca');
		
		//PRIMEIRA ENCRIPTAÇÃO ENCRIPTANDO COM crypt
		$codifica = crypt($senha,$salt);

		// SEGUNDA ENCRIPTAÇÃO COM sha512 (128 bits)
		$codifica = hash('sha512',$codifica);

		//AGORA RETORNO O VALOR FINAL ENCRIPTADO
		return $codifica;
	}

	public function criar_slug($text) {
 
        $replace = [
            '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
            '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä'=> 'Ae',
            '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
            'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
            'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
            'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
            'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
            'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
            'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
            'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
            'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
            'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
            'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
            'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
            'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
            '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
            'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
            'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
            'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
            'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
            'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
            'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
            'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
            'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
            'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
            'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
            'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
            '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
            'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
            'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
            'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
            'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
            'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => 'b',
            'Ы' => 'Y', 'Ь' => 'b', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
            'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
            'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ъ' => 'b', 'ы' => 'y', 'ь' => 'b', 'э' => 'e',
            'ю' => 'yu', 'я' => 'ya'
        ];
     
        $text = strtr($text, $replace);
        $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);
        $text = trim($text, '-');
        $text = preg_replace('~[^-\w.]+~', '', $text);
        $text = strtolower($text);
     
        return $text;
    }

    function getMotto($name)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip, deflate, sdch'));
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $get = array('', '');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie:" . $get[0] . "=" . $get[1]));
        curl_setopt($ch, CURLOPT_URL, "http://www.habbo.com.br/api/public/users?name=" . $name);

        $id = json_decode(curl_exec($ch));

        $info = $id->motto;

        return $info;
    }

    public function diferenca($dt)
    {
        $ano = 31536000;
        $mes = 2592000;
        $dia = 86400;
        $hora = 3600;
        $minuto = 60;

        $time = strtotime($dt);
        $now = date('Y-m-d H:i:s');
        $now = strtotime($now);

        $dif = $now - $time;

        if ($dif < $minuto) {

            // Segundos

            return $dif . 's';
        } else if ($dif < $hora) {

            // Minutos

            $resultado = floor($dif / $minuto);
            return $resultado . 'm';
        } else if ($dif < $dia) {

            // Horas

            $resultado = floor($dif / $hora);

            return $resultado . 'h';
        } else if ($dif < $mes) {

            // Dias

            $resultado = floor($dif / $dia);

            return $resultado . 'd';
        } else if ($dif > $mes && $dif < $ano) {
            // Mês
            $resultado = floor($dif / $mes);

            return $resultado . 'm';
        } else if ($dif >= $ano) {
            // Ano

            $resultado = floor($dif / $ano);

            return $resultado . 'a';
        }
    }

    public function msgConfianca($sexo, $nivel)
    {
        $msg = '';

        if ($nivel <= 25) {
            
            $msg = 'Está precisando dar uma recalibrada nessas tarefas, hein? Chega lá na Sede pra gente te ajudar!';

        } elseif ($nivel >= 26 && $nivel <= 50) {
            
            $msg = 'Procure cumprir mais tarefas durante a semana! Ainda tem jeito de conquistar sua tão sonhada promoção!';
            
        } elseif ($nivel >= 51 && $nivel <= 75) {
            
            if ($sexo == 0) {
                $msg = 'Você já pensou em ser Diretor(a) do SIHB, meu/minha amigo(a)? Desse jeito ninguém te segura!';
            } elseif ($sexo == 1) {
                $msg = 'Você já pensou em ser Diretor do SIHB, meu amigo? Desse jeito ninguém te segura!';
            } elseif ($sexo == 2) {
                $msg = 'Você já pensou em ser Diretora do SIHB, minha amiga? Desse jeito ninguém te segura!';
            }
            
        } elseif ($nivel >= 76 && $nivel <= 100) {
            
            $msg = 'Que trabalho impecável é esse?!! Desse jeito até o SIHB fica com medo de perder o cargo pra você!';
            
        }

        return $msg;
    }

    public function geoLocationData($ip)
    {
        $data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip)); 
        return "{$data['geoplugin_city']}, {$data['geoplugin_regionCode']}";
    }

    public function hexToRgb($hex)
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        $retorno = "$r, $g, $b";        
        return $retorno;
    }

    public function rgbToHex($rgb)
    {
        $rgb = explode(', ', $rgb);
        $color = sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2],); // #0d00ff
        return $color;
    }
	
}
