<?php

include('lib/conexao.php');
include('lib/protect.php');
protect(1);

/*

1 >   1-8
2 >   9-16
3 >   17-24

a2 + b = 9
a3 + b = 17

b =  9-2a
3a + 9-2a = 17
a = 8
b = -7

8x-7 = y

*/

if(!isset($_GET['row']) || $_GET['row']==1) {
    $sql_usuarios = "SELECT * FROM produtos LIMIT 8";
} else {
    $inicial = (intval($_GET['row'])*8) - 8;
    $sql_usuarios = "SELECT * FROM produtos LIMIT $inicial, 8";
}

$sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
$num_produtos = $mysqli->query("SELECT * FROM produtos")->num_rows;

?>

<link rel="stylesheet" href="assets/css/table_style.css" />
<div class="page-wrapper">
    <div class="content-box">
        <br><br>
        <h1>Gerenciador de Produtos</h1>
        <div class="admin">
            <a href="?p=cadastrar_produto">Cadastrar produto</a>
            <form action="" method="GET" class="admin-search">
                <input type="hidden" name="p" value="gerenciar_produtos">
                <input type="text" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search'];?>" placeholder="Digite o filtro" />
                <input type="submit" value="Buscar">
            </form>
        </div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>IMAGEM</th>
                    <th>NOME</th>
                    <th>AUTOR</th>
                    <th>VALOR</th>
                    <th>ESTOQUE</th>
                    <th>CATEGORIA</th>
                    <th>DATA DE CADASTRO</th>
                    <th colspan="2">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!isset($_GET['search'])) {
                    if($num_produtos == 0) { ?>
                    <tr>
                        <td colspan="10">Nenhum produto cadastrado!</td>
                    </tr>
                <?php 
                    } else { 
                        while($produto = $sql_query->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $produto['id'] ?></td>
                    <td><img src="<?php echo $produto['imagem'] ?>" alt="" width="80"></td>
                    <td><?php echo $produto['nome'] ?></td>
                    <td><?php echo $produto['autor'] ?></td>
                    <td><?php echo formatar_valor($produto['valor']) ?></td>
                    <td><?php echo $produto['estoque'] ?></td>
                    <td><?php echo $produto['categoria'] ?></td>
                    <td><?php echo formatar_data($produto['data_cadastro']) ?></td>
                    <td><a href="?p=editar_produto&id=<?php echo $produto['id'] ?>">Editar</a></td>
                    <td><a href="?p=deletar_produto&id=<?php echo $produto['id'] ?>">Deletar</a></td>
                </tr>
                <?php
                        }
                    }
                } else {
                    
                    $pesquisa = $mysqli->real_escape_string($_GET['search']);
                    if(!isset($_GET['row']) || $_GET['row']<=1) {
                        $sql_code = "SELECT * FROM produtos
                                    WHERE nome LIKE '%$pesquisa%' 
                                    OR autor LIKE '%$pesquisa%'
                                    OR categoria LIKE '%$pesquisa%'
                                    OR id LIKE '%$pesquisa%'
                                    LIMIT 8";
                    } else {
                        $inicial = (intval($_GET['row'])*8) - 8;
                        $sql_code = "SELECT * FROM produtos
                                    WHERE nome LIKE '%$pesquisa%' 
                                    OR autor LIKE '%$pesquisa%'
                                    OR categoria LIKE '%$pesquisa%'
                                    OR id LIKE '%$pesquisa%'
                                    LIMIT $inicial, 8";
                    }
                    $num_pesquisa = ($mysqli->query("SELECT * FROM produtos
                                                    WHERE nome LIKE '%$pesquisa%' 
                                                    OR autor LIKE '%$pesquisa%' 
                                                    OR categoria LIKE '%$pesquisa%'
                                                    OR id LIKE '%$pesquisa%'"))->num_rows;
                    $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error);
            
                    $qtd_resultado = $sql_query->num_rows;
                    if ($qtd_resultado == 0) {
                        ?>
                <tr>
                    <td colspan="10">Nenhum resultado encontrado...</td>
                </tr>
                <?php } else {
                    while($produto = $sql_query->fetch_assoc()) {
                        ?>
                <tr>
                    <td><?php echo $produto['id'] ?></td>
                    <td><img src="<?php echo $produto['imagem'] ?>" alt="" width="80"></td>
                    <td><?php echo $produto['nome'] ?></td>
                    <td><?php echo $produto['autor'] ?></td>
                    <td><?php echo formatar_valor($produto['valor']) ?></td>
                    <td><?php echo $produto['estoque'] ?></td>
                    <td><?php echo $produto['categoria'] ?></td>
                    <td><?php echo formatar_data($produto['data_cadastro']) ?></td>
                    <td><a href="?p=editar_produto&id=<?php echo $produto['id'] ?>">Editar</a></td>
                    <td><a href="?p=deletar_produto&id=<?php echo $produto['id'] ?>">Deletar</a></td>
                </tr>
                <?php
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <?php 
        if(isset($_GET['search'])) {
            $qtd_rows = ceil($num_pesquisa/8);
            for($i=1; $i<$qtd_rows+1; $i++) {
                echo "<a href='?p=gerenciar_produtos&search=$pesquisa&row=$i'>$i</a>/";
            }
        } else {
            $qtd_rows = ceil($num_produtos/8);
            for($i=1; $i<$qtd_rows+1; $i++) {
                echo "<a href='?p=gerenciar_produtos&row=$i'>$i</a>/";
            }
        }
        ?>
    </div>
</div>
