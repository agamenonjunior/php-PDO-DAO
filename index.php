<?php
require_once("config.php");

$sql = new Sql();
$registros = $sql->Select("SELECT * FROM newslatter");
echo "<pre>";
echo print_r($registros);
echo "</pre>";

?>