<?php

include('lib/conexao.php');
$id = intval($_POST['id']);

$sql_query = $mysqli->query("SELECT * FROM produtos WHERE id = '$id'");
if ($sql_query->num_rows == 0) {
    die("<script>location.href=\"index.php?p=produto&id=$id\";</script>");
}
$produto = $sql_query->fetch_assoc();
/*echo '<pre>' . var_dump($_SESSION) . '</pre>';*/

if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if (!in_array($id, $_SESSION["shopping_cart"])) {
        $item_array = array(
            'item_id'           =>    $id,
            'item_name'         =>    $produto['nome'],
            'item_price'        =>    $produto['valor'],
            'item_quantity'     =>    $_POST["quantity"],
            'item_img'          =>  $produto['imagem']
        );
        $_SESSION["shopping_cart"][$id] = $item_array;
    } else {
        $key = array_search($id, $item_array_id);
        $_SESSION['shopping_cart'][$item_array_id[$key]]['item_quantity'] += $_POST['quantity'];
    }
} else {
    $item_array = array(
        'item_id'           =>    $id,
        'item_name'         =>    $produto['nome'],
        'item_price'        =>    $produto['valor'],
        'item_quantity'     =>    $_POST["quantity"],
        'item_img'          =>    $produto['imagem']
    );
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION["shopping_cart"][$id] = $item_array;
}

if (!empty($_SESSION['shopping_cart'])) {
    $total = 0;
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $total += ($values["item_quantity"] * $values["item_price"]);
    }
}


?>

<link rel="stylesheet" href="assets/css/paginaProduto.css">

<div class="container">
    <div class="showCase">
        <img src="<?php echo $produto['imagem']; ?>" alt="product-img" id="currentImg" height="520px">
    </div>
    <div class="contentCase gridcenter">
        <div class="added-cart">
            <i class="fa-solid fa-circle-check"></i>
            <h1 class="product">Adicionado ao carrinho.</h1><br>
            <label for="price" class="price">Subtotal do carrinho:<span class="price"><?php echo formatar_valor($total); ?></span></label><br>
            <a href="?p=carrinho">
                <button class="a2c" id="carrinho">
                    Ir para o carrinho
                </button>
            </a><br>

        </div>
    </div>
</div>