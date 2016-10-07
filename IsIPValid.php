<?php 
function IsIPValid($ip){
 
    if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $ip)){
        return true;
    }
 
    return false;
}