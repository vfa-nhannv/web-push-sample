<?php
require_once 'vendor/autoload.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

const VAPID_SUBJECT = 'http://localhost:8888/';
const PUBLIC_KEY = 'BB6nH9s493egk6xVgxZdb78jotXtdYSAIV_NLTmWLC2IfbmeSaGo6bTvEE5Icw95qvdEzV9HcltwABWDyruTvBo';
const PRIVATE_KEY = 'HqiizMUufg6wIMxnAvMWP0JOKlN0l9eSf9evGeP0Tdw';

// push通知認証用のデータ
$subscription = Subscription::create([
    'endpoint' => 'https://fcm.googleapis.com/fcm/send/enQnhoResXk:APA91bHG2FO-fImEd7wcsZIZnOsgps7DIQKARYWRqVJAGDYuffJxuAf1TKgd25fOdzrGwzPWoBgBqK6vAontWJ_fN_dc06nKbBnV4fDPS1i3OcxDW-PYINVRMxzKNMQ_6OlXvpvT4koL',
    'publicKey' => 'BGYE0kiGdUjoqEtVD6kWdrVLQ6OeGIUpaa17oZWVoixfjjdTHQJtUY_yZqX7mzB1rDB2eB-zRw3NRdY6gcOOG7k',
    'authToken' => '7BXuQVCW4ZnaXx7MJARm_A',
]);

// ブラウザに認証させる
$auth = [
    'VAPID' => [
        'subject' => VAPID_SUBJECT,
        'publicKey' => PUBLIC_KEY,
        'privateKey' => PRIVATE_KEY,
    ]
];

$webPush = new WebPush($auth);

$report = $webPush->sendOneNotification(
    $subscription,
    'push通知の本文だよ！'
);

$endpoint = $report->getRequest()->getUri()->__toString();

if ($report->isSuccess()) {
    echo '送信成功！';
} else {
    echo '送信失敗やで';
}