<?php
include("lib/conexao.php");
include('lib/protect.php');
protect(0);

$id_usuario = $_SESSION['usuario'];
$sql_query_pedidos = $mysqli->query("SELECT * FROM compras WHERE id_cliente='$id_usuario'");
$qtd_pedidos = $sql_query_pedidos->num_rows;
?>

<link rel="stylesheet" href="assets/css/seus_pedidos.css">
<link rel="stylesheet" href="assets/css/table_style.css">

<div class="container">
    <div class="auth-title">
        <a href="index.php"><i class="fa-solid fa-house"></i></a>/
        <span class="title">Meus Pedidos</span>
    </div>
    <div class="items">
    <?php
    if ($qtd_pedidos > 0) {
        while ($pedido = $sql_query_pedidos->fetch_assoc()) { ?>
        <table class="content-table">
            <thead>
                <tr>
                    <th class="head-infos" width="800px">
                        <div class="resume">
                            <div>
                                PEDIDO REALIZADO<br><br><?php echo formatar_data($pedido['data_compra']) ?>
                            </div>
                            <div>
                                TOTAL<br><br><?php echo formatar_valor($pedido['valor_total']) ?>
                            </div>
                            <div>
                                STATUS<br><br><?php echo $pedido['status'] ?>
                            </div>
                        </div>
                        <div class="pedido-id">
                            PEDIDO N°<?php echo $pedido['id'] ?><br><br><a href="?p=detalhes_pedido&id=<?php echo $pedido['id'] ?>" style="color: #ebe2cd; text-decoration: none;">Exibir detalhes do pedido</a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <div class="pedido-box">
                            <?php
                            $id_compra = $pedido['id'];
                            $sql_code = "SELECT * FROM compras_produtos WHERE id_compra='$id_compra'";
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
                                            <a href="?p=produto&id=<?php echo $id_produto ?>"><button><i class="fa-solid fa-arrow-rotate-left"></i> Comprar novamente</button></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
        <?php }
            } else { ?>
        <h3 class="erro-pedido">Nenhum pedido no banco de dados!</h3>
        <?php } ?>
    </div>
</div>