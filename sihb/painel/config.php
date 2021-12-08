<?php
require 'environment.php';

if (MANUTENCAO) {
	require 'maintenance.html';
	exit;
} else {
	$config = array();
	if(ENVIRONMENT == 'development') {
		define("BASE", "http://projetou.pc/sihb/painel/");
		define("BASE_PAI", "http://projetou.pc/sihb/");
		$config['dbname'] = 'sihb';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	} else {
		define("BASE", "https://pracas.exbrhb.net/");
		define("BASE", "https://pracas.exbrhb.net/");
		$config['dbname'] = 'exbrhb98_dados';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'exbrhb98_acesso';
		$config['dbpass'] = '~24J[=R^xh3U';
	}

	global $db;
	try {
		$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	} catch(PDOException $e) {
		echo "ERRO: ".$e->getMessage();
		exit;
	}

}