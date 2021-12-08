<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');

require 'config.php';
require 'vendor/autoload.php';
require 'routers.php';

$core = new Core\Core();
$core->run();
