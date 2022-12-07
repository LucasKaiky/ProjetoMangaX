<?php 

unset($_SESSION['shopping_cart'][$_GET["id"]]);

die("<script>location.href=\"index.php?p=carrinho\";</script>");
