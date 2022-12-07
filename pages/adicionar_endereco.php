<?php
include("lib/conexao.php");
include("lib/enviar_arquivo.php");
include('lib/protect.php');
protect(0);

$user_id = $_SESSION['usuario'];

if(isset($_POST['registrar'])) {

    $numero = $mysqli->real_escape_string($_POST['numero']);
    $endereco = $mysqli->real_escape_string($_POST['endereco'] . ", $numero");
    $complemento = $mysqli->real_escape_string($_POST['complemento']);
    $cidade = $mysqli->real_escape_string($_POST['cidade']);
    $bairro = $mysqli->real_escape_string($_POST['bairro']);
    $estado = $mysqli->real_escape_string($_POST['estado']);
    $cep = $mysqli->real_escape_string($_POST['cep']);
    if(strlen($cep) == 8) {
        $cep = substr($cep, 0, 5) . "-" . substr($cep, 5, 9);
    }

    $mysqli->query("UPDATE usuarios SET endereco1='$endereco', endereco2='$complemento', cidade='$cidade', bairro='$bairro', estado='$estado', cep='$cep' WHERE id='$user_id'");
    die("<script>location.href=\"index.php?p=checkout\";</script>");

}


?>

<link rel="stylesheet" href="assets/css/admin_cadastro.css">

<div class="container">
    <div class="forms">
        <div class="form login">
            <div class="auth-content">
                <div class="auth-title">
                    <a href="index.php"><i class="fa-solid fa-house"></i></a>/<a href="?p=carrinho">carrinho</a>/
                    <span class="title">Checkout</span>
                </div>
            </div>
            <br>
            <span class="title">Endereço para entrega</span>
            <form action="" method="POST">
                <div class="input-field">
                    <input type="text" name="cep" id="cep" placeholder="CEP" minlength="8" maxlength="9" pattern="\d{5}-?\d{3}" required>
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="endereco" id="endereco" placeholder="Endereço" required>
                    <i class="fa-solid fa-building"></i>
                </div>
                <div class="input-field">
                    <input type="number" name="numero" id="numero" placeholder="Numero" required>
                    <i class="fa-solid fa-hashtag"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="complemento" id="complemento" placeholder="Complemento" required>
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="bairro" id="bairro" placeholder="Bairro" required>
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
                    <i class="fa-solid fa-city"></i>
                </div>
                <div class="input-field">
                    <label for="uf">Estado</label>
                    <select id="uf" name="estado">
                        <option value=""></option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>

                <?php if (isset($erro[3])) { ?>
                    <span class="error"><?php echo $erro[3]; ?></span>
                <?php } ?>

                <div class="input-field button">
                    <input type="submit" name="registrar" value="Cadastrar endereço">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
	$("#cep").blur(function(){
        // Remove tudo o que não é número para fazer a pesquisa
        var cep = this.value.replace(/[^0-9]/, "");
        
        // Validação do CEP; caso o CEP não possua 8 números, então cancela
        // a consulta
        if(cep.length != 8){
            return false;
        }
        
        // A url de pesquisa consiste no endereço do webservice + o cep que
        // o usuário informou + o tipo de retorno desejado (entre "json",
        // "jsonp", "xml", "piped" ou "querty")
        var url = "https://viacep.com.br/ws/"+cep+"/json/";
        
        // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
        // caso ocorra algum erro (o cep pode não existir, por exemplo) a
        // usabilidade não seja afetada, assim o usuário pode continuar//
        // preenchendo os campos normalmente
        $.getJSON(url, function(dadosRetorno){
            try{
                // Preenche os campos de acordo com o retorno da pesquisa
                $("#endereco").val(dadosRetorno.logradouro);
                $("#bairro").val(dadosRetorno.bairro);
                $("#cidade").val(dadosRetorno.localidade);
                $("#uf").val(dadosRetorno.uf);
            }catch(ex){}
        });
    });
</script>