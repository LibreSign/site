<?php

include "../vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;
use Libresign\Espeak\Espeak;

session_start();

header("Access-Control-Allow-Origin: {$_ENV['URL_SITE']}");

if(empty($_SESSION['code'])){
    $builder = new CaptchaBuilder();
    $builder->build();
    $_SESSION['code'] = $builder->getPhrase(); 
}

header('Content-Type: audio/wav');
header('Content-Disposition: inline;filename=captcha.wave');

$text = '';

for($i=0;$i < strlen($_SESSION['code']); $i++){
    $text .= ' '.$_SESSION['code'][$i];
}

echo (new Espeak())
        ->setOption('stdout')
        ->setOption('s', '110')
        ->setOption('v', (new Espeak())->getVoiceCode($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        ->execute($text);