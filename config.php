<?php
require 'environment.php';

global $config;
$config = array();
if("ENVIRONMENT" == "development"){
    $config['dbname'] = 'loja';
    $config['host'] = 'localhost';
    $config['dbuser'] = "root";
    $config['dbpass'] =  "";
}else{
    $config['dbname'] = 'loja';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
    $config['host'] = 'localhost';
}
$config['status_pgto'] = [
    '1' => 'Aguardando pg',
    '2' => 'Aprovado',
    '3' => 'Cancelado'
];

