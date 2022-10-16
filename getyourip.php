<?php
$get = file_get_contents('https://ip.seeip.org/jsonip');
$getip4 = file_get_contents('https://api.ipify.org?format=json');

$ip4 = json_decode($getip4);
$ip = json_decode($get);

echo "Hai, this is your IP now.." . "<br>";
echo "Your IPv4 : " . $ip4->ip . "<br>";
echo "Your IPv6 : " . $ip->ip . "<br>";

// Get more about your information
$information = file_get_contents('http://ip-api.com/json/' . $ip4->ip . '?fields=9498623');

$dataIp = json_decode($information);
echo "------------------------------------------------- <br>";
echo "Hai, this is your specific information now.." . "<br>";
echo "Your Continent : " . $dataIp->continent . "<br>";
echo "Your Country : " . $dataIp->country . "<br>";
echo "Your Currency : " . $dataIp->currency . "<br>";
echo "Your Region : " . $dataIp->regionName . "<br>";
echo "Your City : " . $dataIp->city . "<br>";
echo "Your ISP : " . $dataIp->isp . "<br>";
