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

echo "</br> <h2>Autentication :</h2></br>";
$autentication = $usuario->Autentication("agamenon","11234567890");
echo json_encode($autentication);

echo "</br> <h2>Insert :</h2></br>";
$Insert = $usuario->Insert("Novo-Usuário","123*%");
echo json_encode($Insert);

echo "</br> <h2>Update :</h2></br>";
$atualizar = new Usuario();
$atualizar->LoadbyID(2);
$utualizado = $atualizar->Update("testando-update","4567890");
echo json_encode($utualizado); 

echo "</br> <h2>Delete :</h2></br>";
$Delete = new Usuario();
$Delete->LoadbyID(7);
$Deletando = $Delete->Delete();
echo json_encode($Deletando); 


?>