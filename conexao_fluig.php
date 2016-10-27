<?php
$db_server = '10.1.10.130\Producao';
$db_database = 'FLUIG';
$db_user = 'ecm';
$db_passwd = 'T0tv5Flu1g';

$connectionInfo = array("Database"=>$db_database, "UID"=>$db_user, "PWD"=>$db_passwd, "CharacterSet" => "UTF-8");
$con3 = sqlsrv_connect($db_server, $connectionInfo);