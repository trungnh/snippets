<?php 
function ArrayGetPath($data, $path, &$result){
 
    $found = true;
 
    $path = explode("/", $path);
 
    for ($x=0; ($x < count($path) and $found); $x++){
 
        $key = $path[$x];
 
        if (isset($data[$key])){
            $data = $data[$key];
        }        
        else { $found = false; }
    }
 
    $result = $data;
 
    return $found;
}