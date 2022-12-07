<?php

$sql_query = $mysqli->query("SELECT * FROM produtos WHERE categoria = 'pre-venda' LIMIT 12");

?>
<link rel="stylesheet" href="assets/css/pages_style.css">
<section id="hero">

    <h4>Por tempo limitado</h4>
    <h2>Ofertas imperdíveis</h2>
    <h1>Em todos os produtos</h1>
    <p>Economize pagando menos e levando mais!</p>

</section>


<div class="page-wrapper">
    <div class="content-box">
        <section id="destaques" class="section-destaques">
            <h2>Mangás em Pré-Venda</h2>
            <p>Novos produtos em breve</p>
            <div class="container-produto">
            <div class="container-produto">
                <?php while($prevenda = $sql_query->fetch_assoc()) { ?>
                    <div class="produto">
                        <a href="<?php echo '?p=produto&id=' . $prevenda['id'] ?>">
                            <img src="<?php echo $prevenda['imagem'] ?>" alt="<?php echo $prevenda['nome'] ?>" height="350px">
                            <div class="desc-produto">
                                <span><?php echo $prevenda['nome'] ?></span>
                                <h4>R$ <?php echo $prevenda['valor'] ?></h4>
                            </div>
                        </a>
                    </div> <?php } ?>
            </div>
            </div>
        </section>
    </div>
</div>
