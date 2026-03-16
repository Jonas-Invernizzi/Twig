<?php

require_once('carregar_twig.php');

$nome = 'fulaninho';

$poema = "Um Poema sobre o amor

Quer seja curto ou comprido
Quer seja fino ou mais grosso
É um órgão muito querido
Por não ter espinhas nem osso

De incalculável valor
Ninguém tem um a mais
E desempenha no amor
Um dos papéis principais

Quando uma dama aparece
Ei-lo a pular com fervor
Se é um rapaz, estremece
Se é velho, tem pouco vigor

O seu nome não é tão feio
Pois tem sete letrinhas só
Tem um R e um A no meio
Começa em C e acaba em O

Nunca se encontra sozinho
Vive sempre acompanhado
Por outros dois orgãozinhos
Junto de si, lado a lado

O nome destes porém
Não gera confusões
Tem sete letras também
Tem L e acaba em ÕES

Prá acabar com o embalo
E com as más impressões
Os órgãos de que eu falo...
São o CORAÇÃO e os PULMÕES.";

$disciplinas = [
    'Programação',
    'Banco de Dados',
    'Interface Web',
    'Desenvolvimento de Sistemas',
];

echo $twig->render('teste_twig.html',[
    'nome'=>$nome,
    'legal'=>true,
    'disciplinas'=>$disciplinas,
    'poema'=>$poema,
]);