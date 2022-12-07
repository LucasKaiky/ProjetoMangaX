<?php
// Conexão com o Banco de dados
include('lib/conexao.php');

// Caso não tenha iniciado uma sessão
if (!isset($_SESSION)) {
    session_start();
}

// query_string
$pagina = 'destaque.php';
if (isset($_GET['p'])) {
    if (file_exists('pages/' . $_GET['p'] . '.php')) {
        $pagina = $_GET['p'] . '.php';
    } else {
        $pagina = 'erro.php';
    }
}

?>

<?php
include('pages/header.php');
?>
<main>
    <?php
    include('pages/' . $pagina);
    if ($pagina == 'erro.php') {
        exit();
    }
    ?>
</main>
<?php 
include('pages/footer.php');
?>
