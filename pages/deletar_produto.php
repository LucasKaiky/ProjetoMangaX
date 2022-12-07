<?php

include("lib/conexao.php");
include('lib/protect.php');
protect(1);
$id = intval($_GET['id']);

$sql_code = "SELECT * FROM produtos WHERE id = '$id'";
$file_name = (($mysqli->query($sql_code))->fetch_assoc())['imagem'];
unlink($file_name);

$mysqli->query("DELETE FROM produtos WHERE id = '$id'") or die($mysqli->error);

die("<script>location.href=\"index.php?p=gerenciar_produtos\";</script>");



