<?php header("Content-Type: text/html; charset=UTF-8");
	function php_to_telegram_msg_send($msg) 
	  {
		$api_token = //insert your token;
		$chat_id = //insert your chatId;
		$api_url = "https://api.telegram.org/bot".$api_token."/sendMessage";

		$post_vars = "chat_id=".$chat_id."&text=".urlencode($msg);
		$content_type = "Content-Type: application/x-www-form-urlencoded";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($content_type));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vars);

		$return = curl_exec($ch);

		curl_close($ch);

		return $return;
	}

	// 원시 POST 데이터를 가져옵니다.
	$json = file_get_contents('php://input');
	
	// JSON 데이터를 PHP 배열로 변환합니다.
	$data = json_decode($json, true);
	
	$entry_name = $data['entry_name']; //post 요청된 json 값 중 key가 entry_name인 것을 받아옴

	
	$tgm_msg = $entry_name."\n";

	// 배열을 JSON 문자열로 변환합니다.
	$tgm_msg_str = $tgm_msg;


	$output = php_to_telegram_msg_send($tgm_msg_str);	
?>
