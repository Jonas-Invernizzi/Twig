<?php

require_once('carregar_twig.php');

$nome = 'fulaninho';

echo $twig->render('teste_twig.html',[
    'nome'=>$nome,
    'legal'=>true,
]);