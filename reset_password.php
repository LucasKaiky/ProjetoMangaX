<?php

$msg = false;
if(isset($_POST['enviar'])) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    include('lib/conexao.php');
    include('lib/enviar_email.php');
    $email = $mysqli->real_escape_string($_POST['email']);
    $sql_query = $mysqli->query("SELECT id, nome FROM usuarios WHERE email = '$email'");
    $result = $sql_query->fetch_assoc();

    if(isset($result['id'])) {

        $nova_senha = generateRandomString(6);
        $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
        $id_usuario = $result['id'];
        $mysqli->query("UPDATE usuarios SET senha = '$nova_senha_criptografada' WHERE id = '$id_usuario'");
        enviar_email($email, "Sua nova senha na loja MangaXpress", "
        <h1>Olá " . $result['nome'] . "</h1>
        <p>Uma nova senha foi definida para a sua conta.</p>
        <p><b>Nova senha:</b> $nova_senha</p>
        ");
        $msg = "Nova senha enviada para o seu email!";

    } else {
        $msg = "Nova senha enviada para o seu email!";
    }
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/682b28ed24.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/css/auth_style.css">
    <title>Login - MangaXpress</title>
</head>

<body>
    <img src="assets/img/backgrounds/trafalgar-law.png" height="70%">
    <div class="container">
        <div class="forms">
            <div class="form login">
                <div class="auth-content">
                    <div class="auth-title">
                        <a href="index.php"><i class="fa-solid fa-house"></i>/</a>
                        <span class="title">Esqueceu sua senha?</span>
                    </div>
                </div>

                <form action="" method="POST">
                    <?php if(!$msg) { ?> 
                        <div class="input-field">
                            <input type="text" name="email" placeholder="Escreva seu email" required>
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div class="input-field button">
                            <button name="enviar" value="1" class="buttonS">Enviar nova senha para o email</button>
                        </div>
                        <div class="login-signup">
                            <span class="text">Lembrou?
                                <a href="login.php" class="text signup-text">Logue agora</a>
                            </span>
                        </div>
                    <?php } else { ?>
                        <br>
                        <span><?php echo $msg; ?></span>
                        <div class="login-signup">
                            <span class="text">Faça seu login agora!
                                <a href="login.php" class="text signup-text">Clique aqui</a>
                            </span>
                        </div>
                    <?php } ?>

                </form>
            </div>
        </div>
    </div>
</body>

</html>