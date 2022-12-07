<?php

if (isset($_POST['registrar'])) {
    include('lib/conexao.php');

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $rsenha = $mysqli->real_escape_string($_POST['rsenha']);
    
    $sql_query = $mysqli->query("SELECT * FROM usuarios WHERE email = '$email'") or die($mysqli->error);
    $qntd = $sql_query->num_rows;

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


    if (count($erro) == 0) {
        include('lib/enviar_email.php');

        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO usuarios (nome, email, senha, data_cadastro, admin) VALUES(
            '$nome', 
            '$email', 
            '$senha',
            NOW(),
            0
        )");

        $html = "<h1>Cadastro realizado com sucesso!</h1><p>Obrigado $nome por se registrar no MangaXpress!</p>";
        enviar_email($email, 'Cadastro concluido!', $html);

        die("<script>location.href=\"index.php\";</script>");
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/682b28ed24.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/css/auth_style.css">
    <title>Login - MangaXpress</title>
</head>

<body>
    <img src="assets/img/backgrounds/RoronoaZoro.png" height="80%">
    <div class="container">
        <div class="forms">
            <div class="form login">
                <div class="auth-content">
                    <div class="auth-title">
                        <a href="index.php"><i class="fa-solid fa-house"></i>/</a>
                        <span class="title">Registrar</span>
                    </div>
                </div>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="nome" placeholder="Coloque seu nome">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[0])) echo $erro[0] ?></span>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Coloque seu email">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[1])) echo $erro[1] ?></span>
                    <span class="erro"><?php if(isset($erro[2])) echo $erro[2] ?></span>
                    <div class="input-field">
                        <input type="password" name="senha" placeholder="Coloque sua senha">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[3])) echo $erro[3] ?></span>
                    
                    <div class="input-field">
                        <input type="password" name="rsenha" placeholder="Confirme sua senha">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <span class="erro"><?php if(isset($erro[4])) echo $erro[4] ?></span>

                    <div class="input-field button">
                        <button name="registrar" value="1" class="buttonS">Registrar agora</button>
                            
                    </div>

                    <div class="login-signup">
                        <span class="text">Já tem cadastro?
                            <a href="login.php" class="text signup-text">Logar agora</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
         let submit = document.querySelector(".buttonS")
            submit.onclick = function(){
                this.innerHTML= "<div class='loader'></div>"
                setTimeout(() =>{
                this.innerHTML= "Registrado"
                },2000)
                }
</script>
</body>
</html>
