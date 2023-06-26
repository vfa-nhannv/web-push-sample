<?php
// Gửi thông báo Web Push
function sendWebPushNotification($subscription, $payload, $publicKey, $privateKey) {
    $endpoint = $subscription['endpoint'];
    $key = $subscription['keys']['p256dh'];
    $token = $subscription['keys']['auth'];
  
    // Tạo payload
    $payload = json_encode($payload);
  
    // Tạo header
    $header = [
      'Content-Type: application/json',
      'TTL: 300',
      'Crypto-Key: p256ecdsa=BGYE0kiGdUjoqEtVD6kWdrVLQ6OeGIUpaa17oZWVoixfjjdTHQJtUY_yZqX7mzB1rDB2eB-zRw3NRdY6gcOOG7k'
    ];
  
    // Tạo đối tượng OpenSSL
    $openSSL = openssl_pkey_get_private($privateKey);
    $openSSL = 'HqiizMUufg6wIMxnAvMWP0JOKlN0l9eSf9evGeP0Tdw';
  
    // Tạo signature
    $signature = '';
    openssl_sign($endpoint . $key, $signature, $openSSL, OPENSSL_ALGO_SHA256);
  
    // Encode signature
    $encodedSignature = str_replace(['+', '/'], ['-', '_'], base64_encode($signature));
  
    // Tạo header Authorization
    $authorization = 'Authorization: WebPush ' . $encodedSignature . ':' . $token;
  
    // Gửi request
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, [$authorization]));
    $response = curl_exec($ch);
    curl_close($ch);
  
    return $response;
  }
  
  
  
  

// Dữ liệu đăng ký subscription từ client
$subscription = [
    "endpoint" => "https://fcm.googleapis.com/fcm/send/enQnhoResXk:APA91bHG2FO-fImEd7wcsZIZnOsgps7DIQKARYWRqVJAGDYuffJxuAf1TKgd25fOdzrGwzPWoBgBqK6vAontWJ_fN_dc06nKbBnV4fDPS1i3OcxDW-PYINVRMxzKNMQ_6OlXvpvT4koL", 
    "expirationTime" => null, 
    "keys" => [
          "p256dh" => "BGYE0kiGdUjoqEtVD6kWdrVLQ6OeGIUpaa17oZWVoixfjjdTHQJtUY_yZqX7mzB1rDB2eB-zRw3NRdY6gcOOG7k", 
          "auth" => "7BXuQVCW4ZnaXx7MJARm_A" 
       ] 
 ]; 

// Dữ liệu payload thông báo
$payload = [
  'title' => 'Thông báo mới',
  'body' => 'Đây là nội dung thông báo',
  'url' => 'https://example.com'
];

// Khóa công khai và khóa bí mật
$publicKey = 'BB6nH9s493egk6xVgxZdb78jotXtdYSAIV_NLTmWLC2IfbmeSaGo6bTvEE5Icw95qvdEzV9HcltwABWDyruTvBo';
$privateKey = 'private_key.pem';

// Gửi thông báo Web Push
$response = sendWebPushNotification($subscription, $payload, $publicKey, $privateKey);

// Xử lý kết quả
if ($response === false) {
  echo 'Gửi thông báo thất bại';
  echo var_dump($response);
} else {
  echo 'Gửi thông báo thành công';
  echo var_dump($response);
}
