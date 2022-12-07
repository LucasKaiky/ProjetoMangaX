<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(1);

$sql_usuarios = "SELECT * FROM usuarios";
$sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
$num_usuarios = $sql_query->num_rows;

?>

<link rel="stylesheet" href="assets/css/table_style.css" />

<div class="page-wrapper">
    <div class="content-box">
        <br><br>
        <h1>Gerenciador de Usuários</h1>
        <div class="admin">
            <a href="?p=cadastrar_usuario">Cadastrar usuário</a>
            <form action="" method="GET" class="admin-search">
                <input type="hidden" name="p" value="gerenciar_usuarios">
                <input type="text" name="search" value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" placeholder="Digite o filtro" />
                <input type="submit" value="Enviar">
            </form>
        </div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>DATA DE CADASTRO</th>
                    <th colspan="2">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_GET['search'])) {
                    if ($num_usuarios == 0) { ?>
                        <tr>
                            <td colspan="9">Nenhum usuário cadastrado!</td>
                        </tr>
                        <?php
                    } else {
                        while ($usuario = $sql_query->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $usuario['id'] ?></td>
                                <td><?php echo $usuario['nome'] ?></td>
                                <td><?php echo $usuario['email'] ?></td>
                                <td><?php echo formatar_data($usuario['data_cadastro']) ?></td>
                                <td><a href="?p=editar_usuario&id=<?php echo $usuario['id']; ?>">Editar</a></td>
                                <?php if (!(intval($usuario['id']) == intval($_SESSION['usuario']))) { ?>
                                    <td><a href="?p=deletar_usuario&id=<?php echo $usuario['id']; ?>">Deletar</a></td>
                                <?php } ?>
                            </tr>
                        <?php
                        }
                    }
                } else {
                    $pesquisa = $mysqli->real_escape_string($_GET['search']);
                    $sql_code = "SELECT * FROM usuarios
                                WHERE nome LIKE '%$pesquisa%' 
                                OR email LIKE '%$pesquisa%'
                                OR id LIKE '%$pesquisa%'";
                    $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

                    if ($sql_query->num_rows == 0) {
                        ?>
                        <tr>
                            <td colspan="9">Nenhum resultado encontrado...</td>
                        </tr>
                        <?php } else {
                        while ($usuario = $sql_query->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $usuario['id'] ?></td>
                                <td><?php echo $usuario['nome'] ?></td>
                                <td><?php echo $usuario['email'] ?></td>
                                <td><?php echo formatar_data($usuario['data_cadastro']) ?></td>
                                <td><a href="?p=editar_usuario&id=<?php echo $usuario['id']; ?>">Editar</a></td>
                                <?php if (!(intval($usuario['id']) == intval($_SESSION['usuario']))) { ?>
                                    <td><a href="?p=deletar_usuario&id=<?php echo $usuario['id']; ?>">Deletar</a></td>
                                <?php } ?>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>