<?php 
function encrypt($str, $salt, $iv_len = 16) 
{
	$str .= "\x13";
	$n = strlen($str);
	if ($n % 16) $str .= str_repeat("\0", 16 - ($n % 16));
	$i = 0;
	$enc_text = getRndIV($iv_len);
	$iv = substr($salt ^ $enc_text, 0, 512);
	while ($i < $n) {
		$block = substr($str, $i, 16) ^ pack('H*', md5($iv));
		$enc_text .= $block;
		$iv = substr($block . $iv, 0, 512) ^ $salt;
		$i += 16;
	}
	return base64_encode($enc_text);
}

function getRndIV($iv_len) {
	$iv = '';
	while ($iv_len-- > 0) {
		$iv .= chr(mt_rand() & 0xff);
	}
	return $iv;
}
  
function decrypt($enc, $salt, $iv_len = 16) 
{
	$enc = base64_decode($enc);
	$n = strlen($enc);
	$i = $iv_len;
	$str = '';
	$iv = substr($salt ^ substr($enc, 0, $iv_len), 0, 512);
	while ($i < $n) {
		$block = substr($enc, $i, 16);
		$str .= $block ^ pack('H*', md5($iv));
		$iv = substr($block . $iv, 0, 512) ^ $salt;
		$i += 16;
	}
	return preg_replace('/\\x13\\x00*$/', '', $str);
}


echo decrypt('TApLhw5VrmFrwE7WgoUzcq8UHGNrHGOrXrYSzDiqzMc=', 'abc');