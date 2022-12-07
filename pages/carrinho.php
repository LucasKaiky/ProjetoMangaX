<link rel="stylesheet" href="assets/css/table_style.css" />
<link rel="stylesheet" href="assets/css/carrinho.css">


<div class="page-wrapper">
    <div class="content-box">
        <h1><a href="index.php"><i class="fa-solid fa-house"></i>/</a>Carrinho</h1>
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
                        <td><a href="?p=produto&id=<?php echo $value['item_id']; ?>"><img src="<?php echo $value['item_img'] ?>" alt="" width="80"></a></td>
                        <td><a href="?p=produto&id=<?php echo $value['item_id']; ?>"><?php echo $value["item_name"]; ?></a></td>
                        <td><?php echo $value["item_quantity"]; ?></td>
                        <td><?php echo formatar_valor($value["item_price"]); ?></td>
                        <td><?php echo formatar_valor($value["item_quantity"] * $value["item_price"]); ?></td>
                        <td><a href="?p=remover_item_carrinho&id=<?php echo $value["item_id"]; ?>"><span class="text-danger"><i class="fa-solid fa-trash"></i></span></a></td>
                    </tr>
                <?php
                    $total += ($value["item_quantity"] * $value["item_price"]);
                }
                ?>
                <tr>
                    <td colspan="4" align="right">Total</td>
                    <td align="right"><?php echo formatar_valor($total) ?></td>
                    <td></td>
                </tr>
            <?php
            } else { ?>
                <tr>
                    <td colspan="6">Nenhum Item no carrinho!</td>
                </tr>
            <?php } ?>
        </table>
        <?php if (!empty($_SESSION["shopping_cart"])) { ?>
        <a href="?p=destaque"><button type="submit" id="continue">Continuar Comprando</button></a>
        <a href="?p=checkout"><button type="submit" id="finish">Finalizar Compra</button></a>
        <?php } ?>
    </div>
</div>