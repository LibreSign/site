<?php

include "../vendor/autoload.php";
use Gregwar\Captcha\CaptchaBuilder;
session_start();

header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

$builder = new CaptchaBuilder($_SESSION['code']);
$codeImg = filter_input(INPUT_POST, 'codeImg');

if( !$builder->testPhrase($codeImg)){
    http_response_code(404);
    return;
}
$formulario_data = array(
    'moduleDir' => 'Contacts',
    'assigned_user_id' => $_ENV['ASSIGNED_USER_ID'],
    'campaign_id' => $_ENV['CAMPAIGN_ID'],
    'last_name' => filter_input(INPUT_POST, 'name'),
    'email1' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
    'phone_mobile' => filter_input(INPUT_POST, 'phone_mobile'),
    'description' => filter_input(INPUT_POST, 'description'),
);

$ch = curl_init($_ENV['URL_SUITECRM']);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $formulario_data);

$resposta = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(404);
    return;
}

curl_close($ch);