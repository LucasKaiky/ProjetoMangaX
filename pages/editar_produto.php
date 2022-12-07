<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(1);
$id = intval($_GET['id']);
$sql_query = $mysqli->query("SELECT * FROM produtos WHERE id = '$id'") or die($mysqli->error);
$produto = $sql_query->fetch_assoc();

if (isset($_POST['nome'])) {

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $autor = $mysqli->real_escape_string($_POST['autor']);
    $descricao = $mysqli->real_escape_string($_POST['descricao']);
    $preco = $mysqli->real_escape_string($_POST['preco']);
    $estoque = $mysqli->real_escape_string($_POST['estoque']);
    $categoria = $mysqli->real_escape_string($_POST['categoria']);

    $erro = array();
    if (empty($nome))
        $erro[] = "Preencha o nome do produto";

    if (empty($descricao))
        $erro[] = "Preencha a descrição";

    if (empty($preco))
        $erro[] = "Preencha o preço";

    if (count($erro) == 0) {
        if($_FILES['imagem']['size'] == 0){
            $sql_code = "UPDATE produtos
                        SET nome = '$nome',
                        autor = '$autor',
                        descricao = '$descricao',
                        valor = '$preco',
                        estoque = '$estoque',
                        categoria = '$categoria'
                        WHERE id = '$id'";
        } else {
            $file_name = $produto['imagem'];
            unlink($file_name);
            $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
            if($deu_certo !== false) {
                $sql_code = "UPDATE produtos
                        SET nome = '$nome',
                        autor = '$autor',
                        descricao = '$descricao',
                        valor = '$preco',
                        imagem = '$deu_certo',
                        estoque = '$estoque',
                        categoria = '$categoria'
                        WHERE id = '$id'";
            } else {
                $erro[] = "Falha no envio da mensagem";
            }
        }
            $alterado = $mysqli->query($sql_code);
        if (!$alterado)
            echo "Falha ao alterar no banco de dados: " . $mysqli->error;
        else {
            die("<script>location.href=\"index.php?p=gerenciar_produtos\";</script>");
        }
    }
}


?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">

<div class="container">
    <div class="forms">
        <div class="form login">
            <div class="auth-content">
                <div class="auth-title">
                    <a href="?p=gerenciar_usuarios"><i class="fa-solid fa-screwdriver-wrench"></i>/</a>
                    <span class="title">Editar produto #<?php echo $produto['id'] ?></span>
                </div>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" placeholder="Nome do produto" required>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="autor" value="<?php echo $produto['autor']; ?>" placeholder="Autor" required>
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <div class="input-field">
                    <input type="number" min="0.00" max="10000.00" step="0.01" name="preco" value="<?php echo $produto['valor']; ?>" placeholder="Preço" />
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <div class="input-field descricao">
                    <textarea name="descricao" cols="30" rows="4" placeholder="&#10;Descrição do produto" required><?php echo $produto['descricao']; ?></textarea>
                    <i class="fa-solid fa-align-right"></i>
                </div>
                <div class="input-field">
                    <input type="number" name="estoque" value="<?php echo $produto['estoque']; ?>" step="1" placeholder="Quantidade estoque">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="input-field">
                    <label for="">Categoria: </label>
                    <select name="categoria" class="custom-select">
                        <option value="">- - - -</option>
                        <option value="destaque" <?php if($produto['categoria'] == "destaque") echo "selected" ?>>Destaque</option>
                        <option value="lancamento" <?php if($produto['categoria'] == "lancamento") echo "selected" ?>>Lancamento</option>
                        <option value="pre-venda" <?php if($produto['categoria'] == "pre-venda") echo "selected" ?>>pre-venda</option>
                    </select>
                </div>
                <div class="input-field custom-img">
                    <input type="file" name="imagem" id="imagem">
                    <label for="imagem">
                        <i class="fa-regular fa-image"></i>Alterar imagem
                    </label>
                </div>


                <?php if (isset($erro[3])) { ?>
                    <span class="error"><?php echo $erro[3]; ?></span>
                <?php } ?>

                <div class="input-field button">
                    <input type="submit" name="editar" value="Editar">
                </div>
            </form>
        </div>
    </div>
</div>