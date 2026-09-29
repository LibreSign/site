<?php

include "../vendor/autoload.php";

use App\Support\Captcha\CaptchaService;

require __DIR__ . '/session_bootstrap.php';
session_start();

header("Access-Control-Allow-Origin: {$_ENV['URL_SITE']}");
header("Access-Control-Allow-Credentials: true");

$captcha = (new CaptchaService())->generate();
$_SESSION['code'] = $captcha['phrase'];

header('Content-Type: image/jpeg');

echo $captcha['image'];
