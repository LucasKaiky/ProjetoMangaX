<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/header_style.css" />
    <link rel="stylesheet" href="assets/css/footer_style.css" />
    <link rel="stylesheet" href="assets/css/body.css" />
    <script src="https://kit.fontawesome.com/682b28ed24.js" crossorigin="anonymous"></script>
    <title>Loja - MangaXpress</title>
</head>

<body>
    <header>
        <nav class="principal-nav">
            <div class="nav-container">
                <a href="index.php" class="brand">
                    <h1>
                        <span id="brand-name1">Manga</span><span id="brand-name2">Xpress</span>
                    </h1>
                </a>
                <form class="search" method="GET" action="index.php">
                    <input type="hidden" name="p" value="pesquisar">
                    <input type="hidden" name="search" value="pesquisar">
                    <input type="text" name="keyword" class="search-bar" placeholder="Busque aqui seu produto">
                    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="menu">
                    <?php if (isset($_SESSION['admin'])) {
                        if ($_SESSION['admin'] == 1) {
                            echo '<a href="?p=painel_de_controle"><i class="fa-solid fa-screwdriver-wrench"></i></a>';
                        }
                    } ?>
                    <a href="#"><i class="fa-solid fa-user" onclick="toggleMenu()"></i></a>
                    <a href="?p=carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="?p=minha_lista"><i class="fa-solid fa-bookmark"></i></a>
                </div>
                <div class="submenuP" id="subM">
                    <div class="submenu">
                        <?php if (!isset($_SESSION['admin'])) { ?>
                            <div class="userinfo">
                                <h3> Olá, Usuário!</h3>
                            </div>
                            <hr>
                            <a href="login.php" class="submenuL">
                                <p>Logar</p>
                                <span>></span>
                            </a>
                            <a href="register.php" class="submenuL">
                                <p>Registrar</p>
                                <span>></span>
                            </a>

                        <?php } else { ?>

                            <div class="userinfo">
                                <h3> Olá, <?php echo (explode(" ", $_SESSION['nome_usuario']))[0] ?>!</h3>
                            </div>
                            <hr>
                            <a href="?p=perfil" class="submenuL">
                                <p>Perfil</p>
                                <span>></span>
                            </a>
                            <a href="?p=meus_pedidos" class="submenuL">
                                <p>Meus pedidos</p>
                                <span>></span>
                            </a>
                            <a href="logout.php" class="submenuL">
                                <p>Sair</p>
                                <span>></span>
                            </a>

                        <?php } ?>
                    </div>
                </div>
                <button class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </nav>
        <nav class="secundary-nav">
            <div class="nav-container-secundary">
                <a href="?p=destaque">Destaques</a>
                <a href="?p=lancamento">Lançamentos</a>
                <a href="?p=pre-venda">Pré-vendas</a>
            </div>
        </nav>


    </header>
    <script>
        let subM = document.getElementById("subM")

        function toggleMenu() {
            subM.classList.toggle("open-menu")
        }
    </script>