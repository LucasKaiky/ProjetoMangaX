<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(1);


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

    if (!isset($_FILES) || !isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0)
        $erro[] = "Selecione uma imagem para o conteúdo";

    if (count($erro) == 0) {

        $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
        if ($deu_certo !== false) {

            $sql_code = "INSERT INTO produtos (nome, autor, descricao, valor, data_cadastro, imagem, estoque, categoria) VALUES(
                '$nome',
                '$autor',
                '$descricao',
                '$preco',
                NOW(),
                '$deu_certo',
                '$estoque',
                '$categoria'
            )";
            $inserido = $mysqli->query($sql_code);
            if (!$inserido)
                echo "Falha ao inserir no banco de dados: " . $mysqli->error;
            else {
                die("<script>location.href=\"index.php?p=gerenciar_produtos\";</script>");
            }
        } else
            $erro[] = "Falha ao enviar a imagem";
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
                    <span class="title">Cadastrar produto</span>
                </div>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <input type="text" name="nome" placeholder="Nome do produto" required>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="autor" placeholder="Autor" required>
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <div class="input-field">
                    <input type="number" min="0.00" max="10000.00" step="0.01" name="preco" placeholder="Preço" />
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <div class="input-field descricao">
                    <textarea name="descricao" cols="30" rows="4" placeholder="&#10;Descrição do produto" required></textarea>
                    <i class="fa-solid fa-align-right"></i>
                </div>
                <div class="input-field">
                    <input type="number" name="estoque" step="1" placeholder="Quantidade estoque">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="input-field">
                    <label for="">Categoria: </label>
                    <select name="categoria" class="custom-select">
                        <option value="">- - - -</option>
                        <option value="destaque">Destaque</option>
                        <option value="lancamento">Lancamento</option>
                        <option value="pre-venda">Pre-venda</option>
                    </select>
                </div>
                <div class="input-field custom-img">
                    <label for="imagem">
                        <input type="file" name="imagem" id="imagem">
                        <i class="fa-regular fa-image"></i>Enviar imagem
                    </label>
                </div>


                <?php if (isset($erro[3])) { ?>
                    <span class="error"><?php echo $erro[3]; ?></span>
                <?php } ?>

                <div class="input-field button">
                    <input type="submit" name="cadastrar" value="Cadastrar">
                </div>
            </form>
        </div>
    </div>
</div>