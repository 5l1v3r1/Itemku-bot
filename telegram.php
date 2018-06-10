<?php
error_reporting(0);
require_once("sdata-modules.php");
/**
 * @Author: Eka Syahwan
 * @Date:   2017-12-11 17:01:26
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2018-06-10 18:17:08
 */

$telegram_token 	= 'bot610635664:AAF0xfXLhnlwC4_yDH5VK-uFvjER3pe2SBQ'; // telegram token
$telegram_chat_id 	= '172948529'; // telegram chat id
$cookies 			= ''; // cookies


function update_toko($sdata , $cookies = null){
	$heads_updatetoko[] = array(
		'header' => array(
			    "cookie: ".$cookies,
			    "origin: https://itemku.com",
			    "referer: https://itemku.com/percakapan?text=&filter=1",
			    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
			    "x-requested-with: XMLHttpRequest"
		  ), 
		'post' => 'xx',
	);
	$urls_updatetoko[] 	= array(
		'url' => 'https://itemku.com/tokoku/buka-toko', 
	);
	$respons_tokoupdate = $sdata->sdata($urls_updatetoko , $heads_updatetoko);
	$respons_tokoupdate = json_decode($respons_tokoupdate[0][respons],true);
	return ($respons_tokoupdate[data][status_toko] ? "Toko Sedang Buka":"Toko Sedang Tutup");
}

function color($color = "default" , $text){
	$arrayColor = array(
		'grey' 		=> '1;30',
		'red' 		=> '1;31',
		'green' 	=> '1;32',
		'yellow' 	=> '1;33',
		'blue' 		=> '1;34',
		'purple' 	=> '1;35',
		'nevy' 		=> '1;36',
		'white' 	=> '1;0',
	);	
	return "\033[".$arrayColor[$color]."m".$text."\033[0m";
}

echo "======================================\r\n";
$heads[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/percakapan?text=&filter=1",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ), 
	'post' => 'asd',
);
$urls[] 	= array(
	'url' => 'https://itemku.com/ajax/get_user_wallet_metadata', 
);

$headxxxx[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/percakapan?text=&filter=1",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ), 
);
$urlsxxxx[] 	= array(
	'url' => 'https://itemku.com/tokoku/saldo', 
);

$headcektoko[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/percakapan?text=&filter=1",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ), 
);
$urlcektoko[] 	= array(
	'url' => 'https://itemku.com/tokoku/pengaturan', 
);

$pengaturan = $sdata->sdata($urlcektoko , $headcektoko);
$xasaldo 	= $sdata->sdata($urlsxxxx , $headxxxx);
preg_match_all('/checked/m', $pengaturan[0][respons], $statustoko);
$checkeddd 	= ($statustoko[0][0] ? "Toko Sedang Buka":"Toko Sedang Tutup");
preg_match_all('/<span class="balance-status-currency">Rp (.*?)<\/span>/m', $xasaldo[0][respons], $isaldo);

$isaldo_total = str_replace(".", "", $isaldo[1][1]);

echo color("nevy","[+]")."".color("purple","[CHECK]")." User ID  ... ";

$r = $sdata->sdata($urls , $heads);
$r = json_decode($r[0][respons],true);

echo substr($r[data][walletHeader][user_id], 0,4)."    | ".color('yellow', 'OK')." |\r\n";

echo color("nevy","[+]")."".color("purple","[CHECK]")." Perintah Telegram   ";
$check_tele = file_get_contents("https://api.telegram.org/".$telegram_token."/getUpdates");
$check_tele = json_decode($check_tele,true);
echo " | ".color('yellow', 'OK')." |\r\n";



$head_xxx1222[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/tokoku/pesanan?per_page=40&order_status_type=2",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ),
);
$url_xxx1222[] 	= array(
	'url' => 'https://itemku.com/tokoku/pesanan?per_page=40&order_status_type=1', 
);
$resultxqqq = $sdata->sdata($url_xxx1222 , $head_xxx1222);
preg_match_all('/https:\/\/itemku\.com\/tokoku\/pesanan\/detil\/(.*?)" class="text-red">/m', $resultxqqq[0][respons], $xx122sxxx);

foreach ($check_tele[result] as $key => $message_detail) {

	$ibot_message[id] 	= $message_detail[message][reply_to_message][message_id];
	$ibot_message[chat] = $message_detail[message][reply_to_message][text];
	$ibot_message[rep] 	= $message_detail[message][text];
	$ibot_message[mid] 	= $message_detail[message][message_id];

	$explode 				= explode("][", $ibot_message[chat]);
	$explode 				= explode("]", $ibot_message[chat]);
	$explode 				= str_replace("[","", $explode[1]);
	$ibot_message[userid] 	= $explode; 

	if($message_detail[message][entities][0][type] == "bot_command" && !preg_match("/".md5($ibot_message[id].$ibot_message[mid])."/", file_get_contents("logs-command.txt"))){
		$config = array(
			'/status saldo' => "Rp " . number_format($isaldo_total,2,',','.'),
			'/status toko' 	=> $checkeddd, 
			'/status order' => "Status Order Belum di proses : ".count($xx122sxxx[1]),
		);
		foreach ($config as $command => $sendrespons) {
			if($ibot_message[rep] == $command){
				file_get_contents("https://api.telegram.org/".$telegram_token."/sendMessage?chat_id=".$telegram_chat_id."&reply_to_message_id=".$ibot_message[mid]."&text=".$sendrespons."&parse_mode=HTML");
			}
			$fopn = fopen("logs-command.txt", "a+");
			fwrite($fopn, md5($ibot_message[id].$ibot_message[mid])."\r\n");
			fclose($fopn);
		}
	}
	if($message_detail[message][entities][0][type] == "bot_command" && !preg_match("/".md5($ibot_message[id].$ibot_message[mid])."/", file_get_contents("logs-commandAction.txt"))){

		if($ibot_message[rep] == '/update toko'){
			$change_status = update_toko($sdata , $cookies);
			file_get_contents("https://api.telegram.org/".$telegram_token."/sendMessage?chat_id=".$telegram_chat_id."&reply_to_message_id=".$ibot_message[mid]."&text=".$change_status."&parse_mode=HTML");

		}

		$fopn = fopen("logs-commandAction.txt", "a+");
		fwrite($fopn, md5($ibot_message[id].$ibot_message[mid])."\r\n");
		fclose($fopn);
	}
	if(!empty($ibot_message[chat]) && !empty($ibot_message[userid]) && !empty($ibot_message[rep]) && !empty($ibot_message[id]) && !preg_match("/".md5($ibot_message[id])."/", file_get_contents("log.txt")) ){
		

		$head_balaskomen[] = array(
			'header' => array(
			    "cache-control: no-cache",
			    "connection: keep-alive",
			    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
			    "cookie: ".$cookies,
			    "host: itemku.com",
			    "origin: https://itemku.com",
			    "referer: https://itemku.com/percakapan/".$ibot_message[userid],
			    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
			    "x-requested-with: XMLHttpRequest"
			  ), 
			'post' => 'reply_to='.$ibot_message[userid].'&reply_text='.$ibot_message[rep].'&image_url=',
		);
		$url_balaskomen[] = array('url' => 'https://itemku.com/percakapan/kirim');

		$respons = $sdata->sdata($url_balaskomen , $head_balaskomen);
		unset($url_balaskomen);unset($head_balaskomen);

		foreach ($respons as $key => $value) {
			$ij = json_decode($value[respons],true);
			echo "[".$ibot_message[userid]."] ".$ibot_message[rep]."\r\n";
		}

		$fopn = fopen("log.txt", "a+");
		fwrite($fopn, md5($ibot_message[id])."\r\n");
		fclose($fopn);
	}
}



$head[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/percakapan?text=&filter=1",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ), 
	//'post' => 'asd',
);
$url[] 	= array(
	'url' => 'https://itemku.com/percakapan?text=&filter=2', 
);
$head_2[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/percakapan?text=&filter=2",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ),
);
$url_2[] 	= array(
	'url' => 'https://itemku.com/tokoku/pesanan?order_status_type=1&order_type=0', 
);



echo color("nevy","[+]")."".color("purple","[CHECK]")." Orderan (DIBAYAR)    ";
$result = $sdata->sdata($url_2 , $head_2);

preg_match_all('/https:\/\/itemku\.com\/tokoku\/pesanan\/detil\/(.*?)$/m', $result[0][respons], $matches);
preg_match_all('/<span class="text-bold text-darkgrey text-small">(.*?)<\/span>/m', $result[0][respons], $x);
preg_match_all('/<span class="display-block text-darkgrey text-bold text-small">(.*?)<\/span>/m', $result[0][respons], $i);

if(count($i[1]) != 0){
	echo "| ".color('green', substr('00' . count($i[1]), -2))." |\r\n";
}else{
	echo "| ".color('red', substr('00' . count($i[1]), -2))." |\r\n";
}

$head_3[] = array(
	'header' => array(
		    "cookie: ".$cookies,
		    "origin: https://itemku.com",
		    "referer: https://itemku.com/tokoku/pesanan?per_page=40&order_status_type=2",
		    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
		    "x-requested-with: XMLHttpRequest"
	  ),
);
$url_3[] 	= array(
	'url' => 'https://itemku.com/tokoku/pesanan?per_page=40&order_status_type=2', 
);

echo color("nevy","[+]")."".color("purple","[CHECK]")." Orderan (DITERIMA)  ";
$resultx = $sdata->sdata($url_3 , $head_3);
preg_match_all('/https:\/\/itemku\.com\/tokoku\/pesanan\/detil\/(.*?)" class="text-red">/m', $resultx[0][respons], $xxs);
preg_match_all('/<span class="text-bold text-darkgrey text-small">(.*?)<\/span>/m', $resultx[0][respons], $last_item_nama);
preg_match_all('/<span class="display-block text-darkgrey text-bold text-small">(.*?)<\/span>/m', $resultx[0][respons], $last_item_harga);
preg_match_all('/<span class="display-block text-small text-darkgrey" style="word-break: break-word;">(.*?)<\/span>/m', $resultx[0][respons], $last_item_namasangpengorder);
preg_match_all('/https:\/\/itemku\.com\/percakapan\/(.*?)"/m', $resultx[0][respons], $last_item_idsangpengorder);
preg_match_all('/<b>OD(.*?)<\/b>/m', $resultx[0][respons], $odiord);
preg_match_all('/\(\+Rp (.*?)\)/m', $resultx[0][respons], $plushharga);



foreach ($plushharga[1] as $key => $hg) {
	$ihg = ($ihg+str_replace(".", "", $hg));
}

if(count($xxs[1]) != 0){
	echo " | ".color('green', substr('00' . count($xxs[1]), -2))." |\r\n";
}else{
	echo " | ".color('red', substr('00' . count($xxs[1]), -2))." |\r\n";
}

echo color("nevy","[+]")."".color("purple","[CHECK]")." Chat (Terimakasih)  ";

foreach ($xxs[1] as $keyOrder => $idOrder) {

	if(preg_match("/Steam/", $last_item_nama[1][$keyOrder])){
		$link_help = 'https://itemku.com/tanya-jawab/artikel/cara-trading-steam-wallet-code/232066807';
	}else if(preg_match("/Garena/", $last_item_nama[1][$keyOrder])){
		$link_help = 'https://itemku.com/tanya-jawab/artikel/cara-trading-garena-shell/235035068';
	}else if(preg_match("/G-Cash/", $last_item_nama[1][$keyOrder])){
		$link_help = 'https://itemku.com/tanya-jawab/artikel/cara-trading-gemscool-g-cash/235035128';
	}else{
		$link_help = 'https://itemku.com/tanya-jawab/kategori/cara-trading/203932918?page=1';
	}

	$message_thanks = 'Terimakasih '.$last_item_namasangpengorder[1][$keyOrder]." sudah membeli ".$last_item_nama[1][$keyOrder]." (Nomor Order : OD".$odiord[1][$keyOrder].") di tunggu konfirmasi , review dan next ordernya.";
	$message_reedem = 'Untuk cara reedem atau mengunakan vocer '.$last_item_nama[1][$keyOrder].', '.$last_item_namasangpengorder[1][$keyOrder].' dapat membaca di '.$link_help;
	$message_help 	= 'Bila '.$last_item_namasangpengorder[1][$keyOrder].' masih kurang paham atau ada pertanyaan bisa membalas pesan ini.';
	//$message 		= array($message_thanks , $message_reedem , $message_help);		
	$message 		= array($message_thanks , $message_reedem);		

	if(!preg_match("/".md5($idOrder)."/", file_get_contents("log_orderucapan.txt"))){
		foreach ($message as $key => $pesannyadonk) {
			$head_balasthanks[] = array(
				'header' => array(
				    "cache-control: no-cache",
				    "connection: keep-alive",
				    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
				    "cookie: ".$cookies,
				    "host: itemku.com",
				    "origin: https://itemku.com",
				    "referer: https://itemku.com/percakapan/".$last_item_idsangpengorder[1][$keyOrder],
				    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36",
				    "x-requested-with: XMLHttpRequest"
				  ), 
				'post' => 'reply_to='.$last_item_idsangpengorder[1][$keyOrder].'&reply_text='.$pesannyadonk.'&image_url=',
			);
			$url_balasthanks[] = array(
				'url' => 'https://itemku.com/percakapan/kirim'
			);
		}
		$respons = $sdata->sdata($url_balasthanks , $head_balasthanks);
		unset($url_balasthanks);unset($head_balasthanks);
		foreach ($respons as $key => $value) {
			$jsonRes = json_decode($value[respons],true);
			if($jsonRes[returnCode] == 1){
				$chat[] = $last_item_idsangpengorder[1][$keyOrder];
			}
		}

		$f = fopen("log_orderucapan.txt", "a+");
		fwrite($f, md5($idOrder)."\r\n");
		fclose($f);
	}
}

if(count($chat) != 0){
	echo " | ".color('green', substr('00' . count($chat), -2))." |\r\n";
}else{
	echo " | ".color('red', substr('00' . count($chat), -2))." |\r\n";
}

$orderan_diterima 	= count($xxs[1]);
$orderan_status 	= count($i[1]);

foreach ($i[1] as $key => $harga) {
	if( $harga ){
		$ordernomo = str_replace('" class="text-red">', "", $matches[1][$key]);
		$format = "[Order Nomor ".$ordernomo."] Nama Produk : ".$x[1][$key]." | Total Pembelian : ".$harga;
		if(!preg_match("/".md5($format)."/", file_get_contents("log_produk.txt"))){
			
			file_get_contents("https://api.telegram.org/".$telegram_token."/sendMessage?chat_id=".$telegram_chat_id."&text=".$format."&parse_mode=HTML");
			$f = fopen("log_produk.txt", "a+");
			fwrite($f, md5($format)."\r\n");
			fclose($f);
		
		}
	}
} 

echo color("nevy","[+]")."".color("purple","[CHECK]")." Pesanan Masuk    ";
$result = $sdata->sdata($url , $head);

preg_match_all('/<span class="username-message display-block shop-text"><b>(.*?)<\/b><\/span>/m', $result[0][respons], $c_name);
preg_match_all('/<span class="username-message">(.*?)<\/span>$/m', $result[0][respons], $c_chat);
preg_match_all('/<a href="https:\/\/itemku\.com\/percakapan\/(.*?)">/m', $result[0][respons], $c_id);

if(count($c_chat[1]) != 0){
	echo "    | ".color('green', substr('00' . count($c_chat[1]), -2))." |\r\n";
}else{
	echo "    | ".color('red', substr('00' . count($c_chat[1]), -2))." |\r\n";
}

$chat_status = count($c_chat[1]);
foreach ($c_chat[1] as $key => $chat) {
	if( $chat ){
		$format = "[CHAT][".$c_id[1][$key]."] ".$c_name[1][$key]." | ".$chat;
		if(!preg_match("/".md5($format)."/", file_get_contents("log_mess.txt"))){
			
			file_get_contents("https://api.telegram.org/".$telegram_token."/sendMessage?chat_id=".$telegram_chat_id."&text=".$format."&parse_mode=HTML");
			$f = fopen("log_mess.txt", "a+");
			fwrite($f, md5($format)."\r\n");
			fclose($f);

		}
	}
}
echo "======================================\r\n";
echo color("nevy","[+]")."[".color("purple","SALDO")."] Pending  : "."Rp " . color("green",number_format($ihg,0,',','.'))."\r\n";
echo color("nevy","[+]")."[".color("purple","SALDO")."] Sekarang : "."Rp " . color("green",number_format($isaldo_total,0,',','.'))."\r\n";
echo color("nevy","[+]")."[".color("purple","SALDO")."] Total    : "."Rp " . color("green",number_format(($isaldo_total+$ihg),0,',','.'))."\r\n";

if( $chat_status != 0){
	for ($i=0; $i < 3; $i++) { 
		exec("rundll32.exe cmdext.dll,MessageBeepStub");
		sleep(1);
	}
}

if( $orderan_status != 0){
	for ($i=0; $i < 10; $i++) { 
		exec("rundll32.exe cmdext.dll,MessageBeepStub");
		sleep(1);
	}
}


sleep(10);