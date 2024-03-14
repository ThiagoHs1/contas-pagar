<?php 
require_once("config.php");


try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não foi possível conectar ao banco de dados! <br><br>'.$e;

}
//
 ?>