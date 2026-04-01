<?php
require('carregar_pdo.php');
require('carregar_twig.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = (int) $_GET['id'] ?? 0;
}
if (!$id) {
    header('Location: jogos.php');
    die;
} else {
    $dado = $pdo->prepare('SELECT * FROM jogos WHERE id = :id');
    $dado->execute(['id' => $id]);
    $jogo = $dado->fetch(PDO::FETCH_ASSOC);
}
echo $twig->render('jogos_editar.html', [
    'jogo' => $jogo,
]);
