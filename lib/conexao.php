<?php

$hostname = 'localhost';  // localhost para o Apache
$username = 'root';  // root
$password = '';  // Vazio caso não tenha senha definida no seu BD 
$database = 'manga';  // Nome do banco de dados

$mysqli = new mysqli($hostname, $username, $password, $database); // Tenta fazer a conexão mysql.

if($mysqli->connect_errno) {
    die("Erro na conexão - $mysqli->connect_error");
}

if (!function_exists("formatar_valor")) {
    function formatar_valor($valor)
    {
        $preco = "R$" . number_format($valor, 2, ",", ".");
        return $preco;
    }
}

if (!function_exists("formatar_data")) {
    function formatar_data($data)
    {
        return date('d/m/Y', strtotime($data));
    }
}