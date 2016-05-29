<?php
error_reporting(E_ALL);
require 'vendor/autoload.php';
function get_client_ip() {
    $ip = $_SERVER['REMOTE_ADDR'];
    
//    echo "<h1>".$ip."</h1>";
//    return $ip;
    
    if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
        foreach ($matches[0] AS $xip) {
            if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                $ip = $xip;
                break;
            }
        }
    }
    return $ip;
}
$users = [
    [
        'name' => 'Kenny Katzgrau',
        'username' => 'katzgrau',
    ],
    [
        'name' => 'Dan Horrigan',
        'username' => 'dhrrgn',
    ],
];

//print_r($users);

date_default_timezone_set("Asia/Taipei");
$dt = new DateTime();
$dt_str= $dt->format('Y-m-d H:i:s');

$user_ip=get_client_ip();
$visit_record=array('time'=>$dt_str, 'user_ip'=>$user_ip,'user_id'=>123,'username'=>"xyz@example.com");
echo "<hr>";
print_r($visit_record);
echo "<hr>";
echo __DIR__;
echo "<hr>";
$logger = new Katzgrau\KLogger\Logger(__DIR__.'/logs');
//$logger->info('Returned a million search results');
$logger->error('Oh dear.');
//$logger->debug('Got these users from the Database.', $users);
$logger->debug('visit record', $visit_record);
