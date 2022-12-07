<?php
include('lib/conexao.php');
include('lib/protect.php');
protect(0);

$id = intval($_GET['id']);

if(isset($_POST['situacao'])) {
    $status = $mysqli->real_escape_string($_POST['situacao']);
    $sql_code = "UPDATE compras SET status='$status' WHERE id='$id'";
    $mysqli->query($sql_code);
}

$sql_code = "SELECT * FROM compras WHERE id='$id'";
$sql_query = $mysqli->query($sql_code) or die($mysqli->error);
$pedido = $sql_query->fetch_assoc();

if($pedido['id_cliente'] != $_SESSION['usuario'] && $_SESSION['admin']==0) {
    die("<script>location.href=\"index.php?p=meus_pedidos\";</script>");
}

$user_id = $pedido['id_cliente'];
$usuario = $mysqli->query("SELECT * FROM usuarios WHERE id='$user_id'")->fetch_assoc();

?>

<link rel="stylesheet" href="assets/css/painel_de_controle.css">
<link rel="stylesheet" href="assets/css/detalhes_pedido.css">

<div class="container">
    <div class="top">
        <div class="auth-title">
        <a href="index.php"><i class="fa-solid fa-house"></i></a>/
            <span class="title">Detalhes do Pedido N° <?php echo $id ?></span>
            <br><br>
            <br>
        </div>
    </div>
    <div class="pedidos">
        <h1>Informações</h1><br>
        <hr><br>
        <div class="informacoes">
            <p>Data do pedido: <?php echo $pedido['data_compra'] ?></p>
            <p> <?php if($_SESSION['admin']==1) { ?> 
            <form action="" method="POST">
                Status:
                <select name="situacao">
                    <option value="Pedido em separação" <?php if($pedido['status'] == "Pedido em separação") echo "selected" ?>>Pedido em separação</option>
                    <option value="Pedido enviado" <?php if($pedido['status'] == "Pedido enviado") echo "selected" ?>>Pedido enviado</option>
                    <option value="Seu pedido chegou!" <?php if($pedido['status'] == "Seu pedido chegou!") echo "selected" ?>>Seu pedido chegou!</option>
                </select><button>Atualizar</button>
            </form><?php } else { ?>Status: <b><?php echo $pedido['status'] ?></b><?php } ?></p>
            <p>Ultima atualização: <?php echo $pedido['data_status'] ?></p>
            <p>Valor total: <?php echo formatar_valor($pedido['valor_total']) ?></p><br>
            <br><br>
        </div>
        <h1>Endereço de entrega</h1><br>
        <hr><br>
        <div class="entrega">
            <p><?php echo $usuario['nome'] ?></p><br>
            <p><?php echo $usuario['endereco1'] ?></p>
            <p><?php echo $usuario['endereco2'] . ", " . $usuario['bairro'] ?></p>
            <p><?php echo $usuario['cidade'] . ", " . $usuario['estado'] . ", " . $usuario['cep'] ?></p><br><br>
        </div>
        <h1>Produtos</h1><br>
        <hr><br>

        <div class="info-produtos">
            <?php
            $sql_code = "SELECT * FROM compras_produtos WHERE id_compra='$id'";
            $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
            while ($compras_produto = $sql_query->fetch_assoc()) {
                $id_produto = $compras_produto['id_produto'];
                $produto = $mysqli->query("SELECT * FROM produtos WHERE id='$id_produto'")->fetch_assoc();
            ?>
                <div class="left">
                    <div class="pedido-img">
                        <img src="<?php echo $produto['imagem'] ?>" width="80">
                    </div>
                    <div class="pedido-content">
                        <div class="infos">
                            <h3><?php echo $produto['nome'] ?></h3>
                            <p>Quantidade: <?php echo $compras_produto['quantidade'] ?></p>
                            <p>Valor unitário: <?php echo formatar_valor($compras_produto['valor_unitario']) ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>