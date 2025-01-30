<?php 

$password = "Str0ngP@ssw0rd";

echo strlen($password)."<br>";
echo str_word_count($password)."<br>";
echo strrev($password)."<br>";
echo strpos($password,'0')."<br>";
echo str_replace("0","*",$password)."<br>";




?>