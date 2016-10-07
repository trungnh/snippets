<?php 
function RandomString($len){
    $randstr = '';
    srand((double)microtime()*1000000);
    for($i=0;$i<$len;$i++){
        $n = rand(48,120);
        while (($n >= 58 && $n <= 64) || ($n >= 91 && $n <= 96)){
            $n = rand(48,120);
        }
        $randstr .= chr($n);
    }
    return $randstr;
}