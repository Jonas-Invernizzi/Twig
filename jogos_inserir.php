<?php
$erro = false;
$nome = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? false;
    $estilo = $_POST['estilo'] ?? false;
    
}
if ((!$nome || !$estilo)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $erro = "⚠️Preencha todos os campo.";
    }
} else {
    $ext = pathinfo($_FILES["capa"]["name"], PATHINFO_EXTENSION);
    $capa = uniqid().'.';

    require("carregar_pdo.php");
    $dados = $pdo->prepare('INSERT INTO jogos (nome, estilo) VALUES (?,?)');
    $dados->bindParam(1, $nome);
    $dados->bindParam(2, $estilo);
    
    $dados->execute();

    header('location:jogos.php');
    die;
}

require('carregar_twig.php');

echo $twig->render('jogos_inserir.html', [
    'erro' => $erro,
]);
