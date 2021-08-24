<?php

require __DIR__ . '/vendor/autoload.php';

use Curl\Curl;

$faker = Faker\Factory::create();
$curl = new Curl();

function fakeBukuKas($curl, $email) {
    $curl->setHeader('Host', 'bukukas.org');
    $curl->setHeader('Connection', 'keep-alive');
    $curl->setHeader('Cache-Control', 'max-age=0');
    $curl->setHeader('sec-ch-ua', '"Chromium";v="92", " Not A;Brand";v="99", "Google Chrome";v="92"');
    $curl->setHeader('sec-ch-ua-mobile', '?0');
    $curl->setHeader('Upgrade-Insecure-Requests', '1');
    $curl->setHeader('Origin', 'https://bukukas.org');
    $curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36');
    $curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');
    $curl->setHeader('Sec-Fetch-Site', 'same-origin');
    $curl->setHeader('Sec-Fetch-Mode', 'navigate');
    $curl->setHeader('Sec-Fetch-User', '?1');
    $curl->setHeader('Sec-Fetch-Dest', 'document');
    $curl->setHeader('Referer', 'https://bukukas.org/voucher-game/kode-voucher-google-play/');
    // $curl->setHeader('Accept-Encoding', 'gzip, deflate, br');
    $curl->setHeader('Accept-Language', 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7');
    $curl->setHeader('Cookie', 'cookielawinfo-checkbox-non-necessary=yes');
    $curl->setHeader('Accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9');
    $curl->setOpt(CURLOPT_ENCODING , '');
    $curl->post('https://bukukas.org/voucher-game/kode-voucher-google-play/', 'selected=500&email=' . $email . '&vocx='
    );

    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        preg_match_all('/window.open(.*)", ""/', $curl->response, $output);
        $output = str_replace('("', '', $output[1][0]);

        echo '[x] ' . $email  . ' | ' . $output . "\n"; 
    }
}

while(-1) {
    fakeBukuKas($curl, $faker->email);
}