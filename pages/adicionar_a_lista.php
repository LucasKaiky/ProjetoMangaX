<?php
include("lib/conexao.php");
include('lib/protect.php');
protect(0);

$id_usuario = $_SESSION['usuario'];

if(isset($_POST['id'])) {
    $id_produto = intval($_POST['id']);
    
    if(!isset($_POST['favoritado'])) {
        $sql_code = "INSERT INTO lista_favoritos (id_produto, id_usuario) VALUES ('$id_produto', '$id_usuario')";
        $sql_query = $mysqli->query($sql_code);
        
        die("<script>location.href=\"index.php?p=produto&id=$id_produto\";</script>");
    } else {
        $sql_code = "DELETE FROM lista_favoritos WHERE id_produto = '$id_produto' AND id_usuario = '$id_usuario'";
        $sql_query = $mysqli->query($sql_code);
        
        die("<script>location.href=\"index.php?p=produto&id=$id_produto\";</script>");
    }
} else {
    $id_produto = intval($_GET['id']);

    $sql_code = "DELETE FROM lista_favoritos WHERE id_produto = '$id_produto' AND id_usuario = '$id_usuario'";
    $sql_query = $mysqli->query($sql_code);
        
    die("<script>location.href=\"index.php?p=minha_lista\";</script>");
}