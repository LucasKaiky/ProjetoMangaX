<?php
include 'lib/protect.php';
protect(0);

if (!isset($_SESSION['shopping_cart']))
    die("<script>location.href=\"index.php?p=carrinho\";</script>");

unset($_SESSION['shopping_cart'])

?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">
<link rel="stylesheet" href="assets/css/checkout.css">
<link rel="stylesheet" href="assets/css/table_style.css">
<link rel="stylesheet" href="assets/css/finalizar_compra.css">


<div class="container">
    <div class="gray-div">
        <div class="forms">
            <div class="form login lista">
                <h1 class="title">Compra realizada com sucesso!</span>
                <br>
                <h1 class="title">Obrigado pela preferência</span>
            </div>
        </div>
    </div>
</div>
<h3 class="back-href"><a href="index.php">Voltar a pagina princial</a></h3>

<?php  ?>