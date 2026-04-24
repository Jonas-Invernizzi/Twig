<?php

use Carbon\Carbon;

require('carregar_twig.php');
require('carregar_pdo.php');

$jogos = $pdo->query('SELECT * FROM jogos');
$todosJogos = $jogos->fetchAll(PDO::FETCH_ASSOC);

foreach($todosJogos as &$jogo){
    $jogo['lancamento'] = Carbon::parse($jogo
    ['lancamento'])->locale("pt-BR")->isoFormat('LL');
}
$datas = [
    'data' => Carbon::now()->format('d/m/Y'),
    'proximaSexta' => Carbon::now()->next(Carbon::FRIDAY)->format('d/m/Y'),
    'dataVinteDias' => Carbon::now()->addDays(20)->format('d/m/Y'),
];

echo $twig->render('jogos.html', [
    'jogos' => $todosJogos,
    'datas' => $datas,
]);