<?php

include "../vendor/autoload.php";

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder();
$builder->build();

session_start();
$_SESSION['code'] = $builder->getPhrase(); 

header('Content-Type: image/jpeg');

echo $builder->output();