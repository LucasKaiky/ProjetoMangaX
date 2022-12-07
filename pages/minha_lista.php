<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(0);

$user_id = intval($_SESSION['usuario']);
$sql_query = $mysqli->query("SELECT * FROM lista_favoritos WHERE id_usuario='$user_id'");

?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">
<link rel="stylesheet" href="assets/css/table_style.css">
<link rel="stylesheet" href="assets/css/minha_lista.css">

<div class="container">
    <div class="forms">
        <div class="form login lista">
            <div class="auth-content">
                <div class="auth-title">
                    <a href="index.php"><i class="fa-solid fa-house"></i></a>/
                    <span class="title">Minha lista</span>
                </div>
            </div>
            <br>
            <span class="title">Confira os itens adicionados a sua lista!</span>
            <table class="content-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Produto</th>
                        <th colspan="1" width=200px></th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                if($sql_query->num_rows > 0) {
                    while($item = $sql_query->fetch_assoc()) {
                        $id_produto = intval($item['id_produto']);
                        $produto = $mysqli->query("SELECT * FROM produtos WHERE id='$id_produto'")->fetch_assoc(); ?>
                        <tr>
                            <td><a href="?p=produto&id=<?php echo $produto['id'] ?>"><img src="<?php echo $produto['imagem'] ?>" alt="" width="80"></a></td>
                            <td><a href="?p=produto&id=<?php echo $produto['id'] ?>" style="text-decoration: none;"><?php echo $produto["nome"]; ?></a></td>
                            <td></td>
                            <td><?php echo formatar_valor($produto["valor"]); ?></td>
                            <td><a href="?p=adicionar_a_lista&id=<?php echo $produto["id"]; ?>"><span class="text-danger"><i class="fa-solid fa-xmark"></i></span></a></td>
                        </tr>
                        
                <?php 
                    }
                } else { ?>
                    <tr>
                        <td colspan="6">Nenhum Item salvo.</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>