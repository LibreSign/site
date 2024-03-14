<?php

include "../vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder();
$builder->build();

session_start();

header("Access-Control-Allow-Origin: {$_ENV['URL_SITE']}");
header("Access-Control-Allow-Credentials: true");

$_SESSION['code'] = $builder->getPhrase(); 

header('Content-Type: image/jpeg');

echo $builder->output();