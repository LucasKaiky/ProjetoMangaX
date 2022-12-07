<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(1);
$id = intval($_GET['id']);
if(isset($_POST['editar'])) {

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $rsenha = $mysqli->real_escape_string($_POST['rsenha']);
    $admin = $mysqli->real_escape_string($_POST['admin']);

    $erro = array();
    if(empty($nome))
        $erro[] = "Preencha o nome";

    if(empty($email))
        $erro[] = "Preencha o e-mail";

    if($rsenha != $senha)
        $erro[3] = "As senhas não batem";

    if(count($erro) == 0) {

        $sql_code = "UPDATE usuarios 
        SET nome = '$nome',
        email = '$email',
        admin = '$admin'
        WHERE id = '$id'";

        if(!empty($senha)) {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $sql_code = "UPDATE usuarios 
            SET senha = '$senha'
            WHERE id = '$id'";
        }

        $mysqli->query($sql_code) or die($mysqli->error);
        die("<script>location.href=\"index.php?p=gerenciar_usuarios\";</script>");

    }
}

$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'") or die($mysqli->error);
$usuario = $sql_query->fetch_assoc();

?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">

<div class="container">
        <div class="forms">
            <div class="form login">
                <div class="auth-content">
                    <div class="auth-title">
                        <a href="?p=gerenciar_usuarios"><i class="fa-solid fa-screwdriver-wrench"></i>/</a>
                        <span class="title">Editar Usuário</span>
                    </div>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="input-field">
                        <input type="text" name="nome" placeholder="Nome" value="<?php echo $usuario['nome']; ?>" required>
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Email" value="<?php echo $usuario['email']; ?>" required>
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="senha" placeholder="Senha" >
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="rsenha" placeholder="Confirmar senha" >
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="input-field">
                        <select name="admin" class="custom-select">
                            <option value="0">Usuário</option>
                            <option value="1" <?php if($usuario['admin']) echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>

                    <?php if(isset($erro[3])) { ?>
                        <span class="error"><?php echo $erro[3]; ?></span>
                    <?php } ?>

                    <div class="input-field button">
                        <input type="submit" name="editar" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>