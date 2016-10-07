<?php 
function bin2php($input_file, $output_file){
 
    $i = file_get_contents($input_file);
 
    $b = array();
    $x = 0; $y = 0;
 
    for ($c=0; $c < strlen($i); $c++){
        $no = bin2hex($i[$c]);
        $b[$x] = isset($b[$x]) ? $b[$x].'\\x'.$no : '\\x'.$no;
        if ($y >= 10){ 
            $x++; $y = 0;
        }
        $y++;
    }
 
    $output = "<"."?php\n";
    $output .= "\$f=\"";
    $output .= implode("\";\r\n\$f.=\"", $b);
    $output .= "\";\nprint \$f;";
    $output .= "\n?>";
 
    $fp = fopen($output_file, 'w+');
    fwrite($fp, $output);
    fclose($fp);
}