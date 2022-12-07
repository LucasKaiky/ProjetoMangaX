<?php

include('lib/conexao.php');
include('lib/protect.php');


if (!isset($_GET['row']) || $_GET['row'] == 1) {
    $sql_usuarios = "SELECT * FROM produtos LIMIT 20";
} else {
    $inicial = (intval($_GET['row']) * 20) - 20;
    $sql_usuarios = "SELECT * FROM produtos LIMIT $inicial, 20";
}

$sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
$num_produtos = $mysqli->query("SELECT * FROM produtos")->num_rows;

?>



<link rel="stylesheet" href="assets/css/pagina_pesquisar.css" />


<div class="page-wrapper">
    <div class="content-box">
        <br><br>
        <?php if(isset($_GET['keyword']) && !empty($_GET['keyword'])) { ?>
        <h1>Resultados para "<?php echo $_GET['keyword'] ?>"</h1>
        <?php } else { ?> 
        <h1>Catálogo de produtos</h1>
        <?php } ?>
            <br>
        <section id="destaques" class="section-destaques">
            <div class="container-produto">
            <?php
            if (!isset($_GET['keyword']) || empty($_GET['keyword'])) {

                if ($num_produtos == 0) { ?>
                <h3>Nenhum produto cadastrado no banco de dados</h3>
                <?php } else {
                while ($produto = $sql_query->fetch_assoc()) {
                ?>
                    <div class="produto">
                        <a href="index.php?p=produto&id=<?php echo $produto['id'] ?>">
                            <img src="<?php echo $produto['imagem'] ?>" alt=" <?php echo $produto['nome'] ?>" height="350px">
                            <div class="informaçao-produto">
                                <span><?php echo $produto['nome'] ?></span>
                                <h4><?php echo formatar_valor($produto['valor']) ?></h4>
                            </div>
                        </a>


                        <form action="?p=adicionar_ao_carrinho" id="stock-form" method="POST">
                            <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                            <input type="hidden" name="quantity" value="1" type="number" id="quantity">
                            <button class="bnt" type="submit">Adicionar ao Carrinho</button>
                        </form>
                    </div> <?php
                        }
                    }
                } else {

                    $pesquisa = $mysqli->real_escape_string($_GET['keyword']);
                    if (!isset($_GET['row']) || $_GET['row'] <= 1) {
                        $sql_code = "SELECT * FROM produtos
                            WHERE nome LIKE '%$pesquisa%'
                            OR autor LIKE '%$pesquisa%'
                            LIMIT 20";
                    } else {
                        $inicial = (intval($_GET['row']) * 20) - 20;
                        $sql_code = "SELECT * FROM produtos
                            WHERE nome LIKE '%$pesquisa%'
                            OR autor LIKE '%$pesquisa%' 
                            LIMIT $inicial, 20";
                    }
                    $num_pesquisa = ($mysqli->query("SELECT * FROM produtos
                                                    WHERE nome LIKE '%$pesquisa%' 
                                                    OR autor LIKE '%$pesquisa%' 
                                                
                                                    "))->num_rows;
                    $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);

                    $qtd_resultado = $sql_query->num_rows;
                    if ($qtd_resultado == 0) { ?>
                <div class="sem-resultado">
                    <tr>
                        <td colspan="10">Nenhum resultado encontrado...</td>
                    </tr>
                </div>
                <?php } else {
                    while ($produto = $sql_query->fetch_assoc()) { ?>
                <div class="produto">
                    <a href="index.php?p=produto&id=<?php echo $produto['id'] ?>">
                        <img src="<?php echo $produto['imagem'] ?>" alt=" <?php echo $produto['nome'] ?>" height="350px">
                        <div class="informaçao-produto">
                            <span><?php echo $produto['nome'] ?></span>
                            <h4><?php echo formatar_valor($produto['valor']) ?></h4>
                    </a>
                    <form action="?p=adicionar_ao_carrinho" id="stock-form" method="POST">
                        <input type="hidden" name="id" value="<?php echo $produto['id'] ?>">
                        <input type="hidden" name="quantity" value="1" type="number" id="quantity">
                        <button class="bnt" type="submit">Adicionar ao Carrinho</button>
                    </form>
                </div>
            </div>
            <?php } 
                }
            } ?>

        </section>
        <?php 
            if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                $qtd_rows = ceil($num_pesquisa/20);
                for($i=1; $i<$qtd_rows+1; $i++) {
                    echo "<a href='?p=pesquisar&keyword=$pesquisa&row=$i'>$i</a>/";
                }
            } else {
                $qtd_rows = ceil($num_produtos/20);
                for($i=1; $i<$qtd_rows+1; $i++) {
                    echo "<a href='?p=pesquisar&row=$i'>$i</a>/";
                }
            }
            ?>
    </div>
</div>