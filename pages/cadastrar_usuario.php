<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(1);

if(isset($_POST['registrar'])) {

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $rsenha = $mysqli->real_escape_string($_POST['rsenha']);
    $admin = $mysqli->real_escape_string($_POST['admin']);

    $erro = array();
    if (empty($nome)) {
        $erro[0] = "Preencha o nome";
    } else if (strlen($nome) < 4) {
        $erro[0] = "O nome deve ter no mínimo 4 letras";
    }

    if (empty($email)) {
        $erro[1] = "Preencha o e-mail";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[1] = "Preencha um email válido";
    } else if($qntd>0) {
        $erro[2] = "E-mail já cadastrado";
    }

    if (empty($senha)) {
        $erro[3] = "Preencha a senha";
    } else if(strlen($senha) < 4) {
        $erro[3] = "A senha deve ter no mínimo 4 caracteres";
    }

    if ($rsenha != $senha)
        $erro[4] = "As senhas não batem";


    if(count($erro) == 0) {

        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO usuarios (nome, email, senha, data_cadastro, admin) VALUES(
            '$nome', 
            '$email', 
            '$senha',
            NOW(),
            '$admin'
        )");
        die("<script>location.href=\"index.php?p=gerenciar_usuarios\";</script>");

    }
}
?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">

<div class="container">
        <div class="forms">
            <div class="form login">
                <div class="auth-content">
                    <div class="auth-title">
                        <a href="?p=gerenciar_usuarios"><i class="fa-solid fa-screwdriver-wrench"></i>/</a>
                        <span class="title">Cadastrar Usuário</span>
                    </div>
                </div>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="nome" placeholder="Nome">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[0])) echo $erro[0] ?></span>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Email">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[1])) echo $erro[1] ?></span>
                    <span class="erro"><?php if(isset($erro[2])) echo $erro[2] ?></span>
                    <div class="input-field">
                        <input type="password" name="senha" placeholder="Senha">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[3])) echo $erro[3] ?></span>
                    <div class="input-field">
                        <input type="password" name="rsenha" placeholder="Confirmar senha">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[4])) echo $erro[4] ?></span>
                    <div class="input-field">
                        <select name="admin" class="custom-select">
                            <option value="0">Usuário</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="registrar" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>