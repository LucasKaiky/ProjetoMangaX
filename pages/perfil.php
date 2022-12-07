<?php
include('lib/conexao.php');
include('lib/protect.php');
protect(0);

$id = intval($_SESSION['usuario']);
$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'");
$usuario = $sql_query->fetch_assoc();

$nome = $usuario['nome'];

$email = $usuario['email'];

$old_data_cadastro = $usuario['data_cadastro'];
$data_timestamp = strtotime($old_data_cadastro);
$data_cadastro = date('d/m/Y', $data_timestamp);

if ($usuario['admin']) {
    $cargo = 'Admin';
} else {
    $cargo = 'Usuário';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/perfil.css">

    <title>Perfil</title>
</head>

<body>
    <div class="container">
        <div class="name-container">
            <h1><i class="fa-solid fa-user"></i>
            </h1>
            <span id="name">
                <?php echo $nome ?>
            </span>
        </div>
        <form action="">
            <p>
                <i class="fa-solid fa-envelope"></i> <?php echo $email ?>
            </p>
            <p>
                <i class="fa-solid fa-calendar-days"></i> <?php echo $data_cadastro ?>
            </p>
            <p>
                <i class="fa-solid fa-id-card-clip"></i> <?php echo $cargo ?>
            </p>
        </form>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
    </div>

</body>

</html>