<?php
require_once("config.php");
/*
$sql = new Sql();
$registros = $sql->Select("SELECT * FROM newslatter");

echo "<h2>Registros:</h2></br>";
echo "<pre>";
echo print_r($registros);
echo "</pre>";
*/

echo "<h2>Usuários:</h2></br>";

$usuario = new Usuario();
$resUser = $usuario->LoadbyID(1);
echo json_encode($resUser);

echo "<h2>Ultimos Usuários:</h2></br>";

$ultimos = $usuario::SelectAll();
echo json_encode($ultimos);

$login = $usuario::SearchUser("a");
echo json_encode($login);


?>