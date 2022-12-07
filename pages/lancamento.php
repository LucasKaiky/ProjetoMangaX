<?php

$sql_query = $mysqli->query("SELECT * FROM produtos WHERE categoria = 'lancamento' LIMIT 12");


?>


<link rel="stylesheet" href="assets/css/pages_style.css">
<section id="hero">

    <h4>Por tempo limitado</h4>
    <h2>Ofertas imperdíveis</h2>
    <h1>Em todos os produtos</h1>
    <p>Economize pagando menos e levando mais!</p>

</section>
<!--!PRODUTOS EM DESTAQUE -->

<div class="page-wrapper">
    <div class="content-box">
        <section id="destaques" class="section-destaques">
            <h2>Mangás em Lançamento</h2>
            <p>Nossos produtos mais recentes</p>
            <div class="container-produto">
            <?php while($lancamento = $sql_query->fetch_assoc()) { ?>
                <div class="produto">
                    <a href="<?php echo '?p=produto&id=' . $lancamento['id'] ?>">
                        <img src="<?php echo $lancamento['imagem'] ?>" alt="<?php echo $lancamento['nome'] ?>" height="350px">
                        <div class="desc-produto">
                            <span><?php echo $lancamento['nome'] ?></span>
                            <h4>R$ <?php echo $lancamento['valor'] ?></h4>
                        </div>
                    </a>
                </div> <?php } ?>
            </div>
        </section>
    </div>
</div>
