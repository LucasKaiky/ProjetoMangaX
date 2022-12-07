<?php

$sql_query = $mysqli->query("SELECT * FROM produtos WHERE categoria = 'destaque' LIMIT 12");


?>

<link rel="stylesheet" href="assets/css/pages_style.css">

<section id="hero">

    <h4>Por tempo limitado</h4>
    <h2>Ofertas imperdíveis</h2>
    <h1>Em todos os produtos</h1>
    <p>Economize pagando menos e levando mais!</p>

</section>

<div class="slider">
        <div class="slides">
            <!--Radio buttons-->
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">


            <!--Imagens-->
            <div class="slide first">
                <a href="?p=pesquisar&search=pesquisar&keyword="><img src="assets\img\mangas.png" alt="imagem 1"></a>
            </div>
            <div class="slide">
                <a href="?p=pesquisar&keyword=berserk"><img src="assets\img\berserkerslider.png" alt="imagem 2"></a>
            </div>


            <!--Navigation auto-->

            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
            </div>
        </div>

        <div class="manual-navigation">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
        </div>


    </div>

    <script>
        let count = 1
        document.getElementById("radio1").checked=true

        setInterval( function(){
            nextImage()
        },5000)

        function nextImage(){
            count++
            if(count>2){
                count=1
            }
            document.getElementById("radio"+count).checked = true
        }
    </script>


<!--!PRODUTOS EM DESTAQUE -->
<div class="page-wrapper">
    <div class="content-box">
        <section id="destaques" class="section-destaques">
            <h2>Mangás em Destaque</h2>
            <p>Nossos produtos mais procurados</p>
            <div class="container-produto">
                <?php while($destaque = $sql_query->fetch_assoc()) { ?>
                    <div class="produto">
                        <a href="<?php echo '?p=produto&id=' . $destaque['id'] ?>">
                            <img src="<?php echo $destaque['imagem'] ?>" alt="<?php echo $destaque['nome'] ?>" height="350px">
                            <div class="desc-produto">
                                <span><?php echo $destaque['nome'] ?></span>
                                <h4>R$ <?php echo $destaque['valor'] ?></h4>
                            </div>
                        </a>
                    </div> <?php } ?>
            </div>
        </section>
    </div>
</div>
