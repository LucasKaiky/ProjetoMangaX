<?php
include('lib/conexao.php');
include('lib/protect.php');
protect(1);

$ciclo_vendas = $mysqli->query("SELECT SUM(valor_total) as soma_valores FROM compras")->fetch_assoc()['soma_valores'];

$qtd_vendas = $mysqli->query("SELECT count(id) as qtd_vendas FROM compras")->fetch_assoc()['qtd_vendas'];
if($qtd_vendas==0) {
    $media_pedidos = 0;
} else {
    $media_pedidos = $ciclo_vendas / $qtd_vendas;
}

$qtd_usuarios = $mysqli->query("SELECT count(id) as qtd_usuarios FROM usuarios")->fetch_assoc()['qtd_usuarios'];

$qtd_produtos = $mysqli->query("SELECT count(id) as qtd_produtos FROM produtos")->fetch_assoc()['qtd_produtos'];

?>

<link rel="stylesheet" href="assets/css/painel_de_controle.css">

<div class="container">
    <div class="top">
        <div class="auth-title">
            <a href="index.php"><i class="fa-solid fa-house"></i></a>/
            <span class="title">Painel de controle</span>
            <br>
            <span class="desc-title">Visão geral da loja</span>
            <br><br>
            <hr>
        </div>
    </div>
    <div class="content">
        <div class="vendas">
            <div class="action ciclo-vendas">
                <div class="thead">
                    <h3>Ciclo de Vendas</h3>
                </div>
                <div class="tbody">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="value"><?php echo formatar_valor($ciclo_vendas) ?></span>
                </div>
            </div>
            <div class="action media-pedidos">
                <div class="thead">
                    <h3>Média dos Pedidos</h3>
                </div>
                <div class="tbody">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="value"><?php echo formatar_valor($media_pedidos) ?></span>
                </div>
            </div>
            <a href="?p=gerenciar_usuarios">
                <div class="action clientes-cadastrados">
                    <div class="thead">
                        <h3>Clientes Cadastrados</h3>
                    </div>
                    <div class="tbody">
                        <i class="fa-solid fa-user"></i>
                        <span class="value"><?php echo $qtd_usuarios ?></span>
                    </div>
                </div>
            </a>
            <a href="?p=gerenciar_produtos">
                <div class="action produtos-cadastrados">
                    <div class="thead">
                        <h3>Produtos Cadastrados</h3>
                    </div>
                    <div class="tbody">
                        <i class="fa-solid fa-file-arrow-down"></i>
                        <span class="value"><?php echo $qtd_produtos ?></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="pedidos">
        <h1>Pedidos</h1><br>
        <hr>
        <table class="content-table" width="900px" style="text-align: center; vertical-align: middle;">
            <thead>
                <tr>
                    <th>Pedido #</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Valor Cobrado</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <?php
            $sql_query = $mysqli->query("SELECT * FROM `compras` ORDER BY `compras`.`data_compra` ASC");
            if ($sql_query->num_rows > 0) {
                while ($pedido = $sql_query->fetch_assoc()) {
                    $id_cliente = $pedido['id_cliente'];
                    $nome_cliente = ($mysqli->query("SELECT * FROM usuarios WHERE id='$id_cliente'"))->fetch_assoc()['nome']; ?>
                    <tr>
                        <td><?php echo $pedido['id'] ?></td>
                        <td><?php echo formatar_data($pedido['data_compra']) ?></td>
                        <td><?php echo $nome_cliente ?></td>
                        <td><?php echo formatar_valor($pedido['valor_total']) ?></td>
                        <td><?php echo $pedido['status'] ?></td>
                        <td><a href="?p=detalhes_pedido&id=<?php echo $pedido['id'] ?>">Vizualizar pedido</a></td>
                    </tr>

                <?php
                }
            } else { ?>
                <tr>
                    <td colspan="6">Nenhum Pedido feito.</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>