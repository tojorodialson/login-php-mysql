<?php
$DB_host = "localhost";//address for database access
$DB_user = "username";//your username
$DB_pass = "password";//password database access
$DB_name = "database";//database name

try{
	$pdo = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (Exception $e){
	echo $e->getMessage();
	$erreur='<div class="alert alert-danger">Connexion database failed!<br/>Please verify your configuration</div>';
}
?>
