<?php
require('carregar_pdo.php');
require('carregar_twig.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int) $_POST['id'] ?? false;
    $nome =  $_POST['nome'] ?? false;
    $estilo = $_POST['estilo'] ?? false;

    if (!$_FILES['capa']['error']) {
        $dados = $pdo->prepare('select capa from jogos where id = :id');
        $dados->execute([':id' => $id]);
        $capa_velha = $dados->fetch(PDO::FETCH_ASSOC)['capa'];

        $caminhoVelho = __DIR__ . '/img/' . $capa_velha;
        if ($capa_velha && file_exists($caminhoVelho)) {
            unlink($caminhoVelho);
        }

        $ext = pathinfo($_FILES["capa"]["name"], PATHINFO_EXTENSION);
        $capa = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");

        $dados = $pdo->prepare('update jogos set capa = :capa where id = :id');
        $dados->execute([':id' => $id, ':capa' => $capa]);
    }
    
    $sql = 'UPDATE jogos set nome = :nome, estilo = :estilo'.(isset($capa) ? ', capa = :capa' : '').' where id = :id';

    $dados = $pdo->prepare($sql);
    $params = [
        ':id' => $id,
        ':nome' => $nome,
        ':estilo' => $estilo,
    ];
    if(isset($capa) ) { $params[':capa'] = $capa;}
    $dados->execute($params);

    header('location:jogos.php');
    die;
}
$id = (int) $_GET['id'] ?? false;
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
