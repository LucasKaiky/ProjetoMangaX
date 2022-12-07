<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/enviar_email.php');
include('lib/protect.php');
protect(0);

if (!isset($_SESSION['shopping_cart']))
    die("<script>location.href=\"index.php?p=carrinho\";</script>");


$id_cliente = intval($_SESSION['usuario']);
$sql_query = $mysqli->query("SELECT * FROM usuarios WHERE id='$id_cliente'");
$usuario = $sql_query->fetch_assoc();

if (isset($_POST['finalizar'])) {

    $valor_total = 0;
    $status = "Pedido em separação";

    if (!isset($_SESSION['shopping_cart']))
        die("<script>location.href=\"index.php\";</script>");

    foreach ($_SESSION["shopping_cart"] as $key => $value) {
        $valor_total += ($value["item_quantity"] * $value["item_price"]);
        $id_produto = $value["item_id"];
        $estoque_produto = $mysqli->query("SELECT estoque FROM produtos WHERE id='$id_produto'")->fetch_assoc()['estoque'];
        $novo_estoque = intval($estoque_produto) - intval($value["item_quantity"]);
        $mysqli->query("UPDATE produtos SET estoque='$novo_estoque' WHERE id='$id_produto'");
    }

    $sql_code = "INSERT INTO compras (id_cliente, valor_total, status) VALUES ('$id_cliente', '$valor_total', '$status')";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    $id_compra = ($mysqli->query("SELECT * FROM compras WHERE id_cliente=$id_cliente ORDER BY data_compra DESC LIMIT 1;")->fetch_assoc())['id'];
    $usuario = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id_cliente'")->fetch_assoc();
    ob_start(); ?>

    <h1>Veja o resumo do seu pedido</h1>
    <table class="content-table">
        <thead>
            <tr>
                <th></th>
                <th>Produto</th>
                <th>Preço unitário</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </tr>
        </thead>
        <?php
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            $valor_unitario = $value['item_price'];
            $id_produto = $value['item_id'];
            $quantidade = $value['item_quantity'];
            $sql_code = "INSERT INTO compras_produtos (id_compra, id_produto, quantidade, valor_unitario) VALUES ('$id_compra', '$id_produto', '$quantidade', '$valor_unitario')";
            $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
        ?>
            <tr>
                <td></td>
                <td><?php echo $value["item_name"]; ?></td>
                <td><?php echo formatar_valor($value["item_price"]); ?></td>
                <td><?php echo $value["item_quantity"]; ?></td>
                <td><?php echo formatar_valor($value["item_quantity"] * $value['item_price']); ?></td>
            </tr>
        <?php }
        ?>
        <tr>
            <td></td>
            <td colspan="3" align="right">Total</td>
            <td align="right"><?php echo formatar_valor($valor_total) ?></td>
        </tr>
    </table>
    <br><br>
    <h2>Endereço de entrega:</h2>
    <div style="margin-left: 20px;">
        <p><?php echo $usuario['endereco1'] ?></p>
        <p><?php echo $usuario['endereco2'] . ", " . $usuario['bairro'] ?></p>
        <p><?php echo $usuario['cidade'] . ", " . $usuario['estado'] . ", " . $usuario['cep'] ?></p>
    </div>
    <?php
    $html = ob_get_clean();
    enviar_email($usuario['email'], "Compra realizada com sucesso!", $html);

    die("<script>location.href=\"index.php?p=finalizar_pedido\";</script>");
}

?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">
<link rel="stylesheet" href="assets/css/checkout.css">
<link rel="stylesheet" href="assets/css/table_style.css">

<div class="container">
    <div class="forms">
        <div class="form login checkout">
            <div class="auth-content">
                <div class="auth-title">
                    <a href="index.php"><i class="fa-solid fa-house"></i></a>/<a href="?p=carrinho">carrinho</a>/
                    <span class="title">Checkout</span>
                </div>
            </div>
            <br>
            <span class="title">Resumo do pedido</span>
            <table class="content-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                if (!empty($_SESSION["shopping_cart"])) {
                    $total = 0;
                    foreach ($_SESSION["shopping_cart"] as $key => $value) {
                ?>
                        <tr>
                            <td><img src="<?php echo $value['item_img'] ?>" alt="" width="80"></td>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td><?php echo formatar_valor($value["item_price"]); ?></td>
                            <td><?php echo formatar_valor($value["item_quantity"] * $value["item_price"]); ?></td>
                            <td><a href="?p=remover_item_carrinho&id=<?php echo $value["item_id"]; ?>"><span class="text-danger"><i class="fa-solid fa-trash"></i></span></a></td>
                        </tr>
                    <?php
                        $total += ($value["item_quantity"] * $value["item_price"]);
                    }
                    ?>
                <?php
                } else { ?>
                    <tr>
                        <td colspan="6">Nenhum Item no carrinho!</td>
                    </tr>
                <?php } ?>
            </table>
            <div class="entrega">
                <div class="endereco-title">
                    <?php if (!empty($usuario['endereco1'])) { ?>
                        <span class="entrega-gratis">Frete grátis para todo o Brasil</span>
                    <?php } ?>
                    <h2>Endereço de entrega</h2>
                </div>
                <?php if (!empty($usuario['endereco1'])) { ?>
                    <div class="infos">
                        <p><?php echo $usuario['endereco1'] ?></p>
                        <p><?php echo $usuario['endereco2'] . ", " . $usuario['bairro'] ?></p>
                        <p><?php echo $usuario['cidade'] . ", " . $usuario['estado'] . ", " . $usuario['cep'] ?></p>
                        <a href="?p=adicionar_endereco">Alterar endereço</a>
                    <?php } else { ?>
                        <a href="?p=adicionar_endereco">Adicionar endereço</a>
                    </div>
                <?php } ?>
                <div class="total">
                    <h4> Total do pedido: <?php echo formatar_valor($total); ?></h4>
                </div>
                <form action="" method="POST"><button class="buttonS" name="finalizar" value="1" <?php if (empty($usuario['endereco1'])) echo "style='background-color:#754b31; color: rgba(255, 255, 255, 0.3); cursor: not-allowed' disabled" ?>>Finalizar pedido</button></form>
            </div>
        </div>
    </div>
    <script>
        let submit = document.querySelector(".buttonS")
            submit.onclick = function(){
                this.innerHTML= "Finalizando pedido<div class='loader'></div>"
                setTimeout(() =>{
                this.innerHTML= "Finalizado"
                },2000)
                }
    </script>

</div>
